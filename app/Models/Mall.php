<?php

namespace App\Models;
// use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = 'wbsdb_malls';

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
        return $this->belongsTo(Area::class,'province','id');

    }

}
