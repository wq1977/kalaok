#!/usr/bin/python
import sys
import base64,md5
import urllib
import json,os,time
import shlex,subprocess
import atexit

def downloadSong(songid):
    dest="/home/pi/mtv/"+str(songid)+".mp4"
    if os.path.exists(dest):
        return

    os.system("rm -f /tmp/*.mp4 /tmp/*.m4a /tmp/*.st")
    GLOBAL_TYPE_PARAM = "d7bd83313b5b444"
    GLOBAL_TIANLAI_KEY = "6ae993829ca5410e888f5e97b73ee4a810bb242149fd46ada5777edf587b4225"
    request = base64.urlsafe_b64encode("{\"type\":1,\"songId\":\""+str(songid)+"\",\"common\":{\"clientversion\":\"3.3.9\",\"model\":\"sdk\",\"imei\":\"000000000000000\",\"userid\":0,\"resolution\":\"1196X720\",\"apiversion\":\"3.2.0\",\"product\":\"KALAOK\",\"clienttype\":\"Android\",\"nettype\":\"epc.tmobile.com\",\"updatechannel\":\"37\",\"login\":0,\"language\":1,\"imsi\":\"89014103211118510720\",\"systemversion\":\"17\",\"channel\":\"YYH\"},\"primeId\":\"20727\"}");
    sign=md5.md5(request+GLOBAL_TIANLAI_KEY).hexdigest()
    url="http://sns.audiocn.org/tlcysns/content/getSongUrl.action?request="+request+"&sign="+sign+"&type="+GLOBAL_TYPE_PARAM;
    f = urllib.urlopen(url)
    cnt=f.read()
    print cnt
    rsp=json.loads(cnt)
    try:
        ext1 = rsp["mv"][rsp["mv"].rfind("."):]
        ext3 = rsp["song"][rsp["song"].rfind("."):]
        ext2 = rsp["music"][rsp["music"].rfind("."):]
    except:
        return
        
    args = shlex.split('axel -a -o /tmp/mv'+ext1+' '+rsp["mv"]+" "+ " ".join(rsp["mv_list"]))
    print args
    mvproc = subprocess.Popen(args)
    args = shlex.split('axel -a -o /tmp/music'+ext2+' '+rsp["music"]+" "+ " ".join(rsp["music_list"]))
    print args
    musicproc = subprocess.Popen(args)
    args = shlex.split('axel -a -o /tmp/song'+ext3+' '+rsp["song"]+" "+ " ".join(rsp["song_list"]))
    print args
    songproc = subprocess.Popen(args)
    while True:
        r1=mvproc.poll()
        r2=musicproc.poll()
        r3=songproc.poll()
        time.sleep(1)
        if r1!=None and r2 != None  and r3 != None:
            break
    if r1==0 and r2==0 and r3==0:
        cmd="ffmpeg -y -i /tmp/mv"+ext1+" -i /tmp/music"+ext2+"  -i /tmp/song"+ext3+" -strict -2  -map 0:v -codec:v copy -map 1:a:0 -codec:a copy -map 2:a:0 -codec:a copy  "+dest
        os.system(cmd)

downloadSong(sys.argv[1])
