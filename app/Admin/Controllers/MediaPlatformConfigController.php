<?php

namespace App\Admin\Controllers;

use App\Models\MediaPlatformConfig;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MediaPlatformConfigController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公众号配置管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MediaPlatformConfig());

        $grid->column('id', __('Id'));
        $grid->column('media_platform_name', __('Media platform name'));
        $grid->column('media_platform_code', __('Media platform code'));
        $grid->column('account_appid', __('Account appid'));
        $grid->column('account_secret', __('Account secret'));
        $grid->column('account_token', __('Account token'));
        $grid->column('account_aes_key', __('Account aes key'));
//        $grid->column('subscribe_message', __('Subscribe message'));
//        $grid->column('more', __('More'));
//        $grid->column('remark', __('Remark'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(MediaPlatformConfig::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('media_platform_name', __('Media platform name'));
        $show->field('media_platform_code', __('Media platform code'));
        $show->field('account_appid', __('Account appid'));
        $show->field('account_secret', __('Account secret'));
        $show->field('account_token', __('Account token'));
        $show->field('account_aes_key', __('Account aes key'));
        $show->field('subscribe_message', __('Subscribe message'));
        $show->field('more', __('More'))->as(function ($originalData) {
            return json_encode($originalData);
        })->json();
        $show->field('remark', __('Remark'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MediaPlatformConfig());

        $form->text('media_platform_name', __('Media platform name'));
        $form->text('media_platform_code', __('Media platform code'));
        $form->text('account_appid', __('Account appid'));
        $form->text('account_secret', __('Account secret'));
        $form->text('account_token', __('Account token'));
        $form->text('account_aes_key', __('Account aes key'));
        $form->text('subscribe_message', __('Subscribe message'));
        $form->textarea('more', __('More'));
        $form->textarea('remark', __('Remark'));

        return $form;
    }
}
