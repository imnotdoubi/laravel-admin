<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Company;
use App\Models\Categorie;
use App\Models\Phonemanage;

use App\Helpers\Common;

class PostController extends Controller
{
    //

     public function indexFl($id)
	{
		if($id==1)//首页调用
			$data = Categorie::where('parent_id',0)->orderby('id','asc')->take(9)->get();
		else if($id==2)//文章列表顶部
			$data = Categorie::where('parent_id',0)->where('mid',1)->orderby('id','asc')->take(8)->get();

	    $items = [];
	    foreach ($data as $post) {
	        $item['id'] = $post->id;
	        $item['typename'] = $post->typename;
	        $item['typedir'] = $post->typedir;
	        $items[] = $item;
	    }
	    $data = [
	        'message' => 'success',
	        'arcs' => $items
	    ];
	     return response()->json($data);
	}

	public function indexHot($id)
	{
		 $items = [];
		if($id == 1)// 热门品牌
		{
			$data = Company::orderby('hits','desc')->take(2)->get();
			foreach ($data as $v) {
	        $item['id'] = $v->id;
	        $item['combrand'] = $v->combrand;
	        $item['thumb'] = "http://www.lar-admin.test/upload/".$v->thumb;
	        $item['size'] = Common::tzid($v->size);
	        $items[] = $item;
		    }
		    $data = [
		        'message' => 'success',
		        'hotpp' => $items
		    ];
	     	return response()->json($data);
		}else if($id == 2)// 热门文章
		{
			$data = Article::where('parent_id',3)->where('status',1)->orderby('id','desc')->take(3)->get();
			foreach ($data as $v) {
	        $item['id'] = $v->id;
	        $item['title'] = $v->title;
	        $item['conver'] = "http://www.lar-admin.test/upload/".$v->conver;
	        $item['description'] = !empty($v->description)?$v->description:$v->title;
	        $item['hits'] = $v->hits;
	        $item['created_at'] = substr($v->created_at,0,10) ;
	        $items[] = $item;
		    }
		    $data = [
		        'message' => 'success',
		        'hotwz' => $items
		    ];
	     	return response()->json($data);
		}
		else if($id == 3)// 热门文章
		{
			$data = Article::where('parent_id',1)->where('status',1)->orderby('id','desc')->take(3)->get();
			foreach ($data as $v) {
	        $item['id'] = $v->id;
	        $item['title'] = $v->title;
	        $item['conver'] = "http://www.lar-admin.test/upload/".$v->conver;
	        $item['description'] = !empty($v->description)?$v->description:$v->title;
	        $item['hits'] = $v->hits;
	        $item['created_at'] = substr($v->created_at,0,10) ;
	        $items[] = $item;
		    }
		    $data = [
		        'message' => 'success',
		        'hotwz' => $items
		    ];
	     	return response()->json($data);
		}
		
	}
//文章列表
	public function listWz(Request $request, $fl)
	{

	    // 每页显示2条记录
	
	    	$arcarr = Categorie::where('typedir',$fl)->first();

	    	if(!empty($arcarr->id)){
	    		$posts = Article::where('parent_id',$arcarr->id)->orderBy('id', 'desc')->simplePaginate(5);
	    	}else{
	    		dd('暂无数据');
	    	}
	    

	    $items = [];
	    foreach ($posts->items() as $v) {
	        $item['id'] = $v->id;
	        $item['title'] = $v->title;
	        $item['description'] = $v->description;
	       	$item['conver'] = "http://www.lar-admin.test/upload/".$v->conver;
	        $item['description'] = !empty($v->description)?$v->description:$v->title;
	        $item['hits'] = $v->hits; 
	        $item['created_at'] = substr($v->created_at,0,10) ;
	        $items[] = $item;
	    }
	    $data = [
	        'message' => 'success',
	        'listwz' => $items
	    ];
	    return response()->json($data);
	}
	//获取文章
	public function articles($id)
	{
		$v = Article::findOrFail($id);
	    //$items = [];
        $item['id'] = $v->id;
        $item['title'] = $v->title;
        $item['created_at'] =  substr($v->created_at,0,10) ;
        $item['hits'] = $v->hits; 
        $item['content'] = str_replace('"/upload/image','"http://www.lar-admin.test/upload/image',$v->content); 
        // $items[] = $item;
	   
	    $data = [
	        'message' => 'success',
	        'article' => $item
	    ];
	    return response()->json($data);
	}

	//留言
	public function iphonexx(Request $request)
	{
		$data=[];
		$data['ip'] = $request->getClientIp();
        $data['host'] = $request->input('wangzhi');
        $data['name'] = $request->input('xingming');
        $data['note'] = $request->input('neirong');
        $data['phoneno'] = $request->input('dianhua');

        if(empty(Phonemanage::where('phoneno',$request->dianhua)->value('phoneno'))){
        
            Phonemanage::create($data);
            return response()->json(["msg" => "提交成功"]);
        }else{
            return response()->json(["msg" => "电话已存在"]);
        }
	}
}
