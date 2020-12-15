<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email'=> 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        $referral_code = Str::random(10);

        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => $referral_code
        ]);

        $user->wallet()->create([
            'balance' => 0
        ]);

        if (!empty($request->referral_code)) {
            // get user with referral code
            $referral_user = User::where('referral_code', $request->referral_code)->first();
            // find user account
            $referral_user_account_balance = Wallet::where('user_id', $referral_user->id)->first();
            // compute addition of 1000 for referral code use
            $bonus = $referral_user_account_balance->balance + 1000;
            // update user balance
            $referral_user_account_balance->balance = $bonus;
            // save the data
            $referral_user_account_balance->save();
        }

        auth()->attempt($request->only('email', 'password'));
        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
