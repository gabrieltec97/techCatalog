<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'device',
        'manufacturer_id',
        'device_model_id',
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

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function deviceModel(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class, 'device_model_id');
    }

    // Converte o campo de imagens automaticamente de/para JSON
    protected $casts = [
        'images' => 'array',
    ];
}
