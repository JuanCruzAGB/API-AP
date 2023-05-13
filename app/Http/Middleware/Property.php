<?php
  namespace App\Http\Middleware;

  use Closure;

  class Property {
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle ($request, Closure $next) {
      if (!\App\Models\Property::bySlug($request->slug)->first()) abort(404, 'Property does not exist.');

      return $next($request);
    }
  }