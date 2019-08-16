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
use App\Models\Area;
use Illuminate\Support\Facades\Cache;


class Common
{
    
    public static function tzid($tzid)
    {
    	return Cache::remember('touzi_'.$tzid, 1, function() use($tzid){

        	return Investment::where('id',$tzid)->value('title');

         });
    }

    public static function areas($pro, $city)
    {
    	return Cache::remember('pro'.$pro."city".$city, 1, function() use($pro , $city){

        	$procon =  Area::where('id',$pro)->value('title');

        	$citycon = Area::where('id',$city)->value('title');

        	return $procon."-".$citycon;

         });
    }
}