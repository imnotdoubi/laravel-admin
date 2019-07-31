<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
     use ModelTree, AdminBuilder;
     protected $table = 'wbsdb_categories';

}
