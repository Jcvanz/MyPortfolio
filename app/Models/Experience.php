<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tecnologias' => 'array',
    ];

    public function getPeriodoAttribute(): string
    {
        $fim = $this->data_fim ?? 'Presente';
        return "{$this->data_inicio} – {$fim}";
    }
}
