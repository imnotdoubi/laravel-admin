<?php

namespace App\Http\Controllers\Web;

use App\Models\Categorie;
use App\Models\Mall;
use App\Helpers\Web\Paginator;
use App\Helpers\Web\Pcommon;
use App\Models\Area;

class MallController extends Controller
{
    public function index()
    {
        $data['head'] = Categorie::where('id',17)->first();
        return view('web.mall.index', $data);
    }

    public function route($sname, $query = '', $page = 1)
    {
        $area = '';
        $view = 'list';
        $fl   = 1;
        if (starts_with($sname, 'l_')) {
            $sname = str_replace('l_', '', $sname);
            $view  = 'llist';
            $fl    = 2;
        }
        if (is_numeric($query)) {
            $page = $query;
        } else {
            $area = $query;
        }
        $data = $this->list($sname, $area, $page,$fl);
        return view('web.mall.' . $view, $data);
    }

    function list($sname, $area, $page = 1,$fl) {

        $category = Categorie::where('typedir', $sname)->firstOrFail();
        $list     = Mall::where('status',1);
        $data['category']  = $category;
        $data['pcate']     = "";
        if($category->parent_id != 17){
            $list = $list->where('parent_id',$category->id);
            $data['pcate'] = Categorie::where('id', $category->parent_id)->first();
        }
        else{
            $child_id =  Categorie::where('parent_id' , $category->id)->orWhere('id',$category->id)->pluck('id');
            $list     = $list->whereIn('parent_id',$child_id);
        }

        $ftype    = '';  
        if($fl == 2){
           $ftype = 'l_';
           $sname = $ftype.$sname;
        }
        $url      = "mall/".$sname;
        if ($area) {
            $area = Area::where('name', $area)->firstOrFail();
            $list = $list->where('province', $area->id);
            $data['area'] = $area;
            $url .= "/".$area->name;
        }
        $data['head']     = $category;
        $data['list']     = $list->orderBy('created_at', 'desc')->paginate(16, ['*'], 'page', $page);
        $data['links']    = "";
        $data['ftype']    = $ftype;
        if(!empty($data['list']))
            $data['links']    = Pcommon::mpagelink($url,$data['list']->links());

        return $data;
    }

    public function info($id)
    {
        $data['mall'] = Mall::where('status',1)->findOrFail($id);

        if(empty($data['mall']->id))
             return view('web.errors.404');
        $data['head'] = $data['mall'];
        return view('web.mall.info', $data);
    }
}
