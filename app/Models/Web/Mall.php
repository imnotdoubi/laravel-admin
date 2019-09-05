<?php

namespace App\Models\Web;
use App\Models\Area;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = 'wbsdb_malls';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new \App\Scopes\StatusScope());
    }

    public function provs()
    {
        return $this->belongsTo(Area::class,'province','id');

    }


}
