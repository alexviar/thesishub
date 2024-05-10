<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre"
    ];

    #region Relationship
    public function facultad(): BelongsTo{
        return $this->belongsTo(Facultad::class);
    }
    #endregion    
}
