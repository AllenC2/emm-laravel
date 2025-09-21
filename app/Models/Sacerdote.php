<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sacerdote
 *
 * @property $id
 * @property $nombre
 * @property $telefono
 * @property $domicilio
 * @property $cumpleaños
 * @property $parroquia
 * @property $created_at
 * @property $updated_at
 *
 * @property Comunidade[] $comunidades
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sacerdote extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'telefono', 'domicilio', 'cumpleaños', 'parroquia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comunidades()
    {
        return $this->hasMany(\App\Models\Comunidade::class, 'id', 'sacerdote_id');
    }
    
}
