# frame
学习搭建A PHP FrameWork

git: git@gitee.com:xxg3053/apfw.git  
学习：http://www.imooc.com/comment/696
(此处仅为框架的学习及测试，不涉及具体业务)  

## 框架运行流程
入口文件 -> 定义常量  -> 引入函数库  -> 自动加载类  -> 启动框架 <- 路由解析  <- 加载控制器 <- 返回结果     

## 入口文件

## 类自动加载
```
spl_autoload_register('\core\kfw::load');
```
没有引入的类调用load方法  

## 路由类

默认的路由地址：  xxx.com/index.php/index/index    

1. 隐藏index.php    
    在根目录添加.htaccess文件
2. 获取URL参数部分   
    /index/index/id/1/str/2
3. 返回对应的控制器和方法   
   
## 模型类
继承pdo

## 视图类

## 配置类

## 日志类

## composer加载
1. 新建composer.json文件
```
{
    "name":"APFW",
    "descrption": "a php framework",
    "type":"Framework",
    "keywords":[
        "PHP", "PHP FrameWork"
    ],
    "require": {
        "php": ">= 5.3.0",
        "filp/whoops":"*"
    },
    "repositories": {
        "packagist": {
            "type": "composer",
            "url": "https://packagist.phpcomposer.com"
        }
    }
}
```
2. 使用composer命令安装依赖
```
composer install
composer update
```

## medoo数据库操作


