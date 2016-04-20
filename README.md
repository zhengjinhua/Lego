##Lego
php web framework

##事件
核心预设11个
*CORE.REQUEST.INIT
*CORE.MODULE.LOAD.PRE
*CORE.MODULE.LOAD.POST
*CORE.ROUTE.PRE
*CORE.ROUTE.POST
*CORE.REQUEST.OVER
*CORE.ACTION.RUN.PRE
*CORE.ACTION.RUN.POST
*CORE.VIEW.RENDER.PRE
*CORE.VIEW.RENDER.POST


##路由
接口类型
*CLI接口
*HTTP接口

回调类型
*类方法
*匿名函数


##插件机制设计
*通过预设的事件编写插件影响程序执行
*在程序初始化化阶段会加载所有插件

##模块化设计
*在程序初始化化阶段会加载所有模块的注册接口
*在模块模块的注册接口中将业务接口注册到路由器中

