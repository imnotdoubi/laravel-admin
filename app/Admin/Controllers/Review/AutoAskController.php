<?php

namespace App\Admin\Controllers\Review;

use App\Models\Ask;
use App\Models\Question;
use App\Models\Categorie;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class AutoAskController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '审核提问';

     protected function grid()
    {
       
        $grid = new Grid(new Ask);
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

        $grid->model()->where('status',0)->orderBy('id', 'desc');

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

}
