<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SemanaCasilla extends Model
{
    use SoftDeletes;

    protected $table = 'semanas_casilla';

    protected $fillable = [
        'anio',
        'numero_sem',
        'descriptor',
        'estado',
        'precio',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];
}
