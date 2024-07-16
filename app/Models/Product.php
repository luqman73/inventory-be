<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_name',
        'storage_capacity',
        'color_id',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
