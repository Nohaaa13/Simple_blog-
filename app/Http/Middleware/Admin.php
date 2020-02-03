<?php

namespace App\Http\Middleware;

use App\Entity\User\User;
use Illuminate\Support\Facades\Auth;

class Admin
{

    public function handle($request, \Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if(!$user->isAdmin()) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }

}
