<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Setting;

class IndexController extends Controller
{
    public function index()
    {
        $head = Setting::find(1);

        return view('web.index', compact('head'));
    }

}
