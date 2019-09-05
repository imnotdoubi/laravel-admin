<?php

namespace App\Http\Controllers\Web;

use App\Models\Web\Ask;
use App\Models\Web\Question;
use App\Models\Categorie;
use App\Helpers\Web\Paginator;
use App\Helpers\Web\Pcommon;

class KnowController extends Controller
{
    public function index($ptype='all',$page = 1)
    {

        if($ptype=='all')
            $data['head'] =  Categorie::where('id' , 16)->first();
        else
            $data['head'] =  Categorie::where('typedir' , $ptype)->first();

        if($data['head']->parent_id == 0)
            $list = Ask::where('id','>', 0);
        else{
            if($data['head']->parent_id == 16){
                $child_id =  Categorie::where('parent_id' , $data['head']->id)->orWhere('id',$data['head']->id)->pluck('id');
                $list = Ask::whereIn('parent_id' , $child_id);
            }
            else    
                $list = Ask::where('parent_id' , $data['head']->id);
        }

            $list = $list->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);
            $data['list']   = Paginator::transfer($ptype,$list);
            $data['links']  = Pcommon::pagelink($data['list']->links());

        return view('web.know.index', $data);
    }

   

    public function info($id)
    {
        $data['head'] = Ask::findOrFail($id);
        if(empty($data['head']->id))
                return view('web.errors.404');
        $data['qsk']  = Question::where('askid',$id)->get();
        return view('web.know.info', $data);
    }

   

    
}
