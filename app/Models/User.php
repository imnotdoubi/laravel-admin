<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_users';

    protected $fillable = [ 'username', 'password', 'name', 'email', 'avatar', 'autoflg', 'remember_token','oid','token'];


}
