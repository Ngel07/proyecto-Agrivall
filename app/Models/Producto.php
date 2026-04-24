<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'variedad',
        'formato',
        'precio',
        'imagen',
        'disponible',
    ];

    protected $casts = [
        'precio'     => 'decimal:2',
        'disponible' => 'boolean',
    ];

    public function lineasPedido(): HasMany
    {
        return $this->hasMany(LineaPedido::class, 'producto_id');
    }
}
