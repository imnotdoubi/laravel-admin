<?php
/**
 * Created by PhpStorm.
 * User: bigpang
 * Date: 2017/2/22
 * Time: 15:31
 */

namespace App\Helpers\Web;
use Illuminate\Support\Facades\Cache;
use App\Models\Categorie;
use App\Models\Investment;
use App\Models\Web\Company;
use App\Models\Web\Article;
use App\Models\Web\Ask;
use App\Models\Web\Mall;
use App\Models\Web\Sell;
use App\Models\Web\Photo;
use App\Models\Area;

class Pcommon extends Base
{
    public static function headCategory()
    {
        $ptypes = Cache::remember('headCategory', parent::getCacheMinutes(120, 150), function () {
            return Categorie::where('parent_id', 0)->orderBy('order')->get();
        });
        return $ptypes;
    }

    public static function headNewsCategory()
    {
        $pnews = Cache::remember('headNewsCategory', parent::getCacheMinutes(500, 1000), function () {
           return Categorie::where('parent_id', 15)->orderBy('order')->get();
        });

        return $pnews;
    }

    public static function headInvest()
    {
        $invest = Cache::remember('headInvest', parent::getCacheMinutes(500, 1000), function() {
            return Investment::orderBy('order')->get();
         });
        return $invest;
    }

    public static function indexLeftCategory($id)
    {
        $leftCatgory = Cache::remember('indexLeftCategory_'.$id, parent::getCacheMinutes(100, 300), function() use ($id) {
            return Categorie::where('parent_id', $id)->orderBy('order','asc')->get();
         });
        return $leftCatgory;
    }

    public static function indexCompanys()
    {
        $indexCom = Cache::remember('indexCompanys', parent::getCacheMinutes(100, 300), function() {
            return Company::select('id','thumb','combrand')->where('catid', 7)->orderBy('id','desc')->take(8)->get();
         });
        return $indexCom;
    }

    public static function indexHotCompanys()
    {
        $indexhotCom = Cache::remember('indexHotCompanys', parent::getCacheMinutes(100, 300), function() {
            return Company::select('id','hits','combrand')->orderBy('yxnum','desc')->take(10)->get();
         });
        return $indexhotCom;
    }

    public static function indexTjCompanys($parentid)
    {
        $indextjCom = Cache::remember('indexTjCompanys_'.$parentid, parent::getCacheMinutes(100, 300), function() use ($parentid) {
            return Company::select('id','mdnum','combrand','thumb','size')->where('parent_id',$parentid)->orderBy('id','desc')->take(10)->get();
         });
        return $indextjCom;
    }

    public static function indexTzid($tzid)
    {
        return Cache::remember('indexTzid_'.$tzid, parent::getCacheMinutes(100, 300), function() use($tzid){

            return Investment::where('id',$tzid)->value('title');

         });
    }

    public static function indexRqCompanys()
    {
        $indexrqCom = Cache::remember('indexRqCompanys', parent::getCacheMinutes(100, 300), function() {
            return Company::orderBy('hits','desc')->take(13)->get();
         });
        return $indexrqCom;
    }

    public static function indexNews()
    {
        $indexNews = Cache::remember('indexNews', parent::getCacheMinutes(100, 300), function() {
            return Article::orderBy('id','desc')->take(5)->get();
         });
        return $indexNews;
    }


    public static function indexAsk()
    {
        $indexAsk = Cache::remember('indexAsk', parent::getCacheMinutes(100, 300), function() {
            return Ask::orderBy('id','desc')->take(6)->get();
         });
        return $indexAsk;
    }
    public static function indexMall()
    {
        $indexMall = Cache::remember('indexMall', parent::getCacheMinutes(100, 300), function() {
            return Mall::orderBy('id','desc')->take(6)->get();
         });
        return $indexMall;
    }
    public static function indexSell()
    {
        $indexSell = Cache::remember('indexSell', parent::getCacheMinutes(100, 300), function() {
            return Sell::orderBy('id','desc')->take(6)->get();
         });
        return $indexSell;
    }
    public static function indexPhoto()
    {
        $indexPhoto = Cache::remember('indexPhoto', parent::getCacheMinutes(100, 300), function() {
            return Photo::where('status',1)->orderBy('id','desc')->take(6)->get();
         });
        return $indexPhoto;
    }


    public static function articles($typeid)
    {

        $articlearr = Cache::remember('articles'.$typeid, parent::getCacheMinutes(100, 300), function() use($typeid){
            return Article::where('parent_id',$typeid)->orderBy('id','desc')->take(10)->get();
         });

       // dd($articlearr);
        return $articlearr;
    }


    public static function nurl($id)
    {
       return '/news/'.$id.'.html';
    }

    public static function curl($id)
    {
       return '/xm/'.$id.'.html';
    }

    public static function cnurl($purl,$id)
    {
       return '/xm/'.$purl.'/'.$id.'.html';
    }
    public static function aurl($id)
    {
       return '/know/'.$id.'.html';
    }
    public static function murl($id)
    {
       return '/mall/'.$id.'.html';
    }
    public static function surl($id)
    {
       return '/sell/'.$id.'.html';
    }
    public static function purl($id)
    {
       return '/photo/'.$id.'.html';
    }

    public static function pagelink($str)
    {
        return  str_replace('?page=','/',$str);
    }

    public static function mpagelink($url,$str)
    {
         return  str_replace(request()->path().'?page=',$url.'/p',$str);
    }

    public static function newCompany()
    {
        return Cache::remember('new_company', parent::getCacheMinutes(120, 150), function (){
            return Company::orderBy('yxnum', 'desc')->take(10)->get();
        });
    }

    public static function hotnewsCompany()
    {
        return Cache::remember('hotnews_company', parent::getCacheMinutes(120, 150), function (){
            return Company::orderBy('hits', 'desc')->take(5)->get();
        });
    }

    public static function zxNews()
    {
       return Cache::remember('zuixin_news', parent::getCacheMinutes(120, 150), function() {
            return Article::orderBy('id','desc')->take(10)->get();
         });
    }

    public static function rightasks()
    {
       return Cache::remember('rightasks', parent::getCacheMinutes(120, 150), function() {
            return Ask::orderBy('id','desc')->take(10)->get();
         });
    }

    public static function categorys($id,$str)
    {

        return  Cache::remember('categorys_'.$id."_".$str, parent::getCacheMinutes(500, 1000), function () use($id,$str){
           return Categorie::where('id', $id)->value($str);
        });
    }

    public static function getArea($id,$str)
    {
        return Cache::remember('area_' . $id, parent::getCacheMinutes(500, 1000), function () use ($id,$str) {
            return Area::where('id', $id)->value($str);

        });
    }

    public static function areas()
    {
        return Cache::remember('areas', parent::getCacheMinutes(500, 1000), function () {
            return Area::where('parent_id', 0)->orderBy('id','asc')->get();

        });
    }

    public static function malls($str =1 ,$typeid)
    {
        return Cache::remember('new_malls_' . $str."_".$typeid, parent::getCacheMinutes(120, 150), function () use ($str,$typeid) {
            $parent_id =  Categorie::where('parent_id' , $typeid)->orWhere('id',$typeid)->pluck('id');
            
            if ($str == 1) 
                return  Mall::whereIn('parent_id',$parent_id)->orderBy('created_at', 'desc')->take(6)->get();
            else if ($str == 2) 
                return  Mall::whereIn('parent_id',$parent_id)->orderBy('hits', 'desc')->take(6)->get();
            else if ($str == 3) 
                return  Mall::whereIn('parent_id',$parent_id)->orderBy('level', 'desc')->take(6)->get();
            else
                return  Mall::orderBy('created_at', 'desc')->take(6)->get();
        });
    }

    public static function sells()
    {
        return Cache::remember('new_sells_', parent::getCacheMinutes(120, 150), function (){
               return Sell::orderBy('hits', 'desc')->take(6)->get();
        });
    }

    public static function photos($id)
    {
        return Cache::remember('photos_' .$id, parent::getCacheMinutes(120, 150), function () use ($id) {
            return Photo::where('parent_id',$id)->orderBy('created_at', 'desc')->take(9)->get();
        });
    }

}
