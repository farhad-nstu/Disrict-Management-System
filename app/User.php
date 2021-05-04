<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zilla_id', 'upazilla_id', 'union_id', 'name', 'email', 'password', 'role', 'designation', 'phone', 'office_logo', 'user_picture', 'nid', 'post_code', 'office_type', 'free_active_date', 'free_expire_date', 'charge_type', 'online_charge', 'tax_payer_date', 'tax_expire_date', 'first_online_charge', 'renew_charge'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'role','id');
    }
}
