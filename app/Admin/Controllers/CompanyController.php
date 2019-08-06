<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use App\Models\Categorie;
use App\Models\Area;
use App\Models\Investment;
use App\Models\CompanyData;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Illuminate\Http\Request;



class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '项目';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
  //   protected function grid()
  //   {
  //       //https://laravel-admin.org/docs/zh/model-grid
  //       $grid = new Grid(new Company);
  //       //隐藏查看按钮
  //       $grid->actions(function ($actions) {
  //           // $actions->disableDelete();
  //           // $actions->disableEdit();
  //           $actions->disableView();
  //       });
  //       $grid->tools(function ($tools) {
  //           $tools->batch(function (Grid\Tools\BatchActions $batch) {
  //               $batch->add('通过审核', new ReleasePost(1));
  //               $batch->add('拒绝审核', new ReleasePost(0));

  //           });

  //       });

  //       $grid->quickSearch('company');

  //       $grid->column('id', __('Id'))->sortable();

  //       $grid->column('catid', __('分类'))->display(function ($catid) {
  //           $cates = Categorie::where('id',$catid)->first();
  //           if($cates)
  //               return "<a href='/".$cates->typedir."/'>".$cates->typename."</a>";
  //           else
  //               return "无";
  //       });

  //       $grid->column('combrand', __('品牌名'))->display(function ($combrand) {
  //           return "<span style='color:blue'>$combrand</span>";
  //       })->copyable();

  //       $grid->column('purl', __('品牌标识'));
      
  //       $grid->column('hits', __('点击'));

  //       $grid->column('status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

  //       $grid->column('created_at', __('添加时间'));

  //       $grid->column('updated_at', __('修改时间'))->hide();

  //       $grid->model()->orderBy('id', 'desc');

  //       $grid->filter(function($filter){
  //           // 去掉默认的id过滤器
  //           $filter->disableIdFilter();

  //           $filter->column(1/3, function ($filter) {
  //               $filter->like('company', '品牌名');
  //           });

  //           $filter->column(1/3, function ($filter) {
  //               $filter->between('created_at','时间')->datetime();
           
  //           });
  //           $filter->column(1/3, function ($filter) {
  //               $filter->equal('catid', '分类')
  //               ->select(Categorie::where('status',1)->pluck( 'typename','id'));
           
  //           });

  //       });

  //   //$grid->expandFilter();//搜索默认展开
  //       return $grid;
  //   }

  //   protected function release(Request $request)
  //     {
  //       $status = $request->get('status');
  //       $ids = explode(',', $request->get('ids'));

  //       foreach ($ids as $v) {
  //            $post = Company::find($v);
  //            $post->status = $status;
  //            $post->save();
  //       }
  //     }

  //   *
  //    * Make a form builder.
  //    *
  //    * @return Form
     

  // protected function form()
  //   {
  //       $form = new Form(new Company);

  //        $form->tools(function (Form\Tools $tools) {
  //           $tools->disableDelete();
  //           $tools->disableView();
  //       });

  //       // $form->select('parent_id','父类栏目')->options('/admin/categories');

  //       $form->tab('公司资料', function ($form) {

  //         $form->select('catid','父栏目')->options(Categorie::selectOptions());

  //         $form->text('combrand', __('品牌名'))->required();

  //         $form->text('purl', __('品牌url'))->required();

  //         $form->text('comname', __('公司名'))->required();

  //         $form->image('thumb', __('缩略图'))->uniqueName()->removable();
  //          //图集上传
  //         $form->multipleImage('imagesarr','图片集')->uniqueName()->removable();

  //         $form->text('type', __('公司类型'))->placeholder('企业单位、个体经营、其它');

  //         // $form->select('areaid','地区')->options(Area::selectOptions());
  //         $form->select('province','省份')->options(
  //             Area::where('parent_id',0)->orderBy('id','asc')->pluck('title', 'id')
  //         )->load('city', '/admin/api/city');

  //         $form->select('city','城市')->load('district', '/admin/api/district');

  //         $form->select('district','区县');

  //         $form->select('size','投资金额')->options(
  //                Investment::orderBy('id')->pluck('title', 'id')
  //         );

  //         $form->text('mode', __('经营模式'));

  //         $form->number('capital', __('注册资本(万)'))->value(100);

  //         $form->text('regyear', __('注册年份'));

  //         $form->text('business', __('经营范围'));

  //         $form->number('vip', __('vip等级'))->value(1);

  //         $form->textarea('introduce', __('品牌简介'));

  //         $form->mobile('telephone', __('电话'))->options(['mask' => '999 9999 9999']);

  //         $form->text('fax', __('传真'));

  //         $form->email('mail', __('电子邮件'));

  //         $form->text('address', __('公司地址'));

  //         $form->url('homepage', __('公司网址'));

  //         $form->text('title', __('标题'));

  //         $form->text('keyword', __('关键词'));

  //         $form->text('description', __('描述'));

  //         $form->number('hits', __('点击率'))->value(rand(100,500));

  //         $form->switch('status', __('状态'))->default('1');

  //         //隐藏
  //         $form->hidden('author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

  //       })->tab('品牌内容填写', function ($form) {

  //             $form->ueditor('content', __('品牌内容'));

  //       });

  //       return $form;
  //   }

    

  
}
