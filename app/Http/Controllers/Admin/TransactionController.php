<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = WalletTransaction::with('wallet.user');

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $transactions = $query->latest()->paginate(15);

        // Calculate statistics
        $totalTopup = WalletTransaction::where('type', 'topup')->where('status', 'completed')->sum('amount');
        $totalWithdraw = WalletTransaction::where('type', 'withdraw')->where('status', 'completed')->sum('amount');
        $pendingBalance = WalletTransaction::where('status', 'pending')->sum('amount');

        // Get users and vendors for forms
        $users = User::where('role', 'user')->get(['id', 'name']);
        $vendors = User::where('role', 'vendor')->get(['id', 'name']);

        return view('admin.transactions', [
            'transactions' => $transactions,
            'totalTopup' => $totalTopup,
            'totalWithdraw' => $totalWithdraw,
            'pendingBalance' => $pendingBalance,
            'users' => $users,
            'vendors' => $vendors,
        ]);
    }

    public function approve(WalletTransaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->withErrors('Transaction is not pending');
        }

        $transaction->update(['status' => 'completed']);

        if ($transaction->type === 'topup') {
            $transaction->wallet->balance += $transaction->amount;
        } elseif ($transaction->type === 'withdraw') {
            if ($transaction->wallet->balance < $transaction->amount) {
                $transaction->update(['status' => 'failed']);
                return back()->withErrors('Insufficient balance');
            }
            $transaction->wallet->balance -= $transaction->amount;
        }

        $transaction->wallet->save();

        return back()->with('success', 'Transaction approved');
    }

    public function reject(WalletTransaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->withErrors('Transaction is not pending');
        }

        $transaction->update(['status' => 'failed']);
        return back()->with('success', 'Transaction rejected');
    }

    public function topup(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1000',
        ]);

        $user = User::findOrFail($request->user_id);
        
        // Create wallet if it doesn't exist
        if (!$user->wallet) {
            $wallet = $user->wallet()->create(['balance' => 0]);
        } else {
            $wallet = $user->wallet;
        }

        $transaction = WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'topup',
            'amount' => $request->amount,
            'status' => 'completed',
            'description' => 'Admin Top Up: ' . $request->amount,
        ]);

        // Update wallet balance
        $wallet->balance += $request->amount;
        $wallet->save();

        return back()->with('success', 'Top Up berhasil. Transaksi ID: ' . $transaction->id);
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:100000',
            'bank_account' => 'required|string|max:50',
        ]);

        $user = User::findOrFail($request->user_id);
        
        // Create wallet if it doesn't exist
        if (!$user->wallet) {
            $user->wallet()->create(['balance' => 0]);
        } else {
            $wallet = $user->wallet;
        }

        if ($wallet->balance < $request->amount) {
            return back()->withErrors('Saldo tidak cukup untuk withdrawal');
        }

        $transaction = WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'withdraw',
            'amount' => $request->amount,
            'status' => 'completed',
            'description' => 'Admin Withdraw to: ' . $request->bank_account,
            'metadata' => json_encode(['bank_account' => $request->bank_account]),
        ]);

        // Update wallet balance
        $wallet->balance -= $request->amount;
        $wallet->save();

        return back()->with('success', 'Withdraw berhasil. Transaksi ID: ' . $transaction->id);
    }
}
