<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'user_id',
        'tanggal',
        'total',
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
    public function Customer(): BelongsTo {
        return $this ->belongsTo(Customer::class);
    }

    public function Detail(): HasMany {
        return $this ->hasMany(Detail::class);
    }

    public function User(): BelongsTo {
        return $this ->BelongsTo(User::class);
    }
}
