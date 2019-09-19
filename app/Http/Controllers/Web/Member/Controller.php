<?php

namespace App\Http\Controllers\Web\Member;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    final protected function UTF2UCS($str)
    {
        $str = strtolower($str);
        $arr = preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY);
        foreach ($arr as &$v) {
            $v = bin2hex(iconv('UTF-8', 'UCS-2', $v));
        }

        return join(" ", $arr);
    }

    

}
