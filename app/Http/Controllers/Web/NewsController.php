<?php

namespace App\Http\Controllers\Web;
use App\Models\Categorie;
use App\Models\Article;
use App\Helpers\Web\Paginator;

class NewsController extends Controller
{
    public function index()
    {
        $data['head'] =  Categorie::where('id' , 15)->first();
        return view('web.article.index', $data);
    }

    public function list($path,$page = 1) 
    {
        $categorys      = Categorie::where('typedir' , $path)->first();
        if(empty($categorys->id))
                return view('web.errors.404');
        $data['head']   = $categorys;
        $data['path']   = $path;
        $data['pcate']  = Categorie::where('id' , $categorys->parent_id)->first();

        if($categorys->mid == 1)//列表
        {

            $list = Article::where('parent_id' , $categorys->id)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);

            $data['list'] = Paginator::transfer($path,$list);

            return view('web.article.list', $data);
        } 
        else if($categorys->mid == 2)//单页面
        {
            return view('web.about.danye', $data);
        }
        else
            return view('web.errors.404');
    }

    public function info($id)
    {
        $articles           = Article::findOrFail($id);

        if(empty($articles->id))
             return view('web.errors.404');
        $data['categorys']  = Categorie::where('id' , $articles->parent_id)->first();
        $data['head']       = $articles;
        $data['pre_news']   = Article::where('id', '<', $articles->id)->orderBy('id', 'desc')->first();
        $data['next_news']  = Article::where('id', '>', $articles->id)->orderBy('id', 'asc')->first();

        return view('web.article.info', $data);
    }

}
