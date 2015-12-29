import wx
from classes.KalaModel import KalaModel 
from classes.Model import Model
import qrcode


app=wx.App(False)
size=wx.DisplaySize()
app.model = KalaModel("0 0 %d %d" % (size[0],size[1]))

class MicIndicator(wx.Panel):
    def __init__(self,parent):
        wx.Panel.__init__(self, parent, -1,
                         style=wx.NO_FULL_REPAINT_ON_RESIZE)
        self.Bind(wx.EVT_PAINT, self.OnPaint)
        self.SetSize((50,50))
        Model.regist(self.whenMicModel,"mic")
    
    def whenMicModel(self):
        print "Mic Event!!"
        self.Refresh()

    def OnPaint(self, evt):
        pdc = wx.PaintDC(self)
        try:
            dc = wx.GCDC(pdc)
        except:
            dc = pdc
        rect = self.GetRect()
        if app.model.micReady:
            r, g, b = (0,255,0)
        else:
            r, g, b = (255,255,0)
        penclr   = wx.Colour(r, g, b, wx.ALPHA_OPAQUE)
        brushclr = wx.Colour(r, g, b, 128)   # half transparent
        dc.SetPen(wx.Pen(penclr))
        dc.SetBrush(wx.Brush(brushclr))
        rect.SetPosition((0,0))
        dc.DrawRoundedRectangleRect(rect, 8)

class TopPanel(wx.Panel):
    def __init__(self,parent):
        wx.Panel.__init__(self, parent, -1,
                         style=wx.NO_FULL_REPAINT_ON_RESIZE)
        self.SetBackgroundColour(wx.RED)
        self.SetAutoLayout(True)
        box = wx.BoxSizer(wx.HORIZONTAL)
        self.status = wx.StaticText(self, -1, "This is an example of static text")
        box.Add(self.status,0,wx.EXPAND)
        box.Add((0, 0), 1)
        box.Add(MicIndicator(self),0,wx.CENTER)
        self.SetSizer(box)

def PilImageToWxImage( myPilImage ):
    myWxImage = wx.EmptyImage( myPilImage.size[0], myPilImage.size[1] )
    myWxImage.SetData( myPilImage.convert( 'RGB' ).tostring() )
    return myWxImage

import socket
import fcntl
import struct
def getLocalUrl():
    ifname="wlan0"
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    ip= socket.inet_ntoa(fcntl.ioctl(
        s.fileno(),
        0x8915,  # SIOCGIFADDR
        struct.pack('256s', ifname[:15])
    )[20:24])
    return "http://%s/kalaok/kalaok/web/" % (ip)

class MyFrame(wx.Frame):
    def __init__(
            self, parent, ID, title, pos=wx.DefaultPosition,
            size=wx.DefaultSize, style=wx.DEFAULT_FRAME_STYLE
            ):

        wx.Frame.__init__(self, parent, ID, title, pos, size, style)
        self.SetAutoLayout(True)
        panel = wx.Panel(self, -1)
        lc = wx.LayoutConstraints()
        lc.top.SameAs(self, wx.Top, 50)
        lc.left.SameAs(self, wx.Left, 50)
        lc.bottom.SameAs(self, wx.Bottom, 50)
        lc.right.SameAs(self, wx.Right, 50)
        panel.SetConstraints(lc)
        panel.SetBackgroundColour(wx.BLUE)

        top = TopPanel(panel)

        button = wx.Button(panel, 1003, "Close Me")
        self.Bind(wx.EVT_BUTTON, self.OnCloseMe, button)
        self.Bind(wx.EVT_CLOSE, self.OnCloseWindow)

        box = wx.BoxSizer(wx.VERTICAL)
        box.Add(top, 0, wx.EXPAND)
        box.Add((0, 0), 1)

        img = qrcode.make(getLocalUrl())
        wximg=PilImageToWxImage(img) 
        hbox = wx.BoxSizer(wx.HORIZONTAL)
        hbox.Add((0,0),1)
        hbox.Add(button,0,wx.EXPAND)
        hbox.Add(wx.StaticBitmap(panel, -1, wx.BitmapFromImage(wximg)))
        box.Add(hbox, 0, wx.EXPAND)
        panel.SetSizer(box)

        self.modelTimer = wx.Timer(self)
        self.Bind(wx.EVT_TIMER, app.model.poll1s, self.modelTimer)
        self.modelTimer.Start(1000)

    def OnCloseMe(self, event):
        self.Close(True)

    def OnCloseWindow(self, event):
        app.model.cleanup()
        print "sys done!"
        self.Destroy()

win = MyFrame(None, -1, "This is a wx.Frame", size=(350, 200),
                  style = wx.DEFAULT_FRAME_STYLE)
win.Show(True)
win.ShowFullScreen(True)
app.SetTopWindow(win)
app.MainLoop()

