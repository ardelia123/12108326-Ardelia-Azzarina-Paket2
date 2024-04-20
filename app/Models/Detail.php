<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'amount',
        'subtotal'
    ];

    public function Sale(){
        return $this->belongsTo(Sale::class);
    }

    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
