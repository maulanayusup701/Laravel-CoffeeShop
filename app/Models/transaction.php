<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function myTransactionFilterDate($startDate, $endDate)
    {
        $startDate && $endDate == null
            ? ($myTransactions = Transaction::where('user_id', Auth::user()->id)->paginate(15))
            : ($myTransactions = Transaction::where('user_id', Auth::user()->id)
                ->whereBetween('date_transaction', [$startDate, $endDate])
                ->paginate(15));

        return $myTransactions;
    }
}
