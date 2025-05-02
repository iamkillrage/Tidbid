<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
            $userId = Session::get('user_id');
      
      
        $checkUserStatus = User::where('id', $userId)->where('status', 'Inactive')->first();
      
        if (!empty($checkUserStatus)) {
            Session::flush();
            return Redirect::route('SignIn');
        }

        return $next($request);
    }
}
