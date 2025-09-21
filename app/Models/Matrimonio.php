<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Matrimonio
 *
 * @property $id
 * @property $nombre
 * @property $telefono_ella
 * @property $telefono_el
 * @property $fin_de_semana
 * @property $cabeza_comunidad
 * @property $equipo_post
 * @property $cargo_post
 * @property $direccion
 * @property $colonia
 * @property $ciudad
 * @property $codigo_postal
 * @property $cumpleaños_el
 * @property $cumpleaños_ella
 * @property $aniversario
 * @property $numero_hijos
 * @property $hijos_solteros
 * @property $edades_hijos
 * @property $comunidad_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Comunidade $comunidade
 * @property Coordinacione[] $coordinaciones
 * @property ExperienciaMatrimonio[] $experienciaMatrimonios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Matrimonio extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'telefono_ella', 'telefono_el', 'fin_de_semana', 'cabeza_comunidad', 'equipo_post', 'cargo_post', 'direccion', 'colonia', 'ciudad', 'codigo_postal', 'cumpleaños_el', 'cumpleaños_ella', 'aniversario', 'numero_hijos', 'hijos_solteros', 'edades_hijos', 'comunidad_id'];

    /**
     * Helper method to format dates safely
     */
    private function formatDateSafely($date, $format = 'd/m/Y')
    {
        if (!$date || $date === '0000-00-00' || strlen($date) < 8) {
            return 'No registrado';
        }
        
        try {
            return \Carbon\Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return $date; // Return original if can't parse
        }
    }

    /**
     * Get formatted cumpleaños_ella
     */
    public function getCumpleanosEllaFormattedAttribute()
    {
        return $this->formatDateSafely($this->cumpleaños_ella);
    }

    /**
     * Get formatted cumpleaños_el
     */
    public function getCumpleanosElFormattedAttribute()
    {
        return $this->formatDateSafely($this->cumpleaños_el);
    }

    /**
     * Get formatted aniversario
     */
    public function getAniversarioFormattedAttribute()
    {
        return $this->formatDateSafely($this->aniversario);
    }

    /**
     * Get aniversario relative time
     */
    public function getAniversarioRelativeAttribute()
    {
        if (!$this->aniversario || $this->aniversario === '0000-00-00' || strlen($this->aniversario) < 8) {
            return '';
        }
        
        try {
            return \Carbon\Carbon::parse($this->aniversario)->locale('es')->diffForHumans();
        } catch (\Exception $e) {
            return '';
        }
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comunidade()
    {
        return $this->belongsTo(\App\Models\Comunidade::class, 'comunidad_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coordinaciones()
    {
        return $this->hasMany(\App\Models\Coordinacione::class, 'id', 'matrimonio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experienciaMatrimonios()
    {
        return $this->hasMany(\App\Models\ExperienciaMatrimonio::class, 'id', 'matrimonio_id');
    }
    
}
