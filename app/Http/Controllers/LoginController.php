<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request, $type)
    {
        if ($type == "admin") {
            $this->validate($request, ['nip' => 'required', 'password' => 'required']);
        } else {
            $this->validate($request, ['nim' => 'required', 'password' => 'required']);
        }

        $check = ($type == "admin") ? Admin::where('nip', $request->nip)->first() : Mahasiswa::where('nim', $request->nim)->first();

        if ($check != null && Hash::check($request->password, $check->password)) {
            session([
                'is_login' => true,
                'user' => $check,
                'type' => $type
            ]);

            if ($type == "admin") {
                return redirect('/responden');
            }

            return redirect('/kuesioner');

        }

        return redirect()->back()->with('error', 'Data login tidak ditemukan');
    }
}
