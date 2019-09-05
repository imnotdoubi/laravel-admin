<?php

namespace App\Models\Web;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $table = 'wbsdb_sells';
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new \App\Scopes\StatusScope());
    }

    public function provs()
    {
        return $this->belongsTo(Area::class,'areaid','id');

    }


}
