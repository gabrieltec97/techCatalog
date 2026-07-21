<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'device',
        'manufacturer',
        'model',
        'storage',
        'ram',
        'condition',
        'grade',
        'battery',
        'color',
        'repairs',
        'accessories',
        'imei',
        'guarantee',
        'account_status',
        'cost_price',
        'selling_price',
        'quantity',
        'images',
        'description',
    ];

    // Converte o campo de imagens automaticamente de/para JSON
    protected $casts = [
        'images' => 'array',
    ];
}
