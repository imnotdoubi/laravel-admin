<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

use App\Admin\Extensions\Tools\ReleasePost;
use Illuminate\Http\Request;

use Encore\Admin\Layout\Content;



class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        //https://laravel-admin.org/docs/zh/model-grid
        $grid = new Grid(new Article);
        //隐藏查看按钮
        $grid->actions(function ($actions) {
            // $actions->disableDelete();
            // $actions->disableEdit();
            $actions->disableView();
        });
        //去除批量删除按钮
        // $grid->tools(function ($tools) {
        //     $tools->batch(function ($batch) {
        //         $batch->disableDelete();
        //     });
        // });

        $grid->tools(function ($tools) {

            $tools->batch(function (Grid\Tools\BatchActions $batch) {

                $batch->add('通过审核', new ReleasePost(1));
                $batch->add('拒绝审核', new ReleasePost(0));

            });

        });

        $grid->quickSearch('title');

        $grid->column('id', __('Id'))->sortable();

        // $grid->parent_id('分类id');等于下面的
        $grid->column('parent_id', __('分类'))->display(function ($parent_id) {
            $cates = Categorie::where('id',$parent_id)->first();
            if($cates)
                return "<a href='/news/".$cates->typedir."/'>".$cates->typename."</a>";
            else
                return "无";
        });

          // $grid->column('title', __('标题'));
        $grid->column('title', __('标题'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        })->copyable();// copyable标识可以复制这一列内容

        // $grid->column('description', __('描述'))->setAttributes(['style' => 'color:red;']);
        // $grid->column('description', __('描述'))->style('color:red;');//增加样式 与上面的类似
        // $grid->column('description', __('描述'))->editable();//可以直接编辑 感觉很好用

        // $grid->column('content', __('内容'));
         $grid->column('hits', __('点击'));
        // $grid->column('favs', __('收藏'))->color('green');//设置列颜色

        // $grid->column('status', __('状态'))->display(function ($status) {
        //         return $status ? '<font style="color:red">显示</font>' : '隐藏';
        //     }); //跟下面的功能一样

        $grid->column('status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

        // $grid->column('conver', __('封面图'));
        // $grid->column('created_date', __('时间'))->sortable();//设置可排序

         $grid->column('created_at', __('添加时间'));

         $grid->column('updated_at', __('修改时间'))->hide();//默认隐藏列

        //条件 排序
         // $grid->model()->where('id', '>', 0);
          $grid->model()->orderBy('id', 'desc');

        //设置分页
        // $grid->paginate(1); 

        //添加按钮
        //  $grid->actions(function ($actions) {
        //     // append一个操作
        //     $actions->append('<a href=""><i class="fa fa-eye"></i></a>');
        // });

        //接收不存在的字段可以返回一个指定的结果
        // $grid->column('full_name', __('测试'))->display(function () {
        //     return $this->id ;
        // });

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
  
            $filter->column(1/3, function ($filter) {
                $filter->like('title', '标题');
            });

            $filter->column(1/3, function ($filter) {
                // $filter->equal('created_at')->datetime();
                $filter->between('created_at','时间')->datetime();
           
            });
            $filter->column(1/3, function ($filter) {
                $filter->equal('parent_id', '分类')
                ->select(Categorie::where('status',1)->pluck( 'typename','id'));
           
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
           $post = Article::find($v);
           $post->status = $status;
           $post->save();
      }

      //   foreach ($ids as $v) {
      //     if($status == 1)
      //         Article::where('id',$v)->update(['status'=>0]);
      //     else
      //         Article::where('id',$v)->update(['status'=>1]);
      //   }
        
    }
   


    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('parent_id', __('parent id'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->field('comments', __('Comments'));
        $show->field('favs', __('Favs'));
        $show->field('status', __('Status'));
        $show->field('conver', __('Conver'));
        $show->field('created_date', __('Created date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Article);
        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        // $form->select('parent_id','栏目名')->options(Categorie::selectOptions());
         $form->select('parent_id','栏目名')->options(
            Categorie::where('mid',1)->pluck('typename', 'id')
         )->required();

        $form->text('title', __('标题'))->required();
        // $form->number('parent_id', __('栏目名'));
        // 通过闭包设置options  ->canCheckAll();   为全选
        $form->checkbox('flag','属性')->options([1 => '推荐', 2 => '幻灯', '3' => '图片','4' => '头条','5' => '特荐'])->canCheckAll();

        $form->text('keyword', __('关键字'));

        $form->text('description', __('描述'));
        // $form->textarea('content', __('内容'));

        $form->switch('status', __('状态'))->default('1');
       
        $form->date('created_date', __('时间'))->default(date('Y-m-d'));
        //上传过程中同时生成缩略图
        // $form->image('conver', __('缩略图'))->thumbnail('small', $width = 300, $height = 300)->uniqueName()->removable();
        //单图上传
        $form->image('conver', __('缩略图'))->uniqueName()->removable();

        //多图上传
        // $form->multipleImage('conver','图片')->uniqueName()->removable();

        $form->ueditor('content', __('内容'));

        $form->number('hits', __('点击率'))->value(rand(100,500));
        //隐藏
        $form->hidden('author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

        return $form;
    }
  
}
