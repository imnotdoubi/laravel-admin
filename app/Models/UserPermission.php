<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
	
    protected $table = 'admin_user_permissions';

    protected $fillable = [ 'permission_id', 'user_id'];

}
