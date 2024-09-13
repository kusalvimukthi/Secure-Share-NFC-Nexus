<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()->getName() !== 'user.verifyEmail') {
            $user = Auth::user();
            Session::put(['auth_user_id' => $user->id]);
            Log::info('test');
            if ($user && $user->hasRole('customer') && $user->email_verified_at === null) {
                return redirect()->route('user.infoVerifyEmail');
            }
        }
        return $next($request);
    }
}
