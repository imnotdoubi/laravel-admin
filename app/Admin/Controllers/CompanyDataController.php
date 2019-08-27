<?php

namespace App\Admin\Controllers;

use App\Models\CompanyData;
use App\Models\Categorie;
use App\Models\Area;
use App\Models\Investment;
use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use App\Admin\Extensions\Tools\ReleasePost;
use Illuminate\Http\Request;



class CompanyDataController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '项目列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        //https://laravel-admin.org/docs/zh/model-grid
        $grid = new Grid(new CompanyData);
        //隐藏查看按钮
        $grid->actions(function ($actions) {
            // $actions->disableDelete();
            // $actions->disableEdit();
            $actions->disableView();
        });
        $grid->tools(function ($tools) {
            $tools->batch(function (Grid\Tools\BatchActions $batch) {
                $batch->add('通过审核', new ReleasePost(1));
                $batch->add('拒绝审核', new ReleasePost(0));

            });

        });

        $grid->column('company.id', __('Id'))->sortable();

        $grid->column('company.catid', __('分类'))->display(function ($catid) {
            $cates = Categorie::where('id',$catid)->first();
            if($cates)
                return "<a href='/".$cates->typedir."/'>".$cates->typename."</a>";
            else
                return "无";
        });

        $grid->column('company.combrand', __('品牌名'))->display(function ($combrand) {
            return "<span style='color:blue'>$combrand</span>";
        })->copyable();

        $grid->column('company.purl', __('品牌标识'));
      
        $grid->column('company.hits', __('点击'));

        $grid->column('company.status', __('状态'))->using(['1' => '显示', '0' => '隐藏']);

        $grid->column('company.created_at', __('添加时间'));

        $grid->column('company.updated_at', __('修改时间'))->hide();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->column(1/3, function ($filter) {
                $filter->like('company.combrand', '品牌名');
            });

            $filter->column(1/3, function ($filter) {
                $filter->between('company.created_at','时间')->datetime();
           
            });
            $filter->column(1/3, function ($filter) {
                $filter->equal('company.catid', '分类')
                ->select(Categorie::where('mid',3)->where('status',1)->pluck( 'typename','id'));
           
            });

        });

    //$grid->expandFilter();//搜索默认展开
        return $grid;
    }

    protected function release(Request $request)
      {
        $status = $request->get('status');
        $ids = explode(',', $request->get('ids'));

        foreach ($ids as $v) {
             $post = Company::find($v);
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
        $form = new Form(new CompanyData);

         $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        // $form->select('parent_id','父类栏目')->options('/admin/categories');

        $form->tab('公司资料', function ($form) {

          // $form->select('company.catid','父栏目')->options(Categorie::where('mid',3)->selectOptions());

          $form->select('company.parent_id','父栏目')->options(
            Categorie::where('mid',3)->where('parent_id',4)->orderBy('id','asc')->pluck('typename', 'id')
          )->load('company.catid', '/admin/api/child');

          $form->select('company.catid','子栏目');

          $form->text('company.combrand', __('品牌名'))->required();

          $form->text('company.purl', __('品牌名英文'))->required()->placeholder('只能为字母组合');

          $form->text('company.comname', __('公司名'))->required();

          $form->image('company.thumb', __('缩略图'))->uniqueName()->removable();
           //图集上传
          $form->multipleImage('company.imagesarr','图片集')->uniqueName()->removable();

          $form->text('company.type', __('公司类型'))->placeholder('企业单位、个体经营、其它');

          // $form->select('areaid','地区')->options(Area::selectOptions());
          $form->select('company.province','省份')->options(
              Area::where('parent_id',0)->orderBy('id','asc')->pluck('title', 'id')
          )->load('company.city', '/admin/api/city');

          $form->select('company.city','城市')->load('company.district', '/admin/api/district');

          $form->select('company.district','区县');

          $form->select('company.size','投资金额')->options(
                 Investment::orderBy('id')->pluck('title', 'id')
          );

          $form->text('company.mode', __('经营模式'));

          $form->text('company.renqun', __('适合人群'))->placeholder('自由创业、其它');

          $form->number('company.mdnum', __('门店数'))->value(rand(100,300));

          $form->number('company.yxnum', __('意向加盟'))->value(rand(1000,2000));

          $form->number('company.sqnum', __('申请加盟'))->value(rand(500,800));

          $form->number('company.capital', __('注册资本(万)'))->value(100);

          $form->text('company.regyear', __('注册年份'));

          $form->text('company.business', __('经营范围'));

          $form->number('company.vip', __('vip等级'))->value(1);

          $form->textarea('company.introduce', __('品牌简介'));

          $form->mobile('company.telephone', __('电话'))->options(['mask' => '999 9999 9999']);

          $form->text('company.fax', __('传真'));

          $form->email('company.mail', __('电子邮件'));

          $form->text('company.address', __('公司地址'));

          $form->url('company.homepage', __('公司网址'));

          $form->text('company.title', __('标题'));

          $form->text('company.keyword', __('关键词'));

          $form->text('company.description', __('描述'));

          $form->number('company.hits', __('点击率'))->value(rand(100,500));

          $form->switch('company.status', __('状态'))->default('1');

          //隐藏
          $form->hidden('company.author_id', __('添加人'))->value(Auth::guard('admin')->user()->id);

        })->tab('品牌内容填写', function ($form) {

              $form->ueditor('content', __('品牌内容'));

        });

        return $form;
    }

    

  
}
