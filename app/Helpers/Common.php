<?php
/**
 * Created by PhpStorm.
 * User: liang
 * Date: 2017/2/24
 * Time: 16:02
 */
namespace App\Helpers;
use Illuminate\Http\Request;
use App\Models\Investment;
use Illuminate\Support\Facades\Cache;


class Common
{
    
    public static function tzid($tzid)
    {
    	return Cache::remember('touzi_'.$tzid, 1, function() use($tzid){
        	return Investment::where('id',$tzid)->value('title');
         });
    }
}