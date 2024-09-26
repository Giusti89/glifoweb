<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class spots extends Model
{
    protected $fillable = ['cliente_id', 'advertising_id', 'boton','slug'];


    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug'; 
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'cliente_id');
    }
    public function advertising()
    {
        return $this->belongsTo(advertisings::class, 'advertising_id');
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function sells()
    {
        return $this->hasMany(Sells::class);
    }
    public function articles()
    {
        return $this->hasMany(Articles::class);
    }
    public function videos()
    {
        return $this->hasMany(Videos::class);
    }
    public function redes()
    {
        return $this->hasMany(Redes::class);
    }
}
