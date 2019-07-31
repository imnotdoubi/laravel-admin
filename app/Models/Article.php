<?php

namespace App\Models;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'wbsdb_articles';
    //
    use ModelTree;

    //存
    public function setFlagAttribute($value)
    {
        $this->attributes['flag'] = implode(',', $value);
    }
    //取
    public function getFlagAttribute($value)
    {
        return explode(',', $value);
    }

    //多图上传
    // public function setConverAttribute($conver)
    // {
    //     if (is_array($conver)) {
    //         $this->attributes['conver'] = json_encode($conver);
    //     }
    // }
    // public function getConverAttribute($conver)
    // {
    //     return json_decode($conver, true);
    // }
}
