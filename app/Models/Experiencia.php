<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Experiencia
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $lugar
 * @property $fecha_experiencia
 * @property $created_at
 * @property $updated_at
 *
 * @property ExperienciaMatrimonio[] $experienciaMatrimonios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Experiencia extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'descripcion', 'lugar', 'fecha_experiencia'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_experiencia' => 'date',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experienciaMatrimonios()
    {
        return $this->hasMany(\App\Models\ExperienciaMatrimonio::class, 'id', 'experiencia_id');
    }
    
}
