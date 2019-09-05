<?php

namespace App\Models\Web;

use App\Models\Web\CompanyData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{

    protected $table = 'wbsdb_companys';
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new \App\Scopes\StatusScope());
    }

    public function companydata()
    {
        return $this->belongsTo(CompanyData::class);

    }
}
