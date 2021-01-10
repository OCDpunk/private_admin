<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    //服务器管理
    $router->resource('servers', ServersController::class);
    //github仓库管理
    $router->resource('github-repositories', GithubRepositoriesController::class);
    //公众号消息管理
    $router->resource('media-platform-messages', MediaPlatformMessagesController::class);
    //公众号配置管理
    $router->resource('media-platform-config', MediaPlatformConfigController::class);

});
