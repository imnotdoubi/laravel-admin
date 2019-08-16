<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Company;
use App\Models\CompanyData;
use App\Models\Categorie;
use App\Models\Phonemanage;
use App\Models\Investment;

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
		else if($id==3)//品牌项目列表分类
			$data = Categorie::where('parent_id',4)->where('mid',3)->orderby('id','asc')->take(8)->get();
		else if($id==4)//投资额度
			$data = Investment::orderby('id','asc')->get();		

		if($id == 3){
				$tname['id'] 	  	= 0;
		        $tname['typename'] 	= "所有分类";
		        $typename[] 	 	= $tname;
			foreach ($data as $post) {
		        $tname['id'] 	  	= $post->id;
		        $tname['typename'] 	= $post->typename;
		        $typename[] 	 	= $tname;

		    }
		    $data = $typename;
		}else if($id == 4){
			$tz['id'] 	 = 0;
		    $tz['title'] = '所有投资';
		    $touzi[] = $tz;
			foreach ($data as $post) {
		       $tz['id'] 	= $post->id;
		       $tz['title'] = $post->title;
		       $touzi[] 	= $tz;
		       
		    }

		    $data  = $touzi;
		}
		else{
			$items = [];
		    foreach ($data as $post) {
		        $item['id'] 		= $post->id;
		        $item['typename']	= $post->typename;
		        $item['typedir'] 	= $post->typedir;
		        $items[] 			= $item;
		    }
		    $data = [
		        'message' 	=> 'success',
		        'arcs' 		=> $items
		    ];
		}
	    
	     return response()->json($data);
	}

	public function indexHot($id)
	{
		 $items = [];
		if($id == 1)// 热门品牌
		{
			$data = Company::orderby('hits','desc')->take(2)->get();
			foreach ($data as $v) {
	        $item['id'] 		= $v->id;
	        $item['combrand'] 	= $v->combrand;
	        $item['thumb'] 		= "http://www.lar-admin.test/upload/".$v->thumb;
	        $item['size'] 		= Common::tzid($v->size);
	        $items[] 			= $item;
		    }
		    $data = [
		        'message' 	=> 'success',
		        'hotpp' 	=> $items
		    ];
	     	return response()->json($data);
		}else if($id == 2)// 热门文章
		{
			$data = Article::where('parent_id',3)->where('status',1)->orderby('id','desc')->take(3)->get();
			foreach ($data as $v) {
	        $item['id'] 		= $v->id;
	        $item['title']		= $v->title;
	        $item['conver']		= "http://www.lar-admin.test/upload/".$v->conver;
	        $item['description']= !empty($v->description)?$v->description:$v->title;
	        $item['hits']		= $v->hits;
	        $item['created_at'] = substr($v->created_at,0,10) ;
	        $items[]			= $item;
		    }
		    $data = [
		        'message' 	=> 'success',
		        'hotwz' 	=> $items
		    ];
	     	return response()->json($data);
		}
		else if($id == 3)// 热门文章
		{
			$data = Article::where('parent_id',1)->where('status',1)->orderby('id','desc')->take(3)->get();
			foreach ($data as $v) {
	        $item['id'] 			= $v->id;
	        $item['title'] 			= $v->title;
	        $item['conver'] 		= "http://www.lar-admin.test/upload/".$v->conver;
	        $item['description'] 	= !empty($v->description)?$v->description:$v->title;
	        $item['hits'] 			= $v->hits;
	        $item['created_at'] 	= substr($v->created_at,0,10) ;
	        $items[] 				= $item;
		    }
		    $data = [
		        'message'	=> 'success',
		        'hotwz' 	=> $items
		    ];
	     	return response()->json($data);
		}
		
	}
//文章列表
	public function listWz(Request $request, $typeid=0)
	{

	    // 每页显示5条记录
		if($typeid == 0){
			$posts = Article::where('status',1)->orderBy('id', 'desc')->simplePaginate(5);
		}else{
			$posts = Article::where('status',1)->where('parent_id',$typeid)->orderBy('id', 'desc')->simplePaginate(5);
		}
	    	

	    $items = [];
	    foreach ($posts->items() as $v) {
	        $item['id'] 			= $v->id;
	        $item['title'] 			= $v->title;
	        $item['description'] 	= $v->description;
	       	$item['conver'] 		= "http://www.lar-admin.test/upload/".$v->conver;
	        $item['description'] 	= !empty($v->description)?$v->description:$v->title;
	        $item['hits'] 			= $v->hits; 
	        $item['created_at'] 	= substr($v->created_at,0,10) ;
	        $items[] 				= $item;
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
        $item['id'] 		= $v->id;
        $item['title'] 		= $v->title;
        $item['created_at'] =  substr($v->created_at,0,10) ;
        $item['hits'] 		= $v->hits; 
        $item['content'] 	= str_replace('"/upload/image','"http://www.lar-admin.test/upload/image',$v->content); 

	    $data = [
	        'message' => 'success',
	        'article' => $item
	    ];
	    return response()->json($data);
	}

	//获取项目内容
	public function xmCompanys($id)
	{
		//只取了部分看效果
		$v 	  = Company::findOrFail($id);
		$vcon = CompanyData::findOrFail($id);
	    //$items = [];
        $item['id'] 		= $v->id;
        $item['combrand'] 	= $v->combrand;
        $item['created_at'] =  substr($v->created_at,0,10) ;
        $item['hits'] 		= $v->hits; 
        $item['size'] 		= Common::tzid($v->size);
        $item['province'] 	= Common::areas($v->province,$v->city);
        $item['comname'] 	= $v->comname;
        $item['capital'] 	= $v->capital;
        $item['thumb'] 		= "http://www.lar-admin.test/upload/".$v->thumb;
        $item['content'] 	= str_replace('"/upload/image','"http://www.lar-admin.test/upload/image',$vcon->content); 

	    $data = [
	        'message' 	=> 'success',
	        'xmcom' 	=> $item
	    ];
	    return response()->json($data);
	}

	//留言
	public function iphonexx(Request $request)
	{
		$data=[];
		$data['ip'] 	= $request->getClientIp();
        $data['host'] 	= $request->input('wangzhi');
        $data['name'] 	= $request->input('xingming');
        $data['note'] 	= $request->input('neirong');
        $data['phoneno']= $request->input('dianhua');

        if(empty(Phonemanage::where('phoneno',$request->dianhua)->value('phoneno'))){
        
            Phonemanage::create($data);
            return response()->json(["msg" => "提交成功"]);
        }else{
            return response()->json(["msg" => "电话已存在"]);
        }
	}

	//项目列表
	public function listXm(Request $request, $typeid='0' , $size=0)
	{

	    // 每页显示5条记录
	    if($typeid == 0)
	    {
	    	if($size != 0)
	    		$posts = Company::where('status',1)->where('size',$size)->orderBy('id', 'desc')->simplePaginate(5);
	    	else	
	    		$posts = Company::where('status',1)->orderBy('id', 'desc')->simplePaginate(5);
	    }else{
	    	$arcarr = Categorie::where('id',$typeid)->first();

	    	if( $arcarr->parent_id != 0 && $size == 0){

	    		$childArr = Categorie::where('parent_id',$arcarr->id)->orwhere('id',$arcarr->id )->pluck('id');

	    		$posts = Company::where('status',1)->whereIn('catid',$childArr)->orderBy('id', 'desc')->simplePaginate(5);

	    	}else if( $arcarr->parent_id != 0 && $size != 0){

	    		$childArr = Categorie::where('parent_id',$arcarr->id)->orwhere('id',$arcarr->id )->pluck('id');

	    		$posts = Company::where('status',1)->where('size',$size)->whereIn('catid',$childArr)->orderBy('id', 'desc')->simplePaginate(5);

	    	}
	    }

	    $items = [];
	    foreach ($posts->items() as $v) {
	        $item['id'] 		= $v->id;
	        $item['combrand'] 	= $v->combrand;
	        $item['comname'] 	= $v->comname;
	       	$item['thumb'] 		= "http://www.lar-admin.test/upload/".$v->thumb;
	        $item['hits'] 		= $v->hits; 
	        $item['size'] 		= Common::tzid($v->size);
	        $items[] 			= $item;
	    }
	    $data = [
	        'message' 	=> 'success',
	        'listxm' 	=> $items
	    ];
	    return response()->json($data);
	}
}
