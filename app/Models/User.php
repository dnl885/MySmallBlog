<?php

namespace App\Models;

use App\Constants\RoleConstants;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->hasMany(UserRole::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function hasRole(string $role){
        $userRoles = $this->roles()->get();

        foreach($userRoles as $userRole){
            $lRole = Role::find($userRole->role_id);

            if($lRole && $lRole->role_key == $role){
                return true;
            }
        }

        return false;
    }

    public function isAdmin(){
        return $this->hasRole(RoleConstants::ROLE_ADMIN);
    }
}
