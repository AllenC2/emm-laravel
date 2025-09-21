<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Coordinacione
 *
 * @property $id
 * @property $matrimonio_id
 * @property $comunidad_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Comunidade $comunidade
 * @property Matrimonio $matrimonio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Coordinacione extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['matrimonio_id', 'comunidad_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comunidade()
    {
        return $this->belongsTo(\App\Models\Comunidade::class, 'comunidad_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matrimonio()
    {
        return $this->belongsTo(\App\Models\Matrimonio::class, 'matrimonio_id', 'id');
    }
    
}
