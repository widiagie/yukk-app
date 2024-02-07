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
use Illuminate\Support\Facades\Storage;

class TrxController extends Controller
{
    /**
     * Display all transaction's form.
     */
    public function topup(): View
    {
        return view('transaction.trx');
    }

    public function trxlist(Request $request): View
    {
        $id = Auth::user()->id;
        $user = DB::table('users')
            ->where('id', $id)
            ->first();
        
        if ($user->id === $id) {
            $trx = DB::table('transactions');
            $trx = $trx->where('trx_user_id' , '=' , $id);
            if($request->t) {
                $trx = $trx->where('trx_type', '=', $request->t);
            }
            if($request->q) {
                $trx = $trx->where('trx_code', 'like', "%{$request->q}%");
                $trx = $trx->orWhere('trx_description', 'like', "%{$request->q}%");
            }
                
            $trx = $trx->orderBy('created_at', 'desc');
            $trx = $trx->paginate(5);

            $topupSum = DB::table('transactions')
                ->where(['trx_type' => 'topup', 'trx_user_id' => $id])
                ->sum('trx_amount');
            $paySum = DB::table('transactions')
                ->where(['trx_type' => 'pay', 'trx_user_id' => $id])
                ->sum('trx_amount');

            $balance = $topupSum - $paySum;

            return view('profile.transaction', 
                [   
                    'transaction' => $trx, 
                    'balance' => $balance,
                    'filter' => $request->t,
                ]);
        }

        return view('notfound');
    }

    /**
     * Update Transaction form.
     */
    public function store(Request $request) : RedirectResponse
    {
        $id = Auth::user()->id;
    
        $path = Storage::putFile('trxFiles', $request->file('trx_file'));
        $fileName = basename($path);

        Transaction::create([
            'trx_user_id' => $id,
            'trx_code' => 'TRX-'.$request->trx_type.'-'.rand(),
            'trx_type' => $request->trx_type,
            'trx_amount' => $request->trx_amount,
            'trx_description' => $request->trx_description,
            'trx_file' => $fileName,
        ]);

        return Redirect::route('topup.store')->with('status', 'profile-updated');
    }


}
