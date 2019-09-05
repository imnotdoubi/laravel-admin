<?php

namespace App\Http\Controllers\Web;
use App\Models\Categorie;
use App\Models\Photo;
use App\Helpers\Web\Paginator;
use App\Helpers\Web\Pcommon;

class PhotoController extends Controller
{
    public function index()
    {
        $data['head'] = Categorie::where('id', 19)->first();
        return view('web.photo.index', $data);
    }

    public function list($sname, $page = 1) {
        $photos = Categorie::where('typedir', $sname)->firstOrFail();
        if(empty($photos->id))
            return view('web.errors.404');
        $data['head']  = $data['photos'] = $photos;
        if($photos->mid == 7)//列表
        {
            $list = Photo::where('parent_id', $photos->id)->orderBy('created_at', 'desc')->paginate(20, ['*'], 'page', $page);
            $data['list']   = Paginator::transfer($sname,$list);
            $data['links']  = Pcommon::pagelink($data['list']->links());
            return view('web.photo.list',$data);
        }

    }


    public function info($id)
    {
        $photo = Photo::where('id', $id)->firstOrFail();
        if(empty($photo->id))
             return view('web.errors.404');
        $data['head'] = $data['photo'] = $photo;
        return view('/web.photo.info', $data);
    } 
}
