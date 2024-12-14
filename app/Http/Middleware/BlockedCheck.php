<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BlockedCheck
{
  public function handle(Request $request, Closure $next): Response
  {
    if(Auth::check() && ($request->user()->status == 'blocked' || $request->user()->status == 'pending')) {
      return redirect('blocked');
    }
    return $next($request);
  }
}