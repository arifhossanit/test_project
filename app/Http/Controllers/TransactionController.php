<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction; 
use App\Models\User; 

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->paginate(15);
        return view('welcome', [
            'transaction' => $transaction
        ]);
    }

    public function show_deposit() {
        $transaction = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where([
            ['transaction_type', '=', 'deposit']
        ])->paginate(15);
        $users = User::get();
        return view('transaction.deposit', [
            'transaction' => $transaction,
            'users' => $users
        ]);
    }

    public  function save_deposit(Request $request) {

        $transaction = new Transaction;
        $transaction->user_id = $request->input('user_id');
        $transaction->transaction_type = 'deposit';
        $transaction->amount = $request->input('amount');
        $transaction->date =  date('Y-m-d');
        $transaction->save();

        DB::table('users')->where('id', $request->input('user_id'))->increment('balance', $request->input('amount'));
        return redirect('/deposit')->with('success', 'Deposit added successfully!');
    }

    public function show_withdrawal() {
        $transaction = Transaction::join('users', 'users.id', '=', 'transactions.user_id')->where([
            ['transaction_type', '=', 'withdrawal']
        ])->paginate(15);
        $users = User::get();
        return view('transaction.withdrawal', [
            'transaction' => $transaction,
            'users' => $users
        ]);
    }

    public  function save_withdrawal(Request $request) {
        $users = User::select('*')
             ->where([
                 ['id', '=', $request->input('user_id')]
             ])
             ->first();

        $day = date('l');
        if($day == 'Friday'){
            $fee = 0;
        }elseif ($request->input('amount')<=1000) {
            $fee = 0;
        }elseif ($users->account_type=='Individual') {
            $fee = $request->input('amount') * (0.015/100);
        }else {
            $fee = $request->input('amount') * (0.025/100);
        }
        $balance = $request->input('amount') + $fee;

        $transaction = new Transaction;
        $transaction->user_id = $request->input('user_id');
        $transaction->transaction_type = 'withdrawal';
        $transaction->amount = $request->input('amount');
        $transaction->fee =  $fee;
        $transaction->date =  date('Y-m-d');
        $transaction->save();

        DB::table('users')->where('id', $request->input('user_id'))->decrement('balance', $balance);
        return redirect('/withdrawal')->with('success', 'Withdrawal Successfull!');
    }
}
