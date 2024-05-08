<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    public $table = "tutores";

    protected $fillable = [
        "codigo",
        "nombre_completo"
    ];

    #region Relationships
    
    #endregion
}
