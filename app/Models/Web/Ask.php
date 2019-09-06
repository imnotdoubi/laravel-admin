<?php

namespace App\Models\Web;
use App\Models\Web\Question;
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

    public function qcount($id)
    {
        return Question::where('askid',$id)->count();

    }


}
