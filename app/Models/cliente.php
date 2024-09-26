<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    

    protected $fillable = ['nombre', 'contacto', 'email', 'logo_url'];

    // Relaciones
    public function solicitudes()
    {
        return $this->hasMany(solicitudes::class, 'cliente_id');
    }

    public function spots()
    {
        return $this->hasMany(spots::class, 'cliente_id');
    }

}
