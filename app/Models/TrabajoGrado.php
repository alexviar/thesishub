<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class TrabajoGrado extends Model
{
    use HasFactory;

    public $table = "trabajos_grado";

    protected $fillable = [
        "codigo",
        "tema",
        "resumen",
        "filename",
        "fecha_defensa",
        "tutor_id"
    ];

    #region Relationships
    public function tutor(): BelongsTo{
        return $this->belongsTo(Tutor::class);
    }

    public function estudiantes(): BelongsToMany{
        return $this->belongsToMany(Estudiante::class, "carrera_estudiante_trabajo_grado")->withPivot("carrera_id");
    }
    
    public function carreras(): BelongsToMany{
        return $this->belongsToMany(Carrera::class, "carrera_estudiante_trabajo_grado")->withPivot("estudiante_id");
    }
    #endregion
}
