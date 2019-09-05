<?php

namespace App\Models;
// use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $table = 'wbsdb_sells';

      //多图上传
    public function setThumbAttribute($thumb)
    {
        if (is_array($thumb)) {
            $this->attributes['thumb'] = json_encode($thumb);
        }
    }
    public function getThumbAttribute($thumb)
    {
        return json_decode($thumb, true);
    }

    public function provs()
    {
        return $this->belongsTo(Area::class,'areaid','id');

    }

    public function typeids($typeid)
    {
        switch ($typeid) {
            case '1':
                return "供应";
            case '2':
                return "提供服务";
            case '3':
                return "供应二手";
            case '4':
                return "提供加工";
            case '5':
                return "提供合作";
            case '6':
                return "库存";                    
            default:
                return "供应";
        }

    }

}
