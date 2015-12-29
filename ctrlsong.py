#!/usr/bin/python
import MySQLdb
import sys
import base64,md5
import urllib
import json,os,time
import shlex,subprocess

db=MySQLdb.connect(user="kalaok",passwd="kalaok",db="kalaok")
db.autocommit(True)

def ctrlSong(opt):
    global db

    c=db.cursor()
    c.execute("set names utf8")
    c.execute("update operations set `status`=1  where id=%d" % (opt[0]))
    c.close()

    args=None
    opt=opt[1]
    print opt
    if opt=="mv":
        args = "/home/pi/KalaOK/dbuscontrol.sh selectaudio 1"
    elif opt=="mtv":
        args = "/home/pi/KalaOK/dbuscontrol.sh selectaudio 0"
    elif opt=="cancel":
        args = "killall omxplayer.bin"
    if args != None:
        print args
        os.system(args)

def getNextOpt():
    global db
    ret=None
    c=db.cursor()
    c.execute("set names utf8")
    if c.execute("select * from operations where status = 0 limit 1;")>0:
        ret=c.fetchone()
    c.close()
    return ret

while True:
    opt=getNextOpt()
    if opt != None:
        ctrlSong(opt)
    else:
        time.sleep(0.5)
