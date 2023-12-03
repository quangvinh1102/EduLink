<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirebaseAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        config([
            'services.firebase.api_key' => env('FIREBASE_API_KEY'),
            'services.firebase.auth_domain' => env('FIREBASE_AUTH_DOMAIN'),
            'services.firebase.database_url' => env('FIREBASE_DATABASE_URL'),
            'services.firebase.project_id' => env('FIREBASE_PROJECT_ID'),
            'services.firebase.storage_bucket' => env('FIREBASE_STORAGE_BUCKET'),
            'services.firebase.messaging_sender_id' => env('FIREBASE_MESSAGING_SENDER_ID'),
            'services.firebase.app_id' => env('FIREBASE_APP_ID'),
        ]);

        return $next($request);
    }
}
