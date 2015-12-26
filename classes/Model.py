class Model:
    events={}

    def initEvent(self,event):
        Model.events[event]=[]

    @staticmethod
    def regist(object_method, event):
        Model.events[event].append(object_method)

    def broadcast(self,event):
        for m in Model.events[event]:
            m()
