<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostBlog extends Model
{
    use SoftDeletes;

    protected $table = 'posts_blog';

    protected $fillable = [
        'titulo',
        'noticia',
        'fecha_public',
        'imagen',
        'tipo_post_id',
    ];

    protected $casts = [
        'fecha_public' => 'date',
    ];

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(TipoPost::class, 'tipo_post_id');
    }
}
