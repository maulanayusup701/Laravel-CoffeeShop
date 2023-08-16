<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getTransactionToDay()
    {
        $today = now()->format('Y-m-d');
        $transactionsToday = Transaction::whereDate('date_transaction', $today)->get();
        $totalPriceToday = 0;

        foreach ($transactionsToday as $transaction) {
            $totalPriceToday += $transaction->total_price;
        }

        return $totalPriceToday;
    }

    public function getTransactionThisMonth()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $transactionsThisMonth = Transaction::whereBetween('date_transaction', [$startOfMonth, $endOfMonth])->get();
        $totalTransactionsThisMonth = $transactionsThisMonth->count();

        $totalPriceThisMonth = 0;

        foreach ($transactionsThisMonth as $transaction) {
            $totalPriceThisMonth += $transaction->total_price;
        }

        return $totalPriceThisMonth;
    }

    public function getTotalTransactionToday()
    {
        $today = now()->format('Y-m-d');
        $transactionsToday = Transaction::whereDate('date_transaction', $today)->count();

        return $transactionsToday;
    }

    public function getTotalTransactionThisMonth()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $totalTransactionsThisMonth = Transaction::whereBetween('date_transaction', [$startOfMonth, $endOfMonth])->count();

        return $totalTransactionsThisMonth;
    }
}
