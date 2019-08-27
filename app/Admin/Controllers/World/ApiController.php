<?php

namespace App\Admin\Controllers\World;

use Encore\Admin\Controllers\AdminController;
use App\Models\Area;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends AdminController
{
    public function cities(Request $request)
    {
        $provinceId = $request->get('q');
        return Area::where('parent_id', $provinceId)->orderBy('id','asc')->get(['id', DB::raw('title as text')]);
    }

    public function districts(Request $request)
    {
        $cityId = $request->get('q');
        return Area::where('parent_id', $cityId)->orderBy('id','asc')->get(['id', DB::raw('title as text')]);
    }

    public function childs(Request $request)
    {
        $parentid = $request->get('q');
        return Categorie::where('parent_id', $parentid)->orderBy('id','asc')->get(['id', DB::raw('typename as text')]);
    }


}