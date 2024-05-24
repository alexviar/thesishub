<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;

class TrabajoGrado extends Model
{
    use HasFactory;

    protected $perPage = 50;

    public $table = 'trabajos_grado';

    protected $fillable = [
        'codigo',
        'tema',
        'resumen',
        'filename',
        'fecha_defensa',
        'tutor_id'
    ];

    protected static function booted(): void
    {
        static::creating(function (TrabajoGrado $trabajoGrado) {            
            $year = Date::now()->year;
            $counter = parent::where('codigo', 'like', $year.'/%')->count() + 1;
            $trabajoGrado->attributes['codigo'] = "$year/$counter";
        });
    }

    public function truncarResumen($length){
        $resumenLength = Str::length($this->resumen);
        $this->resumen = Str::substr($this->resumen, 0, $length);
        $this->resumen = Str::beforeLast($this->resumen, ' ');
        if($resumenLength > $length){
            $this->resumen .= '...';
        }
    }

    #region Mutators
    public function urlDescarga(): Attribute{
        return Attribute::make(
            get: fn() => route('trabajos_grado.descargar', [
                'filename' => basename($this->filename)
            ])
        );
    }
    #endregion

    #region Relationships
    public function tutor(): BelongsTo{
        return $this->belongsTo(Tutor::class);
    }

    public function estudiantes(): BelongsToMany{
        return $this->belongsToMany(Estudiante::class, 'carrera_estudiante_trabajo_grado')->withPivot('carrera_id');
    }
    
    public function carreras(): BelongsToMany{
        return $this->belongsToMany(Carrera::class, 'carrera_estudiante_trabajo_grado')->withPivot('estudiante_id');
    }
    #endregion
}
