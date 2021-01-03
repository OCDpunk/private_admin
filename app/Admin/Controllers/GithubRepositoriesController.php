<?php

namespace App\Admin\Controllers;

use App\Models\GithubRepositories;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GithubRepositoriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Github仓库管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GithubRepositories());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('项目名'))->limit(20);
        $grid->column('full_name', __('项目全名'))->limit(40);
        $grid->column('description', __('简介'))->limit(60);
//        $grid->column('owner', __('作者资料'));
        $grid->column('html_url', __('网页地址'))->link();
//        $grid->column('original_data', __('原始数据'));
        $grid->column('created_at', __('创建时间'));
//        $grid->column('updated_at', __('更新时间'));

        //快捷搜索
        $grid->quickSearch('name', 'full_name', 'description');

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
        $show = new Show(GithubRepositories::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('项目名'));
        $show->field('full_name', __('项目全名'));
        $show->field('description', __('简介'));
        $show->field('owner', __('作者资料'))->as(function ($originalData) {
            return json_encode($originalData);
        })->json();
        $show->field('html_url', __('网页地址'))->link();
        $show->field('original_data', __('原始数据'))->as(function ($originalData) {
            return json_encode($originalData);
        })->json();
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
        $form = new Form(new GithubRepositories());

        $form->text('name', __('项目名'));
        $form->text('full_name', __('项目全名'));
        $form->textarea('description', __('简介'));
        $form->textarea('owner', __('作者资料'));
        $form->textarea('html_url', __('网页地址'));
        $form->textarea('original_data', __('原始数据'));

        return $form;
    }
}
