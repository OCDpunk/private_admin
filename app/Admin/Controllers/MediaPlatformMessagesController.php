<?php

namespace App\Admin\Controllers;

use App\Models\MediaPlatformMessages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MediaPlatformMessagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公众号消息管理';

    /**
     * 消息类型
     * @var string[]
     */
    protected $msgType = ['link' => '链接', 'location' => '地理位置', 'text' => '文本', 'image' => '图片', 'voice' => '语音', 'video' => '视频', 'shortvideo' => '小视频', 'file' => '文件', 'event' => '事件'];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MediaPlatformMessages());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('media_platform_code', __('Media platform code'));
//        $grid->column('to_user_name', __('To user name'));
        $grid->column('from_user_name', __('From user name'));
        $grid->column('create_time', __('Create time'));
        $grid->column('msg_type', __('Msg type'))->using($this->msgType);;
//        $grid->column('msg_id', __('Msg id'));
        $grid->column('content', __('Content'))->limit(50);
//        $grid->column('media_id', __('Media id'));
//        $grid->column('pic_url', __('Pic url'));
//        $grid->column('format', __('Format'));
//        $grid->column('recognition', __('Recognition'));
//        $grid->column('thumb_media_id', __('Thumb media id'));
//        $grid->column('location_x', __('Location x'));
//        $grid->column('location_y', __('Location y'));
//        $grid->column('scale', __('Scale'));
//        $grid->column('label', __('Label'));
//        $grid->column('title', __('Title'));
//        $grid->column('description', __('Description'));
//        $grid->column('url', __('Url'));
//        $grid->column('original_data', __('Original data'));
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
        $show = new Show(MediaPlatformMessages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('media_platform_code', __('Media platform code'));
        $show->field('to_user_name', __('To user name'));
        $show->field('from_user_name', __('From user name'));
        $show->field('create_time', __('Create time'));
        $show->field('msg_type', __('Msg type'))->using($this->msgType);
        $show->field('msg_id', __('Msg id'));
        $show->field('content', __('Content'));
        $show->field('media_id', __('Media id'));
        $show->field('pic_url', __('Pic url'));
        $show->field('format', __('Format'));
        $show->field('recognition', __('Recognition'));
        $show->field('thumb_media_id', __('Thumb media id'));
        $show->field('location_x', __('Location x'));
        $show->field('location_y', __('Location y'));
        $show->field('scale', __('Scale'));
        $show->field('label', __('Label'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('url', __('Url'))->link();
        $show->field('original_data', __('Original data'))->as(function ($originalData) {
            return json_encode($originalData);
        })->json();
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
        $form = new Form(new MediaPlatformMessages());

        $form->text('media_platform_code', __('Media platform code'));
        $form->text('to_user_name', __('To user name'));
        $form->text('from_user_name', __('From user name'));
        $form->datetime('create_time', __('Create time'));
        $form->select('msg_type', __('Msg type'))->options($this->msgType);
        $form->text('msg_id', __('Msg id'));
        $form->textarea('content', __('Content'));
        $form->text('media_id', __('Media id'));
        $form->text('pic_url', __('Pic url'));
        $form->text('format', __('Format'));
        $form->text('recognition', __('Recognition'));
        $form->text('thumb_media_id', __('Thumb media id'));
        $form->text('location_x', __('Location x'));
        $form->text('location_y', __('Location y'));
        $form->text('scale', __('Scale'));
        $form->text('label', __('Label'));
        $form->text('title', __('Title'));
        $form->text('description', __('Description'));
        $form->url('url', __('Url'));
        $form->textarea('original_data', __('Original data'));

        return $form;
    }
}
