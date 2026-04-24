<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fecha_pedido',
        'estado',
        'precio_pedido',
        'nombre_cliente',
        'tlf_cliente',
        'email_cliente',
        'direccion_envio',
        'metodo_pago',
    ];

    protected $casts = [
        'fecha_pedido'  => 'date',
        'precio_pedido' => 'decimal:2',
    ];

    public function lineas(): HasMany
    {
        return $this->hasMany(LineaPedido::class, 'pedido_id');
    }
}
