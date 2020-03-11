<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
        'nome', 'supervisor', 'sala', 'ramal'
    ];

    public function servidores()
    {
        return $this->hasMany(\App\User::class, 'equipe_id', 'id');
    }
}
