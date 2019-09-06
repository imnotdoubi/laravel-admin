<?php

namespace App\Http\Controllers\Web;

use App\Models\Categorie;
use App\Models\Company;
use App\Models\Web\News;
use App\Helpers\Web\Paginator;
use App\Helpers\Web\Pcommon;

class CompanyController extends Controller
{
    public function index($jine=0,$page=1) 
    {
        $categorys      = Categorie::where('id' , 4)->first();
        $list           = Company::where('status',1);
        $data['head']   = $categorys;
        if($jine > 0)
                $list   = $list->where('size' , $jine)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);
        else    
                $list   = $list->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);   
        $data['path']   = 'xm';

        $data['jine']   = $jine;
        $data['list']   = Paginator::transfer($jine,$list);
        $data['links']  = Pcommon::pagelink($data['list']->links());
        return view('web.company.list', $data);
    }

   public function list($ptype, $jine=0, $page=1) 
    {

        $categorys     = Categorie::where('typedir' , $ptype)->first();
        if(empty($categorys->id))
                return view('web.errors.404');
        $data['head']  = $categorys;
        $data['cid']   = $data['head']->id;
        $data['pcate'] = Categorie::where('id' , $categorys->parent_id)->first();
   
        if($categorys->mid == 3)//列表
        {
            $data['cpath'] = "";
            $list = Company::where('status',1);
            if($categorys->parent_id == 4){
                $data['path']  = $ptype;
                $list = $list->where('parent_id' , $categorys->id);
            }
            else{
                $data['path']  = $data['pcate']->typedir;
                $data['cpath'] = $ptype;
                $data['cid']   = $data['pcate']->id;
                $list = $list->where('catid' , $categorys->id);
            }
            if($jine > 0)
                $list = $list->where('size' , $jine);

            $list = $list->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);

            $data['list']   = Paginator::transfer($ptype."/".$jine,$list);
            $data['links']  = Pcommon::pagelink($data['list']->links());
            $data['list']   = $list;
            $data['jine']   = $jine;
            return view('web.company.list', $data);
        }
        else if($categorys->mid == 2)//单页面
        {
            if(empty($data['pcate']))
                $data['pcate'] = $categorys;
            return view('web.about.danye', $data);
        } 
    }

    public function info($id)
    {
        $company        = Company::where('status',1)->where('id', $id)->firstOrFail();
        if(empty($company->id))
             return view('web.errors.404');
        $data['head']   = $company;

        $data['xmnews'] = News::where('comid', $company->id)->take(10)->get();

        return view('/web.company.info', $data);
    }


    public function news_info($purl, $id)
    {
        $company = Company::where('status',1)->where('purl', $purl)->firstOrFail();
        $news = News::findOrFail($id);
        $data['company'] = $company;
        $data['pre_news'] = News::where('id', '<', $news->id)->orderBy('id', 'desc')->first();
        $data['next_news'] = News::where('id', '>', $news->id)->orderBy('id', 'asc')->first();
        $data['head'] = $news;
        return view('web.company.news_info', $data);
    }


}
