<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function postlogin(Request $request)
    {

        $input = $request->all();

        $rules = [

            'nama_pengguna'     => 'required',
            'password'  => 'required',

        ];
        // error message untuk validasi
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];
        // instansiasi validator
        $validator = Validator::make($request->all(), $rules, $message);

        // proses validasi
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }



        if (User::where('nama_pengguna', '=', $input['nama_pengguna'])->first() == true) {
            if (auth()->attempt(array('nama_pengguna' => $input['nama_pengguna'], 'password' => $input['password']))) {
            
                   
                switch (Auth::user()->role) {
                    case 'super_admin':
                        return redirect('/admin/dashboard');
                        break;
                    case 'petugas_puskesmas':
                        return redirect('/');
                        break;
                    case 'petugas_desa':
                        return redirect('/');
                        break;
                    default:
                        return redirect('/');
                        break;
                }
            } else {
                return redirect()->back()
                    ->with('error', 'Kata sandi salah');
            }
        } else {
            return redirect()->back()
                ->with('error', 'nama pengguna tidak ada atau belum terdaftar');
        }
    }

    public function logout()
    {

        Auth::logout();
        return redirect('/');
    }
}
