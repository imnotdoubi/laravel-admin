<?php

namespace App\Admin\Controllers;

use App\Models\Ask;
use App\Models\Question;
use App\Models\Categorie;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class AskController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '提问列表';

     protected function grid()
    {
       
        $grid = new Grid(new Ask);
        //隐藏查看按钮
        $grid->actions(function ($actions) {
            $actions->disableView();
        });

         $grid->tools(function ($tools) {
            $tools->batch(function (Grid\Tools\BatchActions $batch) {
                $batch->add('通过审核', new ReleasePost(1));
                $batch->add('拒绝审核', new ReleasePost(0));

            });

        });

        $grid->quickSearch('title');

        $grid->column('id', __('Id'))->sortable();

        $grid->column('parent_id', __('分类'))->display(function ($parent_id) {
            $cates = Categorie::where('id',$parent_id)->first();
            if($cates)
                return "<span style='color:red'>$cates->title</span>";
            else
                return "无";
        });

        $grid->column('title', __('问题'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        });

        $grid->column('status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

        $grid->column('created_at', __('添加时间'));

        $grid->column('updated_at', __('修改时间'))->hide();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->like('title', '问题');

        });
        return $grid;
    }

    public function release(Request $request)
    {
      $status = $request->get('status');
      $ids = explode(',', $request->get('ids'));

      foreach ($ids as $v) {
           $post = Ask::find($v);
           $post->status = $status;
           $post->save();
      }
    }
   

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {


        $form = new Form(new Ask);

         // $id = isset(request()->route()->parameters()['ask']) ? request()->route()->parameters()['ask'] : null;

        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->select('parent_id','问题分类')->options(
            Categorie::where('mid','4')->pluck('typename', 'id')
        );

        $form->text('title', __('提问标题'))->required();

        $form->number('level', __('等级'))->value(1);
         //单图上传
        $form->image('thumb', __('缩略图'))->uniqueName()->removable();

        $form->ueditor('content', __('内容'));

        $form->switch('status', __('状态'))->default('1');

        $form->text('quesid', __('最佳答案ID'));

        $form->switch('hidden', __('是否匿名'))->default('0');

        $form->number('hits', __('点击率'))->value(rand(100,500));
        //隐藏
        $form->hidden('author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

        return $form;
    }


}
