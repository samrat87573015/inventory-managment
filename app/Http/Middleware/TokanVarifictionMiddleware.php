<?php

namespace App\Http\Middleware;


use App\helper\JWTTokan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokanVarifictionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $tokan = $request->cookie('tokan');
        $result = JWTTokan::verifyToken($tokan);


        if($result == "unauthorized"){
             return redirect()->route('login');
        }else{
            $request->headers->set('userEmail', $result->userEmail);
            $request->headers->set('userID', $result->userID);
            return $next($request);
        }

    }
}
