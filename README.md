# 个人管理后台

工作后发现很多东西需要记录、整理，缺少一个可以方便记录的平台，于是决定基于laravel-admin做了一个

## 系统环境

- PHP: 7.3+
- Mysql:5.7+（mysql8暂时未测）

## 框架技术
- laravel:8.x
- laravel-admin:1.8
- captcha:3.x

## 功能

- 服务器管理 :ballot_box_with_check:

- github仓库管理 
    - 批量保存github动态中的仓库 :ballot_box_with_check:
    - 批量star github动态中的仓库
    - ...

- 公众号管理
    - 用户管理
    - 留言管理
    
- 企业微信
    - 留言管理
    - 定时提醒

- 个人图书馆

- 备忘录

- ...

## 安装项目

1. 打开终端，使用`composer install`安装依赖包。

2. 使用`cp .env.example .env`复制配置文件，根据自己的环境配置。

3. 使用`php artisan key:generate`创建随机秘钥。

4. 安装[laravel-admin](https://laravel-admin.org/docs/zh/1.x/quick-start)。

### 后台菜单路由

**注意：此处需要根据需求人工添加**

|序号|名称|路由|
|---|---|---|
|1|服务器管理|servers|
|2|Github仓库管理|github-repositories|


### github动态命令行

- 批量保存

    - 需要配置`.env`中`GITHUB_USERNAME`和`GITHUB_TOKEN`参数,`GITHUB_USERNAME`为目标用户名（暂时测试可以获取他人的feed流），执行`php artisan github:feed`，将获取的用户此时前100个动态保存至数据库，建议配合定时器。

