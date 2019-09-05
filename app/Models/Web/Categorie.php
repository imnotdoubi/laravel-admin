<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
	use SoftDeletes;
    protected $table = 'wbsdb_categories';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new \App\Scopes\StatusScope());
    }

}
