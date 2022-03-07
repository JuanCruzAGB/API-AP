<?php
    use Illuminate\Support\Facades\Route;
    
// * AuthController - Controls the authentication.
    Route::get('/login', 'AuthController@showLogin')->name('auth.showLogin');
    Route::post('/login', 'AuthController@doLogin')->name('auth.doLogin');
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', 'AuthController@dashboard')->name('auth.dashboard');
        Route::get('/logout', 'AuthController@doLogout')->name('auth.doLogout');
    });
    
// * Controller - Controls the web in general.
    Route::get('/', 'Controller@index')->name('web.index');
    Route::get('/home', 'Controller@home')->name('web.home');
    Route::get('/coming-soon', 'Controller@comingSoon')->name('web.coming_soon');
    Route::get('/thank-you', 'Controller@thanks')->name('web.thanks');
    
// * MailController - Controls the sending mails.
    Route::post('/contact', 'MailController@contact')->name('mail.contact');
    Route::post('/query/properties/{slug}', 'MailController@query')->name('mail.query');

// * PropertyController - Controls the Property.
    Route::get('/properties', 'PropertyController@list')->name('property.list');
    Route::middleware('property')->group(function () {
        Route::get('/properties/{slug}/details', 'PropertyController@item')->name('property.item');
    });
    Route::middleware('auth')->group(function () {
        Route::get('/property/table', 'PropertyController@table')->name('property.table');
        Route::get('/property/create', 'PropertyController@showCreate')->name('property.showCreate');
        Route::post('/property/create', 'PropertyController@doCreate')->name('property.doCreate');
        Route::middleware('property')->group(function () {
            Route::get('/property/{slug}/update', 'PropertyController@showUpdate')->name('property.showUpdate');
            Route::put('/property/{slug}/update', 'PropertyController@doUpdate')->name('property.doUpdate');
            Route::delete('/property/{slug}/delete', 'PropertyController@doDelete')->name('property.doDelete');
        });
    
// * CategoryController - Controls the Category.
        Route::get('/category/table', 'CategoryController@table')->name('category.table');
        Route::get('/category/create', 'CategoryController@showCreate')->name('category.showCreate');
        Route::post('/category/create', 'CategoryController@doCreate')->name('category.doCreate');
        Route::middleware('category')->group(function () {
            Route::get('/category/{slug}/update', 'CategoryController@showUpdate')->name('category.showUpdate');
            Route::put('/category/{slug}/update', 'CategoryController@doUpdate')->name('category.doUpdate');
            Route::delete('/category/{slug}/delete', 'CategoryController@doDelete')->name('category.doDelete');
        });
    
// * LocationController - Controls the Location.
        Route::get('/location/table', 'LocationController@table')->name('location.table');
        Route::get('/location/create', 'LocationController@showCreate')->name('location.showCreate');
        Route::post('/location/create', 'LocationController@doCreate')->name('location.doCreate');
        Route::middleware('location')->group(function () {
            Route::get('/location/{slug}/update', 'LocationController@showUpdate')->name('location.showUpdate');
            Route::put('/location/{slug}/update', 'LocationController@doUpdate')->name('location.doUpdate');
            Route::delete('/location/{slug}/delete', 'LocationController@doDelete')->name('location.doDelete');
            Route::put('/location/{slug}/favorite', 'LocationController@doFav')->name('location.doFav');
        });
    });