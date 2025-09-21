<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comunidade
 *
 * @property $id
 * @property $nombre
 * @property $sacerdote_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Sacerdote $sacerdote
 * @property Coordinacione[] $coordinaciones
 * @property Matrimonio[] $matrimonios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comunidade extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'sacerdote_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sacerdote()
    {
        return $this->belongsTo(\App\Models\Sacerdote::class, 'sacerdote_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coordinaciones()
    {
        return $this->hasMany(\App\Models\Coordinacione::class, 'id', 'comunidad_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matrimonios()
    {
        return $this->hasMany(\App\Models\Matrimonio::class, 'comunidad_id', 'id');
    }
    
}
