<?php
  use Illuminate\Support\Facades\Route;

// * Controller - Controls the web in general.
  Route::get('/', 'Controller@index')
    ->name('index');

  Route::get('/panel', 'Controller@panel')
    ->name('panel');

// * MailController - Controls the sending mails.
  Route::post('/mail/contact', 'MailController@contact')
    ->name('mail.contact');

  Route::middleware('property')
    ->group(function () {
      Route::post('/mail/query/properties/{slug}', 'MailController@query')
        ->name('mail.query');
    });

// * Auth \ LoginController - Controls the authentication.
  Route::get('/login', 'Auth\LoginController@showLogin')
    ->name('auth.login.show');

  Route::post('/login', 'Auth\LoginController@doLogin')
    ->name('auth.login.do');

  Route::middleware('auth')
    ->group(function () {
      Route::get('/logout', 'Auth\LoginController@doLogout')
        ->name('auth.logout.do');
    });

// * API \ CategoryController - Controls the Category.
  Route::middleware('auth')
    ->group(function () {
      Route::get('/api/categories', 'API\CategoryController@index')
        ->name('panel.category.index');

      Route::post('/api/categories/create', 'API\CategoryController@doCreate')
        ->name('panel.category.create.do');

      Route::middleware('category')
        ->group(function () {
          Route::get('/api/categories/{slug}', 'API\CategoryController@details')
            ->name('panel.category.details');

          Route::put('/api/categories/{slug}/update', 'API\CategoryController@doUpdate')
            ->name('panel.category.update.do');

          Route::delete('/api/categories/{slug}/delete', 'API\CategoryController@doDelete')
            ->name('panel.category.delete.do');
        });
    });

// * API \ LocationController - Controls the Location.
  Route::middleware('auth')
    ->group(function () {
      Route::get('/api/locations', 'API\LocationController@index')
        ->name('panel.location.index');

      Route::post('/api/locations/create', 'API\LocationController@doCreate')
        ->name('panel.location.create.do');

      Route::middleware('location')
        ->group(function () {
          Route::get('/api/locations/{slug}', 'API\LocationController@details')
            ->name('panel.location.details');

          Route::put('/api/locations/{slug}/update', 'API\LocationController@doUpdate')
            ->name('panel.location.update.do');

          Route::delete('/api/locations/{slug}/delete', 'API\LocationController@doDelete')
            ->name('panel.location.delete.do');

          Route::put('/api/locations/{slug}/favorite', 'API\LocationController@doFav')
            ->name('panel.location.fav.do');
        });
    });

// * API \ PropertyController - Controls the Property.
  Route::middleware('auth')
    ->group(function () {
    Route::get('/api/properties', 'API\PropertyController@index')
      ->name('panel.property.index');

    Route::post('/api/properties/create', 'API\PropertyController@doCreate')
      ->name('panel.property.create.do');

    Route::middleware('property')
      ->group(function () {
        Route::get('/api/properties/{slug}', 'API\PropertyController@details')
          ->name('panel.property.details');

        Route::put('/api/properties/{slug}/update', 'API\PropertyController@doUpdate')
          ->name('panel.property.update.do');

        Route::delete('/api/properties/{slug}/delete', 'API\PropertyController@doDelete')
          ->name('panel.property.delete.do');

        Route::put('/api/properties/{slug}/favorite', 'API\PropertyController@doFav')
          ->name('panel.property.fav.do');
      });
  });