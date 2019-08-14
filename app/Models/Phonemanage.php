<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phonemanage extends Model
{
    protected $table = 'wbsdb_phonemanages';

    protected $fillable = [ 'phoneno', 'name', 'ip', 'note', 'host'];
    
}
