<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPost extends Model
{
    use SoftDeletes;

    protected $table = 'tipos_post';

    protected $fillable = [
        'tipo',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(PostBlog::class, 'tipo_post_id');
    }
}
