<?php

namespace App\Models;
use App\Models\Investment;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'wbsdb_companys';
    //
    use ModelTree;

    //多图上传
    public function setImagesarrAttribute($imagesarr)
    {
        if (is_array($imagesarr)) {
            $this->attributes['imagesarr'] = json_encode($imagesarr);
        }
    }
    public function getImagesarrAttribute($imagesarr)
    {
        return json_decode($imagesarr, true);
    }
}
