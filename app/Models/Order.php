<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Calculate status based on order details (per product)
    public function getCalculatedStatus()
    {
        if ($this->orderDetails->isEmpty()) {
            return 'pending';
        }

        // If any product is cancelled, mark as cancelled
        if ($this->orderDetails->where('status', 'cancelled')->isNotEmpty()) {
            return 'cancelled';
        }

        // If any product is still pending, mark as pending
        if ($this->orderDetails->where('status', 'pending')->isNotEmpty()) {
            return 'pending';
        }

        // If any product is still processing, mark as processing
        if ($this->orderDetails->where('status', 'processing')->isNotEmpty()) {
            return 'processing';
        }

        // If any product is still ready, mark as ready
        if ($this->orderDetails->where('status', 'ready')->isNotEmpty()) {
            return 'ready';
        }

        // All products completed
        return 'completed';
    }

    // Helper methods
    public function isPending()
    {
        return $this->getCalculatedStatus() === 'pending';
    }

    public function isProcessing()
    {
        return $this->getCalculatedStatus() === 'processing';
    }

    public function isReady()
    {
        return $this->getCalculatedStatus() === 'ready';
    }

    public function isCompleted()
    {
        return $this->getCalculatedStatus() === 'completed';
    }

    public function isCancelled()
    {
        return $this->getCalculatedStatus() === 'cancelled';
    }

    // Generate order number
    public static function generateOrderNumber()
    {
        $prefix = 'ORD-' . date('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return $prefix . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
