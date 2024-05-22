<?php

namespace App\Modules\Biblioteca\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facultad extends Model
{
    use HasFactory;

    public $table = "facultades";

    protected $fillable = [
        "nombre"
    ];

    #region Relationship
    public function carreras():HasMany{
        return $this->hasMany(Carrera::class);
    }
    #endregion
}
