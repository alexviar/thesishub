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
    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

    public function trabajosGrado()
    {
        return $this->belongsToMany(TrabajoGrado::class, 'carrera_estudiante_trabajo_grado');
    }
}
