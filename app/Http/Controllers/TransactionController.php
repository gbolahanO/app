<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function instant()
    {
        return view('user.transaction.instant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scheduled()
    {
        return view('user.transaction.scheduled');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:40',
            'amount' => 'required|integer|min:0'
        ]);

        $user_balance = auth()->user()->wallet->balance;

        if($request->amount > $user_balance) {
            return redirect()->back()->with('status', 'Insufficient Funds');
        }

        if($request->email == auth()->user()->email) {
            return redirect()->back()->with('invalid', 'Invalid Transaction Type');
        }

        $credit_user = User::where('email', $request->email)->first();
        if (!$credit_user) {
            return redirect()->back()->with('info', 'User does not exists');
        }

        if ($request->amount > 50000 && auth()->user()->kyc_level != "1") {
            return redirect()->back()->with('info', 'Please upgrade your account for transactions larger than 50,000');
        }

        // Find auth user wallet to carry transaction on
        $auth_user_wallet = Wallet::where('user_id', auth()->user()->id)->first();

        // Find account to be credited
        $credit_user_wallet = Wallet::where('user_id', $credit_user->id)->first();

        // get auth user balance
        $auth_user_balance = $auth_user_wallet->balance;
        // compute debit
        $new_balance = $auth_user_balance - $request->amount;
        $auth_user_wallet->balance = $new_balance;
        // update user wallet
        $auth_user_wallet->save();

        // compute account to be credited
        $credit = $credit_user_wallet->balance + $request->amount;
        $credit_user_wallet->balance = $credit;
        // update credited account
        $credit_user_wallet->save();


        return redirect()->route('transfer')->with('status', 'Transaction successful');

        // return view('user.transaction.instant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delay(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:40',
            'scheduled_date' => 'required'
        ]); 

        return redirect()->route('transfer')->with('status', 'Transaction successful');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upgrade(Request $request)
    {

        $this->validate($request, [
            'identity' => 'required'
        ]);

        $user = User::find(auth()->user()->id)->first();
        $user->kyc_level = "1";
        $user->save();
        return redirect()->back()->with('success', 'Transaction Limit Upgraded');
    }

}
