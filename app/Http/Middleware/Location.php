<?php
  namespace App\Http\Middleware;

  use Closure;

  class Location {
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle ($request, Closure $next) {
      if (!\App\Models\Location::bySlug($request->slug)->first()) abort(404, 'Location does not exist.');

      return $next($request);
    }
  }