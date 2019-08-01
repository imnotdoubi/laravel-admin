<?php

namespace App\Admin\Controllers;

use App\Models\Question;
use App\Models\Ask;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class QuestionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '答案列表';

    protected function grid()
    {
       
        $grid = new Grid(new Question);
        //隐藏查看按钮
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        // 隐藏新增
      //  $grid->disableCreation();
        $grid->disableExport();

         $grid->tools(function ($tools) {
            $tools->batch(function (Grid\Tools\BatchActions $batch) {
                $batch->add('通过审核', new ReleasePost(1));
                $batch->add('拒绝审核', new ReleasePost(0));

            });

        });

        $grid->column('id', __('Id'))->sortable();

        $grid->column('askid', __('问题'))->display(function ($askid) {
            $asks = Ask::where('id',$askid)->first();
            if($asks)
                return $asks->title;
            else
                return "无";
        });

        $grid->column('content', __('回答内容'))->display(function ($title) {
            return $title;
        });

        $grid->column('status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

        $grid->column('created_at', __('添加时间'));

        $grid->column('updated_at', __('修改时间'))->hide();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->like('content', '搜索内容');

        });
        return $grid;
    }

    public function release(Request $request)
    {
      $status = $request->get('status');
      $ids = explode(',', $request->get('ids'));

      foreach ($ids as $v) {
           $post = Question::find($v);
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

        $form = new Form(new Question);
        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->select('askid','提问标题')->options(
                 Ask::pluck('title', 'id')
          );

        $form->ueditor('content', __('内容'))->rules('min:3')->help('内容不能少于3个字符');

        $form->switch('status', __('状态'))->default('1');

        $form->switch('hidden', __('是否匿名'))->default('0');

        $form->number('zhichi', __('支持'))->value(rand(30,50));

        $form->number('fandui', __('反对'))->value(rand(5,15));
        //隐藏
        $form->hidden('author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

        return $form;
    }

}
