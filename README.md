## Wolf Blog 博客源码开源共享

欢迎加入群交流：652087037 【新建2000人群，等待发展】

使用源码后请在您的网站地址链接或说明来源【可选】

依赖ThinkPHP6.X搭建【需要PHP版本>=7.1】，如果有使用的小伙伴可以浏览官方文档说明进行深入研究

文档地址：https://www.kancloud.cn/manual/ThinkPHP6_0/1037479

之后还会继续更新ThinkPHP版本

特别提醒：项目的访问目录是/public/

博客默认采用多应用模式

【网站默认是关闭app_debug的，如需调试，请自行前往根目录中的.env文件配置】

搭建后请访问页面根据提示安装博客项目

## 配置说明

请先配置根目录下的.env文件下的[DATABASE]数据库连接信息（主要修改的是 USERNAME 和 PASSWORD 两个参数值）

利用phpstudy或者其他本地php服务绑定访问路径 /public 后直接访问博客首页就可以正常显示博客网站

## 如何更新ThinkPHP版本

+ 详情参考[ThinkPHP官方手册] https://www.kancloud.cn/manual/ThinkPHP6_0/1037481

如果你之前已经安装过，那么切换到你的应用根目录下面，然后执行下面的命令进行更新：

    composer update topthink/framework

## 相关修改和添加说明

## 添加

+ 新增简易后台说明

后台访问地址：你的项目域名/admin.php 【例如 http://blog.com/admin.php】

+ 新建测试数据库

项目搭建后访问首页会自动启动安装流程步骤，根据提示点下一步即可

数据库相关文件都在/extend/目录下

删除数据库后请记得同时删除根目录下/wcore文件夹中的所有文件 【*.lock 存在表示系统已经创建过博客测试数据库】

相关数据仅供测试使用

+ 常用定义

在 /app/define.php、 /app/common.php 定义了项目会经常使用的一些常量和方法。

其中 common.php 是ThinkPHP自带的，任何分组都可以调用

define.php 是自定义的，如果需要使用，可以引入【参考 /app/BlogBaseController.php】

+ 在项目中空操作和空控制器错误访问会自动指向404页面（异常接管处理）

  404默认调用官方的助手函数 abort 只有在 app_debug = false 时才会正常显示404页面，否则会有相应的错误警告提示

  404页面默认在每个模块下的/view/public/404.php

## 伪静态设置：

+ https://www.wolfcode.net/info/174/

如有任何疑问请留言，地址：  https://www.wolfcode.net/info/131/


