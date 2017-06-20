<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Config;
class DriverIfAuthenticated
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
      \Config::set('jwt.user','App\Driver');
      \Config::set('auth.providers.users.model', \App\Driver::class);
  try {

        Config::set('jwt.user','App\Driver');
        Config::set('auth.providers.users.model', \App\Driver::class);
        $user=JWTAuth::parseToken()->authenticate();
      if (! $user) {
          return response()->json(['user_not_found'], 404);
      }

  } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

      return response()->json(['token_expired'], $e->getStatusCode());

  } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

      return response()->json(['token_invalid'], $e->getStatusCode());

  } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

      return response()->json(['token_absent'], $e->getStatusCode());

  }

  return $next($request);
    }

}
