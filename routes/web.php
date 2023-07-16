<?php
  use App\Http\Controllers\CategoryController;
  use App\Http\Controllers\ContactController;
  use App\Http\Controllers\Controller;
  use App\Http\Controllers\LocationController;
  use App\Http\Controllers\MailController;
  use App\Http\Controllers\PropertyController;
  use App\Http\Controllers\Auth\LoginController;
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
  Route::get('/', [ Controller::class, 'index', ])
    ->name('index');

  Route::get('/contact', [ ContactController::class, 'read', ])
    ->name('contact.read');

// * MailController - Controls the sending mails.
  Route::post('/mail/contact', [ MailController::class, 'contact', ])
    ->name('mail.contact');

  Route::middleware('property')
    ->group(function () {
      Route::post('/mail/query/properties/{slug}', [ MailController::class, 'query', ])
        ->name('mail.query');
    });

// * Auth \ LoginController - Controls the authentication.
  Route::post('/login', [ LoginController::class, 'login', ])
    ->name('auth.login');

  Route::post('/login/check', [ LoginController::class, 'check', ])
    ->name('auth.check');

  Route::middleware('auth')
    ->group(function () {
      Route::get('/logout', [ LoginController::class, 'logout', ])
        ->name('auth.logout');
    });

// * CategoryController - Controls the Category.
  Route::get('/categories', [ CategoryController::class, 'list', ])
  ->name('panel.category.list');

  Route::middleware('category')
    ->group(function () {
      Route::get('/categories/{slug}', [ CategoryController::class, 'read', ])
        ->name('panel.category.read');
    });

  Route::middleware('auth')
    ->group(function () {
      Route::post('/categories/create', [ CategoryController::class, 'create', ])
        ->name('panel.category.create');

      Route::middleware('category')
        ->group(function () {
          Route::put('/categories/{slug}/update', [ CategoryController::class, 'update', ])
            ->name('panel.category.update');

          Route::delete('/categories/{slug}/delete', [ CategoryController::class, 'delete', ])
            ->name('panel.category.delete');
        });
    });

// * LocationController - Controls the Location.
  Route::get('/locations', [ LocationController::class, 'list', ])
    ->name('panel.location.list');

  Route::middleware('location')
    ->group(function () {
      Route::get('/locations/{slug}', [ LocationController::class, 'read', ])
        ->name('panel.location.read');
    });

  Route::middleware('auth')
    ->group(function () {
      Route::post('/locations/create', [ LocationController::class, 'create', ])
        ->name('panel.location.create');

      Route::middleware('location')
        ->group(function () {
          Route::put('/locations/{slug}/update', [ LocationController::class, 'update', ])
            ->name('panel.location.update');

          Route::delete('/locations/{slug}/delete', [ LocationController::class, 'delete', ])
            ->name('panel.location.delete');

          Route::put('/locations/{slug}/favorite', [ LocationController::class, 'fav', ])
            ->name('panel.location.fav');
        });
    });

// * PropertyController - Controls the Property.
  Route::get('/properties', [ PropertyController::class, 'list', ])
    ->name('panel.property.list');

  Route::middleware('property')
    ->group(function () {
      Route::get('/properties/{slug}', [ PropertyController::class, 'read', ])
        ->name('panel.property.read');
    });

  Route::middleware('auth')
    ->group(function () {
    Route::post('/properties/create', [ PropertyController::class, 'create', ])
      ->name('panel.property.create');

    Route::middleware('property')
      ->group(function () {
        Route::put('/properties/{slug}/update', [ PropertyController::class, 'update', ])
          ->name('panel.property.update');

        Route::delete('/properties/{slug}/delete', [ PropertyController::class, 'delete', ])
          ->name('panel.property.delete');

        Route::put('/properties/{slug}/favorite', [ PropertyController::class, 'fav', ])
          ->name('panel.property.fav');
      });
  });