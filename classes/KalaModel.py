from Model import Model
import shlex,subprocess
import psutil

class KalaModel(Model):
    def __init__(self,win):
        self.initEvent("mic")
        self.initEvent("cpuusage")
        self.micReady=True
        self.micProcess = None
        #args = shlex.split("alsaloop -C hw:1,0 -P hw:0,1 -t 10000")
        #self.micProcess = subprocess.Popen(args)
        args = shlex.split("python /home/pi/KalaOK/dlsong.py")
        self.dsProcess = subprocess.Popen(args)
        args = shlex.split("python /home/pi/KalaOK/playsong.py '%s'" % (win))
        self.psProcess = subprocess.Popen(args)
        args = shlex.split("python /home/pi/KalaOK/ctrlsong.py")
        self.csProcess = subprocess.Popen(args)
        self.cpuUsage=0
        
    def poll1s(self,sc):
        self.cpuUsage=psutil.cpu_percent(interval=None)
        self.broadcast("cpuusage")
        if self.micProcess != None:
            ret=self.micProcess.poll()
            if ret != None:
                self.micReady=False
                self.broadcast("mic")
                self.micProcess = None

    def safeClean(self,proc):
        if proc != None:
            try:
                proc.terminate()
            except:
                pass

    def cleanup(self):
        self.safeClean(self.micProcess)
        self.safeClean(self.dsProcess)
        self.safeClean(self.csProcess)
        self.safeClean(self.psProcess)
