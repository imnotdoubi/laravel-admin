<?php

namespace App\Http\Controllers\Web;

use App\Models\Categorie;
use App\Models\Sell;
use App\Helpers\Web\Paginator;
use App\Helpers\Web\Pcommon;
use App\Models\Area;

class SellController extends Controller
{
    public function route($sname='sell', $query = '', $page = 1)
    {
        $area = '';
        if (is_numeric($query)) {
            $page = $query;
        } else {
            $area = $query;
        }
        $data = $this->list($sname, $area, $page);
        return view('web.sell.list', $data);
    }

    function list($sname, $area, $page = 1) {

        $sell     = Categorie::where('typedir', $sname)->firstOrFail();
        $list     = Sell::where('status',1);
        if($sname!= 'sell')
            $list = $list->where('parent_id',$sell->id);
        $url      = "sell/".$sname;
        if ($area) {
            $area = Area::where('name', $area)->firstOrFail();
            $list = $list->where('areaid', $area->id);
            $data['area'] = $area;
            $url .= "/".$area->name;
        }
        $data['head']     = $data['sell'] = $sell;
        $data['list']     = $list->orderBy('created_at', 'desc')->paginate(16, ['*'], 'page', $page);
       
        $data['links']    = "";
        if(!empty($data['list']))
            $data['links']    = Pcommon::mpagelink($url,$data['list']->links());

        return $data;
    }

    public function info($id)
    {
        $data['sell'] = Sell::where('status',1)->findOrFail($id);
        if(empty($data['sell']->id))
             return view('web.errors.404');
        $data['head'] = $data['sell'];
        return view('web.sell.info', $data);
    }
}
