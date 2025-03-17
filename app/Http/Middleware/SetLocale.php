<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Get the locale from the first segment
        $locale = $request->segment(1);

        // Check if the locale is supported
        if( in_array($locale, config('app.locales')) ) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        else {
            // Handle unsupported locales (e.g., redirect to the default locale)
            return redirect('/es/invalid-locale');
        }
        return $next($request);
    }
}
