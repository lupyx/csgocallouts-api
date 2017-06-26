<?php

namespace App\Http\Middleware;

use App\Entities\User;
use Carbon\Carbon;
use App\Entities\Auth\SteamSession;
use Closure;

class SteamAuth
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
        if($request->headers->has('SteamAuthentication'))
        {
            $sessionToken = $request->headers->get('SteamAuthentication');
            $session = SteamSession::where('token', $sessionToken)->orderBy('expires', 'desc')->first();

            if($session && ((int) $session->expires > time()))
            {
                $request->attributes->add(['steamUser' => $session->user]);

                return $next($request);
            }
        }

        return response('Unauthorized', 401);
    }
}
