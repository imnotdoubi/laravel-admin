<?php

namespace App\Admin\Controllers\Review;

use App\Models\Article;
use App\Models\Categorie;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Illuminate\Http\Request;
use Encore\Admin\Layout\Content;

class AutoArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '审核文章';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);
        //隐藏查看按钮
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });

        // 去除批量删除按钮
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->tools(function ($tools) {
            $tools->batch(function (Grid\Tools\BatchActions $batch) {
                $batch->add('通过审核', new ReleasePost(1));
            });

        });

        $grid->quickSearch('title');

        $grid->column('id', __('Id'))->sortable();
        $grid->column('parent_id', __('分类'))->display(function ($parent_id) {
            $cates = Categorie::where('id',$parent_id)->first();
            if($cates)
                return "<a href='/".$cates->typedir."/'>".$cates->typename."</a>";
            else
                return "无";
        });
        $grid->column('title', __('标题'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        })->copyable();// copyable标识可以复制这一列内容

         $grid->column('hits', __('点击'));

         $grid->column('created_at', __('添加时间'));

         $grid->column('updated_at', __('修改时间'))->hide();//默认隐藏列

          $grid->model()->where('status',0)->orderBy('id', 'desc');


        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
  
            $filter->column(1/3, function ($filter) {
                $filter->like('title', '标题');
            });

            $filter->column(1/3, function ($filter) {
                $filter->between('created_at','时间')->datetime();
           
            });
            $filter->column(1/3, function ($filter) {
                $filter->equal('parent_id', '分类')
                ->select(Categorie::where('status',1)->pluck( 'typename','id'));
           
            });

        });
        return $grid;
    }

  public function release(Request $request)
    {
      $status = $request->get('status');

      $ids = explode(',', $request->get('ids'));

      foreach ($ids as $v) {
           $post = Article::find($v);
           $post->status = $status;
           $post->save();
      }
    }
}
