<?php
    use Illuminate\Support\Facades\Route;
    
// * AuthController - Controls the authentication.
    Route::get("/login", "AuthController@showLogin")->name("auth.showLogin");
    Route::post("/login", "AuthController@doLogin")->name("auth.doLogin");
    Route::middleware("auth")->group(function () {
        Route::get("/logout", "AuthController@doLogout")->name("auth.doLogout");
    });
    
// * DefaultController - Controls the web in general.
    Route::get("/", "Controller@index")->name("web.index");
    Route::get("/home", "DefaultController@home")->name("web.home");
    Route::get("/coming-soon", "DefaultController@comingSoon")->name("web.coming_soon");
    Route::get("/dashboard", "DefaultController@dashboard")->name("web.dashboard");
    Route::middleware("auth")->group(function () {
        Route::get("/panel", "DefaultController@panel")->name("web.panel");
    });
    Route::get("/thank-you", "DefaultController@thanks")->name("web.thanks");
    
// * MailController - Controls the sending mails.
    Route::post("/contact", "MailController@contact")->name("mail.contact");
    Route::post("/query/properties/{slug}", "MailController@query")->name("mail.query");

// * PropertyController - Controls the Property.
    Route::get("/properties", "PropertyController@list")->name("property.list");
    Route::get("/properties/{slug}/details", "PropertyController@item")->name("property.item");
    Route::middleware("auth")->group(function () {
        Route::post("/properties/create", "PropertyController@doCreate")->name("property.doCreate");
        Route::put("/properties/{slug}/update", "PropertyController@doUpdate")->name("property.doUpdate");
        Route::delete("/properties/{slug}/delete", "PropertyController@doDelete")->name("property.doDelete");
    
// * CategoryController - Controls the Category.
        Route::post("/category/create", "CategoryController@doCreate")->name("category.doCreate");
        Route::put("/category/{slug}/update", "CategoryController@doUpdate")->name("category.doUpdate");
        Route::delete("/category/{slug}/delete", "CategoryController@doDelete")->name("category.doDelete");
    
// * LocationController - Controls the Location.
        Route::post("/location/create", "LocationController@doCreate")->name("location.doCreate");
        Route::put("/location/{slug}/update", "LocationController@doUpdate")->name("location.doUpdate");
        Route::delete("/location/{slug}/delete", "LocationController@doDelete")->name("location.doDelete");
        Route::put("/location/{slug}/favorite", "LocationController@doFav")->name("location.doFav");
    });