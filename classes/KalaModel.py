from Model import Model
import shlex,subprocess

class KalaModel(Model):
    def __init__(self):
        self.initEvent("mic")
        self.micReady=True
        args = shlex.split("alsaloop -C hw:1,0 -P hw:0,1 -t 1000")
        self.micProcess = subprocess.Popen(args)
        args = shlex.split("python /home/pi/KalaOK/dlsong.py")
        self.dsProcess = subprocess.Popen(args)
        args = shlex.split("python /home/pi/KalaOK/playsong.py")
        self.psProcess = subprocess.Popen(args)
        args = shlex.split("python /home/pi/KalaOK/ctrlsong.py")
        self.csProcess = subprocess.Popen(args)
        
    def poll1s(self,sc):
        if self.micProcess != None:
            self.micProcess.poll()
            if self.micProcess != None:
                self.micReady=False
                self.broadcast("mic")
                self.micProcess = None
