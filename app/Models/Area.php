<?php

namespace App\Models;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
   
    use ModelTree;

    protected $table = 'wbsdb_areas';

    public $timestamps = false;

}
