<?php

namespace App\Models\Web;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ask extends Model
{
	
    protected $table = 'wbsdb_asks';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new \App\Scopes\StatusScope());
    }

}
