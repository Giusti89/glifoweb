<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'leyenda',
        'image_url',
        'avatar',       
    ];
 
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    
    public function productos()
    {
        return $this->hasMany(productos::class, 'servicio_id', 'id');
    }
    public function solicitudes()
    {
        return $this->hasMany(solicitudes::class, 'servicio_id');
    }
    
}
