<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, ['nip', 'password']);

        $check = Admin::where('nip', $request->nip)->first();

        if ($check != null && Hash::check($request->password, $check->password)) {
            session([
                'is_login' => true,
                'admin' => $check
            ]);

            return redirect('/responden');
        }

        return redirect()->back()->with('error', 'Data login tidak ditemukan');
    }
}
