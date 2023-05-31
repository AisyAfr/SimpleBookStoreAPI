<?php

namespace App\Http\Middleware;

use App\Models\Posts;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class penjual
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id_penjual = Posts::findOrfail($request->id);
        $user = Auth::user();
        if($id_penjual->penjual != $user->id){
            return response()->json('kamu bukanlah pemilik postingan');
        }
        return $next($request);
    }
}
