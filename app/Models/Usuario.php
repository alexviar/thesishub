<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

/**
 * Class Usuario
 *
 * @property $id
 * @property $username
 * @property $nombre_completo
 * @property $estado
 * @property $email
 * @property $password
 * @property $password_confirm
 * @property $rol
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 **/
class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['username','nombre_completo', 'estado', 'email', 'password', 'rol'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     protected $hidden = [
        'password',
        'remember_token',
    ];

    function password():Attribute {
        return Attribute::make(
          set: fn($value) => Hash::make($value)
        );
     }
    
}
