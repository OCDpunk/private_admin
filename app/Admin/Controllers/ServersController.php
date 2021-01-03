<?php

namespace App\Admin\Controllers;

use App\Models\Servers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '服务器管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Servers());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('名称'));
        $grid->column('server_website', __('服务商网站'))->link();
        $grid->column('ip', __('IP'));
        $grid->column('port', __('端口'));
//        $grid->column('username', __('用户名'));
//        $grid->column('password', __('密码'));
        $grid->column('expire_date', __('到期日期'))->sortable();
        $grid->column('control_panel_website', __('控制面板网站'))->link();
//        $grid->column('control_panel_username', __('控制面板用户名'));
//        $grid->column('control_panel_password', __('控制面板密码'));
//        $grid->column('remark', __('备注'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        //快捷搜索
        $grid->quickSearch('name', 'ip');

        //倒叙
        $grid->model()->orderBy('id', 'desc');
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Servers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('名称'));
        $show->field('server_website', __('服务商网站'))->link();
        $show->field('ip', __('IP'));
        $show->field('port', __('端口'));
        $show->field('username', __('用户名'));
        $show->field('password', __('密码'));
        $show->field('expire_date', __('到期日期'));
        $show->field('control_panel_website', __('控制面板网站'))->link();
        $show->field('control_panel_username', __('控制面板用户名'));
        $show->field('control_panel_password', __('控制面板密码'));
        $show->field('remark', __('备注'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Servers());

        $form->text('name', __('名称'));
        $form->url('server_website', __('服务商网站'));
        $form->ip('ip', __('IP'))->required();
        $form->number('port', __('端口'))->default(22);
        $form->text('username', __('用户名'))->default('root');
        $form->password('password', __('密码'));
        $form->datetime('expire_date', __('到期日期'))->default(date('Y-m-d H:i:s'));
        $form->url('control_panel_website', __('控制面板网站'));
        $form->text('control_panel_username', __('控制面板用户名'));
        $form->password('control_panel_password', __('控制面板密码'));
        $form->textarea('remark', __('备注'));

        return $form;
    }
}
