#!/usr/bin/python
import MySQLdb
import sys
import base64,md5
import urllib
import json,os,time
import shlex,subprocess
import atexit
import math
mvproc=None
def savecounter():
    global mvproc
    if mvproc!=None:
        try:
            mvproc.terminate()
        except:
            pass
atexit.register(savecounter)

db=MySQLdb.connect(user="kalaok",passwd="kalaok",db="kalaok")
db.autocommit(True)

#all the old song should be treated as played or invalid
c=db.cursor()
c.execute("set names utf8")
c.execute("update orders set `status`=10  where status!=2")
c.close()

def playSong(song):
    global mvproc
    global db

    songid=song[3]
    dest="/home/pi/mtv/"+str(songid)+".mp4"
    c=db.cursor()
    c.execute("set names utf8")
    c.execute("update orders set `status`=1, `progress`=0 where id=%d" % (song[0]))
    c.close()
    c=db.cursor()
    c.execute("set names utf8")
    vol=0.5
    if c.execute("select operation from operations where operation like 'volume%' order by `when` desc")>0:
        ret=c.fetchone()
        vol=float(ret[0].split("|")[1])/100

    volp=math.log(vol)/math.log(10) * 2000
    
    args = shlex.split("omxplayer --vol %f --win '%s' %s" % (volp,sys.argv[1],dest))
    mvproc = subprocess.Popen(args)
    while True:
        r1=mvproc.poll()
        if r1!=None:
            break
        time.sleep(1)
        os.system("xset s off")
    c=db.cursor()
    c.execute("set names utf8")
    c.execute("update orders set `status`=2, `progress`=0 where id=%d" % (song[0]))
    c.close()
    

def getNextSongId():
    global db
    ret=None
    c=db.cursor()
    c.execute("set names utf8")
    if c.execute("select * from orders where status = 4 limit 1;")>0:
        ret=c.fetchone()
    c.close()
    return ret

while True:
    song=getNextSongId()
    if song != None:
        playSong(song)
    else:
        time.sleep(0.5)
