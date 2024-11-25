<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
  public function handle(Request $request, Closure $next): Response
  {
    if (!Auth::check()|| !$request->user()->isAdmin())
    {
      return redirect(RouteServiceProvider::HOME);
    }
    return $next($request);
  }
}