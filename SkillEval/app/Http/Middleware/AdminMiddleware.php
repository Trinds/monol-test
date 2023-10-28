<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AdminMiddleware
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
        if (auth()->user() && auth()->user()->isAdmin()) {
            return $next($request);
        }
        $user = $request->route('user');
        if ($user instanceof User && auth()->user() && $user->id == auth()->user()->id) {
            return $next($request);
        }

        return redirect('home')->with('error', 'Voce não tem permissões para aceder a essa página.');
    }

}
