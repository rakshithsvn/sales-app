<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LinkUser;
use Carbon\Carbon;

class checkTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if ($request->input('token') !== 'my-secret-token') {
        //     return redirect('home');
        // }
              
        $errorResponse = response([
            'message' => 'Unauthenticated'
        ], 401);

        $token = $request->bearerToken() ? $request->bearerToken() : $request->input('token');
        $id = $request->input('id');

        if(!$token) {
            return $errorResponse;
        }

        $tokenSplit = explode('_', $token);

        if(count($tokenSplit) !== 2 || $id !== $tokenSplit[1]) {
            return $errorResponse;
        }

        $accessToken = LinkUser::whereRaw("BINARY `access_token`= ?",[$token])->where('event_id', $tokenSplit[1])->first();

        if(!$accessToken) {
            return $errorResponse;
        }

        // delete token if expired
        if(Carbon::now() >= Carbon::parse($accessToken->expires_on)) {
            $accessToken->access_token = null;
            $accessToken->expires_on = null;
            $accessToken->update();
            $accessToken = null;
        }

        if(!$accessToken) {
            return $errorResponse;
        }

        return $next($request);
    }
}
