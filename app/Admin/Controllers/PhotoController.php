<?php

namespace App\Admin\Controllers;

use App\Models\Photo;
use App\Models\Categorie;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Illuminate\Http\Request;


class PhotoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '图库列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Photo);
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
                return $cates->typename;
            else
                return "无";
        });

        $grid->column('title', __('图库名'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        })->copyable();

        $grid->column('hits', __('点击'));

        $grid->column('status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

        $grid->column('created_at', __('添加时间'));

        $grid->column('updated_at', __('修改时间'))->hide();

        $grid->model()->orderBy('id', 'desc');

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
        return $grid;
    }

  public function release(Request $request)
    {
      $status = $request->get('status');
      $ids = explode(',', $request->get('ids'));

      foreach ($ids as $v) {
           $post = Photo::find($v);
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

        $form = new Form(new Photo);
        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->select('parent_id','所属栏目')->options(
            Categorie::where('mid',7)->pluck('typename', 'id')
        );

        $form->text('title', __('图片名'))->required();

        //单图上传
        $form->image('thumb', __('缩略图'))->uniqueName()->removable();

        //图集上传
        $form->multipleImage('conver','图集上传')->uniqueName()->removable();

        $form->textarea('introduce', __('图片介绍'));

        $form->switch('status', __('状态'))->default('1');

        $form->number('hits', __('点击率'))->value(rand(100,500));

        $form->text('keyword', __('关键字'));

        $form->text('description', __('描述'));

        //隐藏
        $form->hidden('author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

        return $form;
    }

  
}
