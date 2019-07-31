<?php

namespace App\Admin\Controllers;

use App\Models\News;
use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Illuminate\Http\Request;



class NewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '项目资讯';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new News);
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

        $grid->column('comid', __('所属项目'))->display(function ($comid) {
            $coms = Company::where('id',$comid)->first();
            if($coms)
                return $coms->combrand;
            else
                return "无";
        });

        $grid->column('title', __('标题'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        })->copyable();

        $grid->column('hits', __('点击'));

        $grid->column('status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

        $grid->column('created_at', __('添加时间'));

        $grid->column('updated_at', __('修改时间'))->hide();

        $grid->model()->orderBy('id', 'desc');

        // 设置分页
        $grid->paginate(25); 

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->column(1/2, function ($filter) {
                $filter->like('title', '标题');
            });

            $filter->column(1/2, function ($filter) {
                $filter->between('created_at','时间')->datetime();
           
            });

        });

    //$grid->expandFilter();//搜索默认展开
        return $grid;
    }

  public function release(Request $request)
    {
      $status = $request->get('status');
      $ids = explode(',', $request->get('ids'));

      foreach ($ids as $v) {
           $post = News::find($v);
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

        $form = new Form(new News);
        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->select('comid','所属项目')->options(
            Company::orderBy('id','desc')->pluck('combrand', 'id')
        );

        $form->text('title', __('标题'))->required();

        $form->text('keyword', __('关键字'));

        $form->text('description', __('描述'));

         $states = [
                'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
        $form->switch('status', __('状态'))->default('1');
       
        //单图上传
        $form->image('thumb', __('缩略图'))->uniqueName()->removable();

        $form->ueditor('content', __('项目内容'));

        $form->number('hits', __('点击率'))->value(rand(100,500));
        //隐藏
        $form->hidden('author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

        return $form;
    }

  
}
