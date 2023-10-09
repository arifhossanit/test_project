<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->paginate(15);
        return view('welcome', [
            'transaction' => $transaction
        ]);
    }
}
