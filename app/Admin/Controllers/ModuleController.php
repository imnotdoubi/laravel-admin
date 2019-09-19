<?php

namespace App\Admin\Controllers;

use App\Models\Module;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

class ModuleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '功能模块';

    protected function grid()
    {

        $grid = new Grid(new Module);

        // 隐藏查看按钮
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
           // 去除批量删除按钮
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->column('id', __('Id'))->sortable();

        $grid->column('name', __('分类名称'));

        $grid->column('order', __('排序'));
 

        return $grid;
    }
   

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Module);
        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->text('name', __('分类名称'))->required();

        $form->number('order', __('排序'))->value(1);

        return $form;
    }


}
