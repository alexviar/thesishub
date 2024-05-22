<?php

namespace App\Modules\Biblioteca\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nro_registro',
        'nombre_completo',
    ];

    public function trabajosGrado()
    {
        return $this->belongsToMany(TrabajoGrado::class, 'carrera_estudiante_trabajo_grado');
    }
}
