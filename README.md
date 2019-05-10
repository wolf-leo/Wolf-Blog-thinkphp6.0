## Wolf Blog 博客源码开源共享

+ [作者博客地址](https://code.wangjianbo.cn) 


欢迎加入群交流：652087037   【新建2000人群，等待发展】

使用源码后请在您的网站地址链接或说明来源【可选】

依赖Thinkphp5.2.X搭建【需要PHP版本>=7.1】，如果有使用的小伙伴可以浏览官方文档说明进行深入研究

文档地址：https://www.kancloud.cn/manual/thinkphp6_0/1037479

之后还会继续更新Thinkphp版本

本地搭建建议使用PHPstudy环境，官方地址：http://phpstudy.php.cn/

特别提醒：项目的访问目录是/public/

【网站默认是开启app_debug的，如需调试，请自行前往分组下 如/app/index/config/app.php中自行开启或关闭】

搭建后的样式请预览同级目录下的demo.png文件

<label style="color:red">__配置好database.php的数据库信息，绑定访问路径到/public，访问首页即可__</label>


## 访问说明

只要配置好 /config/database.php 中的数据库连接信息（主要修改的是 username 和 password 两个参数值）

利用phpstudy或者其他本地php服务绑定访问路径 /public 后直接访问博客首页就可以正常显示博客网站

## 如何更新Thinkphp版本

 + 详情参考[Thinkphp官方手册] https://www.kancloud.cn/manual/thinkphp6_0/1037479

如果你之前已经安装过，那么切换到你的应用根目录下面，然后执行下面的命令进行更新：

    composer update topthink/framework

## 相关修改和添加说明

## 添加

+ 新增简易后台说明

后台访问地址：你的项目域名/admin 【例如 blog.com/admin】

后台模版不是个人开发，源码来源TPTCMS，官方地址：https://www.tpt360.com/

本人只是简单的改版了一些，如果有需要深入开发的，请直接到官方获取相关手册

 + 新建测试数据库
 
详情在/public/index.php中，INSTALL_SQL 参数值默认为TRUE【自动执行数据库安装程序】

访问网站首页即可

【项目上线后请将INSTALL_SQL修改成FALSE或删除相关自行安装数据库的代码】

已经创建过文章数据库的可以跳过此步骤

数据库相关文件都在/extend/目录下

删除数据库后请记得同时删除/extend/installsql.lock文件 【installsql.lock 存在表示系统已经创建过博客测试数据库】

相关数据仅供测试使用

 + 常用定义
 
在 /app/common/const.php、/app/common/define.php、 /app/common.php 定义了项目会经常使用的一些常量和方法
其中 common.php 是Thinkphp自带的，任何分组都可以调用

const.php 和 define.php 是自定义的，如果需要使用，可以引入【参考 /app/common/controller/Base.php】

 + 在项目中新增 Error.php 控制器 错误访问会自动指向404页面
 
     404默认调用官方的助手函数 abort 只有在app_debug=False时才会正常显示404页面，否则会有相应的错误警告提示
	 
     404页面指定路径修改在 /config/app.php 中 http_exception_template 修改

## 修改：

 + /app/config/template.php
 
$config = [

// 模板文件后缀

'view_suffix' => 'php',

// 模板文件名分隔符

'view_depr' => '_',

];

博客使用的是下划线，官方默认使用的是斜杆，这样要在view下面再新建一个文件夹。

如有任何疑问请留言，地址：  https://code.wangjianbo.cn/info/131/

