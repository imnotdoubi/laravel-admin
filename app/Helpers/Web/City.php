<?php
/**
 * Created by PhpStorm.
 * User: bigpang
 * Date: 2017/2/22
 * Time: 15:31
 */
namespace App\Util\Web;
use App\Models\Web\Region;

class City extends Base
{

    /**
     * 获取按首字母排序的城市
     * @return mixed
     */
    public static function citys_of_index()
    {
        return cache()->remember('city_citys', self::getCacheMinutes(), function () {
            //注意这里用的不是web中的模型
            $arr = \App\Models\Region::where('region_type', 2)->get();
            $arr2 = [];
            foreach ($arr as $v) {
                $arr2[$v->indexf][] = $v;
            }
            ksort($arr2);

            return collect($arr2);
        });
    }

    /**
     * 热门城市
     * @return mixed
     */
    public static function hot_citys(){
        return cache()->remember('hot_citys', self::getCacheMinutes(), function () {
            $arr = Region::where('region_type', 2)->where('isrec',1)->get();
            return $arr;
        });
    }


    /**
     * 通过id获取城市
     * @param $id
     * @return mixed
     */
    public static  function id_to_city($id){
        return cache()->remember('city_id_'.$id, self::getCacheMinutes(), function () use ($id){
            return \App\Models\Region::find($id);
        });

    }

    /**
     * 通过id获取地区
     * @param $sname
     * @return mixed
     */
    public static function sname_to_city($sname){
        if(cache()->has('region'.$sname)){
            return cache()->get('region'.$sname);
        }else{
            $region = Region::where('sname',$sname)->first();
            if ($region){
                cache()->put('region'.$sname,$region,self::getCacheMinutes());
            }
            return $region;
        }

    }

    /**
     * 通过城市名字获取地区
     * @param $name
     * @return mixed
     */
    public static function name_to_city($name){
        $cacheName=urlencode($name);
        if(cache()->has('region_name:'.$cacheName)){
            return cache()->get('region_name:'.$cacheName);
        }else{
            $region = Region::where('region_name',$name)->where('region_type', 2)->first();
            if ($region){
                cache()->put('region_name:'.$cacheName,$region,self::getCacheMinutes());
            }
            return $region;
        }

    }

}