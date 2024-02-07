<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TrxController extends Controller
{
    /**
     * Display all transaction's form.
     */
    public function topup(): View
    {
        return view('transaction.trx');
    }

    public function trxlist(): View
    {
        $admin = DB::table('users')
            ->where('email', 'widi@example.com')
            ->first();

        if ($admin) {
            $users = DB::table('users')->paginate(20);
            return view('profile.transaction', ['users' => $users]);
        }

        return view('notfound');
    }

    /**
     * Update Transaction form.
     */
    public function store(Request $request) : RedirectResponse
    {
        $id = Auth::user()->id;
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        // dd($request->trx_amount);

        Transaction::create([
            'trx_user_id' => $id,
            'trx_code' => 'TRX-'.rand(),
            'trx_type' => $request->trx_type,
            'trx_amount' => $request->trx_amount,
            'trx_description' => $request->trx_description,
            'trx_file' => $request->trx_file,
        ]);

        return Redirect::route('topup.store')->with('status', 'profile-updated');
    }


}
