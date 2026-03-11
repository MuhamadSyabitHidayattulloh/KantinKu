<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    // Helper methods
    public function topup($amount, $reference = null, $description = null)
    {
        $this->balance += $amount;
        $this->save();

        WalletTransaction::create([
            'wallet_id' => $this->id,
            'type' => 'topup',
            'amount' => $amount,
            'status' => 'completed',
            'reference' => $reference,
            'description' => $description,
        ]);

        return $this;
    }

    public function withdraw($amount, $reference = null, $description = null)
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient balance');
        }

        $this->balance -= $amount;
        $this->save();

        WalletTransaction::create([
            'wallet_id' => $this->id,
            'type' => 'withdraw',
            'amount' => $amount,
            'status' => 'completed',
            'reference' => $reference,
            'description' => $description,
        ]);

        return $this;
    }

    public function payment($amount, $reference = null, $description = null)
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient balance');
        }

        $this->balance -= $amount;
        $this->save();

        WalletTransaction::create([
            'wallet_id' => $this->id,
            'type' => 'payment',
            'amount' => $amount,
            'status' => 'completed',
            'reference' => $reference,
            'description' => $description,
        ]);

        return $this;
    }

    public function hasEnoughBalance($amount)
    {
        return $this->balance >= $amount;
    }
}
