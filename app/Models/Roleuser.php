<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Roleuser extends Model
{
	
    protected $table = 'admin_role_users';

    protected $fillable = [ 'role_id', 'user_id'];

}
