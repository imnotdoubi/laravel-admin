<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'wbsdb_photos';

    // 多图上传
    public function setConverAttribute($conver)
    {
        if (is_array($conver)) {
            $this->attributes['conver'] = json_encode($conver);
        }
    }
    public function getConverAttribute($conver)
    {
        return json_decode($conver, true);
    }
}
