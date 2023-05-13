<?php
  namespace App\Http\Middleware;

  use Closure;

  class Category {
    /**
     * * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle ($request, Closure $next) {
      if (!\App\Models\Category::bySlug($request->slug)->first()) abort(404, 'Category does not exist.');

      return $next($request);
    }
  }