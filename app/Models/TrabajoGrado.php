<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajoGrado extends Model
{
    use HasFactory;

    public $table = "trabajos_grado";
    protected $fillable = [
        'codigo',
        'tema',
        'resumen',
        'fecha_defensa',
        'filename',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'carrera_estudiante_trabajo_grado');
    }

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_estudiante_trabajo_grado');
    }
}
