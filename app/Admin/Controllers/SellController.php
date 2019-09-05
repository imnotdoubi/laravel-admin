<?php

namespace App\Admin\Controllers;

use App\Models\Sell;
use App\Models\Categorie;
use App\Models\Area;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class SellController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '供应列表';

     protected function grid()
    {
       
        $grid = new Grid(new Sell);
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

        $grid->column('typeid','供应类型')->display(function ($typeid) {
            switch ($typeid) {
               case "1":
                 return "供应";
                 break;
               case "2":
                 return "提供服务";
                 break;
               case "3":
                 return "供应二手";
                 break;
                case "4":
                 return "提供加工";
                 break;
               case "5":
                 return "提供合作";
                 break;
               case "6":
                 return "库存";
                 break;
            }
        });

        $grid->column('title', __('信息标题'))->display(function ($title) {
            return "<span style='color:blue'>$title</span>";
        });

        $grid->column('amount', __('库存'));

        $grid->column('price', __('价格'));

        $grid->column('brand', __('商品品牌'));

        $grid->column('status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

        $grid->column('created_at', __('添加时间'));

        $grid->column('updated_at', __('修改时间'))->hide();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->like('title', '信息标题');

        });
        return $grid;
    }

    public function release(Request $request)
    {
      $status = $request->get('status');
      $ids = explode(',', $request->get('ids'));

      foreach ($ids as $v) {
           $post = Sell::find($v);
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


        $form = new Form(new Sell);

         // $id = isset(request()->route()->parameters()['ask']) ? request()->route()->parameters()['ask'] : null;

        //隐藏右上角查看 删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });


        $form->tab('基本信息', function (Form $form) {

          $form->radio('typeid','信息类型')->options([1=>'供应', 2=>'提供服务', 3=>'供应二手', 4=>'提供加工', 5=>'提供合作', 6=>'库存']);

          $form->select('parent_id','供应分类')->options(
              Categorie::where('mid','6')->pluck('typename', 'id')
          );
          $form->text('title', __('信息标题'))->required();

          $form->select('areaid','地区')->options(
              Area::where('parent_id',0)->orderBy('id','asc')->pluck('title', 'id')
          );

          $form->text('brand', __('商品品牌'));

          $form->image('litpic', __('缩略图'))->uniqueName()->removable();
            //图集上传
          $form->multipleImage('thumb','商品图集【可传多个】')->uniqueName()->removable();

          $form->ueditor('content', __('供应说明'));

          $form->switch('status', __('状态'))->default('1');

        })->tab('供应参数', function (Form $form) {
          $form->number('level', __('等级'))->value(1);
          $form->number('minamount', __('最小起订量'));
          $form->currency('price', __('供应单价'));
          $form->number('amount', __('供应量'));
          $form->mobile('telephone', '供应电话');
          $form->text('wx', __('供应微信'));
          $form->text('wx', __('供应QQ'));
          $form->text('address', __('地址'));
          $form->text('company', __('公司名'));

          $form->number('hits', __('点击率'))->value(rand(100,500));
          //隐藏
          $form->hidden('author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

        })->tab('其它参数', function (Form $form) {

          $form->email('email','邮箱');
          $form->text('n1', __('参数名称1'));
          $form->text('v1', __('参数值1'));
          $form->text('n2', __('参数名称2'));
          $form->text('v2', __('参数值2'));

        });


        return $form;
    }


}
