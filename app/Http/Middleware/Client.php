<?php
namespace App\Http\Middleware;


use App\Entity\User\User;
use Illuminate\Support\Facades\Auth;

class Client
{

    public function handle($request, \Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isClient()) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }

}
