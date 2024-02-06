<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TrxController extends Controller
{
    /**
     * Display all member's list form.
     */
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


}
