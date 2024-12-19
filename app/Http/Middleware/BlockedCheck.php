<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\View;

class BlockedCheck
{
  public function handle(Request $request, Closure $next): Response|View
  {
    if (Auth::check() && ($request->user()->status == 'blocked' || $request->user()->status == 'pending')) {
      return response()->view('auth.blocked');
    }
    return $next($request);
  }
}
