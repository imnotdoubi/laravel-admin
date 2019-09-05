<?php

namespace App\Models;
use App\Models\Investment;
use App\Models\CompanyData;
use App\Models\Categorie;
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

    public function companydata()
    {
        return $this->belongsTo(CompanyData::class,'id','id');
    }

}
