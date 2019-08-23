<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Wuser extends Authenticatable
{
    use Notifiable;

    protected $table = 'wbsdb_users';

    protected $fillable = [ 'username', 'password', 'name', 'email', 'avatar', 'autoflg', 'remember_token','oid','token'];


}
