<?php

namespace App\Admin\Controllers;

use App\Models\Area;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

class AreaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '省份城市';

     protected function grid()
    {
       
        $grid = new Grid(new Area);
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

        $grid->quickSearch('title');

        $grid->column('id', __('Id'))->sortable();

        $grid->column('parent_id', __('上级地区'))->display(function ($parent_id) {
            $cates = Area::where('id',$parent_id)->first();
            if($cates)
                return "<span style='color:red'>$cates->title</span>";
            else
                return "无";
        });

        $grid->column('title', __('地区名'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        })->copyable();

        $grid->column('name', __('地区标识'));

        //$grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->column(1/2, function ($filter) {
                $filter->like('title', '地区名');
            });

            $filter->column(1/2, function ($filter) {
                 $filter->like('name', '地区标识');
            });

        });
        return $grid;
    }
   

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Area);
        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->select('parent_id','父级地区')->options(Area::selectOptions());

        $form->text('title', __('地区名'))->required();

        $form->text('name', __('地区标识'))->required();

        return $form;
    }


}
