<?php

namespace App\Modules\Auth\Models;

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
 * @property $is_admin
 * @property $created_at
 * @property $updated_at
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
    protected $fillable = ['username','nombre_completo', 'estado', 'email', 'password', 'is_admin'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    private $estadosMap = [
      1 => 'Activo',
      2 => 'Inactivo'
    ];

    protected $attributes = [
      'estado' => 1
    ];

    #region Accessors & Mutators
    function password():Attribute {
        return Attribute::make(
          set: fn($value) => Hash::make($value)
        );
    }
    
    function isActivo():Attribute {
      return Attribute::make(
        get: fn(mixed $value, array $attributes) => $attributes['estado'] == 1
      );
    }
    
    function printableEstado():Attribute {
      return Attribute::make(
        get: fn(mixed $value, array $attributes) => $this->estadosMap[$attributes['estado']]
      );
    }
    #endregion
    
}
