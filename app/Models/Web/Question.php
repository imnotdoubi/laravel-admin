<?php

namespace App\Models\Web;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    protected $table = 'wbsdb_questions';
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new \App\Scopes\StatusScope());
    }
}
