<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthPetugasPuskesmas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        if (Auth::user()->role == 'super_admin') {
            return redirect('admin/dashboard');
        }
        if (Auth::user()->role == 'petugas_desa') {
            return redirect('petugas_desa/dashboard');
        }
        if (Auth::user()->role == 'dinas_kesehatan') {
            return redirect('dinas_kesehatan/dashboard');
        }
    
        if (Auth::user()->role == 'petugas_puskesmas') {
            return $next($request);
        }
    }
}
