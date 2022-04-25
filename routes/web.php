<?php
    use Illuminate\Support\Facades\Route;
    
// * AuthController - Controls the authentication.
    Route::get('/login', 'AuthController@showLogin')->name('auth.showLogin');
    Route::post('/login', 'AuthController@doLogin')->name('auth.doLogin');
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', 'AuthController@dashboard')->name('auth.dashboard');
        Route::get('/logout', 'AuthController@doLogout')->name('auth.doLogout');
        Route::get('/panel', 'AuthController@dashboard')->name('auth.panel');
    });
    
// * CategoryController - Controls the Category.
    Route::middleware('auth')->group(function () {
        Route::get('/categories/table', 'CategoryController@table')->name('category.table');
        Route::get('/categories/create', 'CategoryController@showCreate')->name('category.showCreate');
        Route::post('/categories/create', 'CategoryController@doCreate')->name('category.doCreate');
        Route::middleware('category')->group(function () {
            Route::get('/categories/{slug}/update', 'CategoryController@showUpdate')->name('category.showUpdate');
            Route::put('/categories/{slug}/update', 'CategoryController@doUpdate')->name('category.doUpdate');
            Route::delete('/categories/{slug}/delete', 'CategoryController@doDelete')->name('category.doDelete');
        });
    });
    
// * Controller - Controls the web in general.
    Route::get('/', 'Controller@index')->name('web.index');
    Route::get('/home', 'Controller@home')->name('web.home');
    Route::get('/coming-soon', 'Controller@comingSoon')->name('web.coming_soon');
    Route::get('/thank-you', 'Controller@thanks')->name('web.thanks');
    
// * LocationController - Controls the Location.
    Route::middleware('auth')->group(function () {
        Route::get('/locations/table', 'LocationController@table')->name('location.table');
        Route::get('/locations/create', 'LocationController@showCreate')->name('location.showCreate');
        Route::post('/locations/create', 'LocationController@doCreate')->name('location.doCreate');
        Route::middleware('location')->group(function () {
            Route::get('/locations/{slug}/update', 'LocationController@showUpdate')->name('location.showUpdate');
            Route::put('/locations/{slug}/update', 'LocationController@doUpdate')->name('location.doUpdate');
            Route::delete('/locations/{slug}/delete', 'LocationController@doDelete')->name('location.doDelete');
            Route::put('/locations/{slug}/favorite', 'LocationController@doFav')->name('location.doFav');
        });
    });
    
// * MailController - Controls the sending mails.
    Route::post('/contact', 'MailController@contact')->name('mail.contact');
    Route::middleware('property')->group(function () {
        Route::post('/query/properties/{slug}', 'MailController@query')->name('mail.query');
    });

// * PropertyController - Controls the Property.
    Route::get('/properties', 'PropertyController@list')->name('property.list');
    Route::middleware('property')->group(function () {
        Route::get('/properties/{slug}/details', 'PropertyController@item')->name('property.item');
    });
    Route::middleware('auth')->group(function () {
        Route::get('/properties/table', 'PropertyController@table')->name('property.table');
        Route::get('/properties/create', 'PropertyController@showCreate')->name('property.showCreate');
        Route::post('/properties/create', 'PropertyController@doCreate')->name('property.doCreate');
        Route::middleware('property')->group(function () {
            Route::get('/properties/{slug}/folder', 'PropertyController@showFolder')->name('property.showFolder');
            Route::put('/properties/{slug}/folder/update', 'PropertyController@doFolder')->name('property.doFolder');
            Route::get('/properties/{slug}/update', 'PropertyController@showUpdate')->name('property.showUpdate');
            Route::put('/properties/{slug}/update', 'PropertyController@doUpdate')->name('property.doUpdate');
            Route::delete('/properties/{slug}/delete', 'PropertyController@doDelete')->name('property.doDelete');
        });
    });