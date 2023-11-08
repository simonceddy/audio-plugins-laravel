<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array'
    ];

    protected $fillable = [
        'name',
        'url',
        'data'
    ];

    public function plugins()
    {
        return $this->hasMany(Plugin::class);
    }
}
