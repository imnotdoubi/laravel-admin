<?php

namespace App\Admin\Controllers;

use App\Models\Investment;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

class InvestmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '投资额度';

    protected function grid()
    {
        $grid = new Grid(new Investment);
        //隐藏查看按钮
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

        $grid->column('title', __('金额'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        })->copyable();

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

        $form = new Form(new Investment);
        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->text('title', __('金额'))->required();

        $form->number('order', __('排序'))->value(1);

        return $form;
    }


}
