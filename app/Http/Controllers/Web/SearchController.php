<?php

namespace App\Http\Controllers\Web;

class SearchController extends Controller
{
    public function index($query, $page = 1)
    {
        $head = $this->head(\App\Models\Web\SEO::find(28));
        return view('web.search.index', compact('head'));
    }

    function list($type, $kw = '') {
        $params = \Route::getCurrentRoute()->parameters;
        $type = $params['type'];
        $kw = $params['kw'];
        $page = $params['page'] ?? 1;
        switch ($type) {
            case 'chanpin':
                $list = \App\Models\Web\Product::with('company', 'type', 'company.user', 'company.user.type')->has('company')->where('title', 'like', '%' . $kw . '%')->orderBy('created_at', 'desc');
                break;
            case 'gongsi':
                $list = \App\Models\Web\Company::with('user', 'user.type')->where('title', 'like', '%' . $kw . '%')->orderBy('created_at', 'desc');
                break;
            case 'pinpai':
                $list = \App\Models\Web\BrandProduct::with('brand')->where('title', 'like', '%' . $kw . '%')->orderBy('created_at', 'desc');
                break;
            case 'tupian':
                $list = \App\Models\Web\Product::where('title', 'like', '%' . $kw . '%')->orderBy('created_at', 'desc');
                break;
            case 'zhanhui':
                $list = \App\Models\Web\Exhibition::where('title', 'like', '%' . $kw . '%')->orderBy('created_at', 'desc');
                break;
            default:
                abort(404);
                break;
        }
        if (!$kw) {
            $list->whereRaw('1=2');
        }
        $seo_ = ['chanpin' => '产品', 'gongsi' => '公司', 'pinpai' => '品牌', 'tupian' => '图片', 'zhanhui' => '展会'];
        $seo = new \SEO(\App\Models\Web\SEO::find(29));
        $head = $seo->replace(['kw' => $kw, 'type' => $seo_[$type]])->make();
        $list = $list->paginate(12, ['*'], 'page', $page);
        return view('web.search.' . $type, compact('list', 'type', 'kw', 'head'));
    }
}
