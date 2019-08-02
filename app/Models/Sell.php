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

}
