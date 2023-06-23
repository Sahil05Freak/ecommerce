<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
  use HasFactory;

  public static function setCustomerUserRoles($user_id)
  {
    $cust_role = 3;
    $role = DB::table('role_user')->insert(['role_id'=>$cust_role, 'user_id'=>$user_id]);
    return $cust_role;
  }
}
