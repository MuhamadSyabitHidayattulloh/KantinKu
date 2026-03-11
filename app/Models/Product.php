<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Helper methods
    public function isInStock()
    {
        return $this->stock > 0;
    }

    public function isAvailable()
    {
        return $this->status === 'available';
    }
}
