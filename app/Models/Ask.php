<?php

namespace App\Models;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
	use ModelTree;
	
    protected $table = 'wbsdb_asks';

}
