<?php
  use Illuminate\Support\Facades\Route;

  /*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
  */

// * Controller - Controls the web in general.
  Route::get('/', 'Controller@index')
    ->name('index');

// * MailController - Controls the sending mails.
  Route::post('/mail/contact', 'MailController@contact')
    ->name('mail.contact');

  Route::middleware('property')
    ->group(function () {
      Route::post('/mail/query/properties/{slug}', 'MailController@query')
        ->name('mail.query');
    });

// * Auth \ LoginController - Controls the authentication.
  Route::post('/login', 'Auth\LoginController@login')
    ->name('auth.login');

  Route::post('/login/check', 'Auth\LoginController@check')
    ->name('auth.check');

  Route::middleware('auth')
    ->group(function () {
      Route::get('/logout', 'Auth\LoginController@logout')
        ->name('auth.logout');
    });

// * CategoryController - Controls the Category.
  Route::middleware('auth')
    ->group(function () {
      Route::get('/categories', 'CategoryController@list')
        ->name('panel.category.list');

      Route::post('/categories/create', 'CategoryController@create')
        ->name('panel.category.create');

      Route::middleware('category')
        ->group(function () {
          Route::get('/categories/{slug}', 'CategoryController@read')
            ->name('panel.category.read');

          Route::put('/categories/{slug}/update', 'CategoryController@update')
            ->name('panel.category.update');

          Route::delete('/categories/{slug}/delete', 'CategoryController@delete')
            ->name('panel.category.delete');
        });
    });

// * LocationController - Controls the Location.
  Route::middleware('auth')
    ->group(function () {
      Route::get('/locations', 'LocationController@list')
        ->name('panel.location.list');

      Route::post('/locations/create', 'LocationController@create')
        ->name('panel.location.create');

      Route::middleware('location')
        ->group(function () {
          Route::get('/locations/{slug}', 'LocationController@read')
            ->name('panel.location.read');

          Route::put('/locations/{slug}/update', 'LocationController@update')
            ->name('panel.location.update');

          Route::delete('/locations/{slug}/delete', 'LocationController@delete')
            ->name('panel.location.delete');

          Route::put('/locations/{slug}/favorite', 'LocationController@fav')
            ->name('panel.location.fav');
        });
    });

// * PropertyController - Controls the Property.
  Route::middleware('auth')
    ->group(function () {
    Route::get('/properties', 'PropertyController@list')
      ->name('panel.property.list');

    Route::post('/properties/create', 'PropertyController@create')
      ->name('panel.property.create');

    Route::middleware('property')
      ->group(function () {
        Route::get('/properties/{slug}', 'PropertyController@read')
          ->name('panel.property.read');

        Route::put('/properties/{slug}/update', 'PropertyController@update')
          ->name('panel.property.update');

        Route::delete('/properties/{slug}/delete', 'PropertyController@delete')
          ->name('panel.property.delete');

        Route::put('/properties/{slug}/favorite', 'PropertyController@fav')
          ->name('panel.property.fav');
      });
  });