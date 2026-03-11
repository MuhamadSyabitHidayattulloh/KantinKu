<?php

namespace App\Http\Controllers\User;

use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        $transactions = $wallet->transactions()->latest()->paginate(10);

        return view('user.wallet', [
            'wallet' => $wallet,
            'transactions' => $transactions,
        ]);
    }

    public function topup()
    {
        return view('user.wallet-topup');
    }

    public function topupStore(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();
        $wallet = $user->wallet;

        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'topup',
            'amount' => $validated['amount'],
            'status' => 'pending',
            'description' => 'Top up request',
        ]);

        return redirect()->route('user.wallet')->with('success', 'Top up request submitted. Please wait for admin approval.');
    }

    public function withdraw()
    {
        return view('user.wallet-withdraw');
    }

    public function withdrawStore(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();
        $wallet = $user->wallet;

        if (!$wallet->hasEnoughBalance($validated['amount'])) {
            return back()->withErrors('Insufficient balance');
        }

        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'withdraw',
            'amount' => $validated['amount'],
            'status' => 'pending',
            'description' => 'Withdraw request',
        ]);

        return redirect()->route('user.wallet')->with('success', 'Withdraw request submitted. Please wait for admin approval.');
    }
}
