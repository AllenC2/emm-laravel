<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperienciaMatrimonio
 *
 * @property $id
 * @property $experiencia_id
 * @property $matrimonio_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Experiencia $experiencia
 * @property Matrimonio $matrimonio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExperienciaMatrimonio extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['experiencia_id', 'matrimonio_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function experiencia()
    {
        return $this->belongsTo(\App\Models\Experiencia::class, 'experiencia_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matrimonio()
    {
        return $this->belongsTo(\App\Models\Matrimonio::class, 'matrimonio_id', 'id');
    }
    
}
