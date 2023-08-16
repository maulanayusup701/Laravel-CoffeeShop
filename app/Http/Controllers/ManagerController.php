<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ActivityHistory;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        $transaction = new Transaction();

        return view('dashboard.manager.dashboard', [
            'title' => 'Dashboard Manager',
            'total_products' => Product::count(),
            'total_category_products' => CategoryProduct::count(),
            'transaction_today' => $transaction->getTransactionToDay(),
            'total_transaction_today' => $transaction->getTotalTransactionToday(),
            'transaction_this_month' => $transaction->getTransactionThisMonth(),
            'total_transaction_this_month' => $transaction->getTotalTransactionThisMonth(),
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $activity = [
            'fullname' => $user->fullname,
            'position' => optional($user->position)->position_name,
            'action' => 'Logout',
            'description' => 'Logout Successfully',
        ];

        ActivityHistory::create($activity);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('logout', 'You have successfully logged out.');
    }

    public function activity()
    {
        return view('dashboard.manager.activityHistory', [
            'title' => 'Activity History',
            'activityHistories' => ActivityHistory::latest()->paginate(15),
        ]);
    }
}
