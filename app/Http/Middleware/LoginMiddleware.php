<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\InfluencerIdVerification;
class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

       
        
        if($request->ajax() && !$request->session()->has('user_id')){
            return response()->json(['login_status' => 'false']);
        } else {
         //   dd("Xcccccccccccc");
        if(!$request->session()->has('user_id'))
        {
            return redirect('/influencer-signIn');
        }
    }
        return $next($request);
    }
}
