<?php
    use Illuminate\Support\Facades\Route;
    
// * AuthController - Controls the authentication.
    Route::get("/iniciar-sesion", "AuthController@showLogin")->name("auth.showLogin");
    Route::post("/login", "AuthController@doLogin")->name("auth.doLogin");
    Route::middleware("auth")->group(function () {
        Route::get("/cerrar-sesion", "AuthController@doLogout")->name("auth.doLogout");
    });
    
// * DefaultController - Controls the web in general.
    Route::get("/", "Controller@index")->name("web.index");
    Route::get("/inicio", "DefaultController@home")->name("web.home");
    Route::get("/proximamente", "DefaultController@comingSoon")->name("web.coming_soon");
    Route::get("/dashboard", "DefaultController@dashboard")->name("web.dashboard");
    Route::middleware("auth")->group(function () {
        Route::get("/panel", "DefaultController@panel")->name("web.panel");
    });
    Route::get("/gracias", "DefaultController@thanks")->name("web.thanks");
    
// * MailController - Controls the sending mails.
    Route::post("/contactar", "MailController@contact")->name("mail.contact");
    Route::post("/consultar/propiedad/{slug}", "MailController@query")->name("mail.query");

// * PropertyController - Controls the Property.
    Route::get("/propiedades", "PropertyController@list")->name("property.list");
    Route::get("/propiedad/{slug}/detalles", "PropertyController@item")->name("property.item");
    Route::middleware("auth")->group(function () {
        Route::post("/propiedad/crear", "PropertyController@doCreate")->name("property.doCreate");
        Route::put("/propiedad/{slug}/actualizar", "PropertyController@doUpdate")->name("property.doUpdate");
        Route::delete("/propiedad/{slug}/borrar", "PropertyController@doDelete")->name("property.doDelete");
    
// * CategoryController - Controls the Category.
        Route::post("/categoria/crear", "CategoryController@doCreate")->name("category.doCreate");
        Route::put("/categoria/{slug}/actualizar", "CategoryController@doUpdate")->name("category.doUpdate");
        Route::delete("/categoria/{slug}/borrar", "CategoryController@doDelete")->name("category.doDelete");
    
// * LocationController - Controls the Location.
        Route::post("/ubicacion/crear", "LocationController@doCreate")->name("location.doCreate");
        Route::put("/ubicacion/{slug}/actualizar", "LocationController@doUpdate")->name("location.doUpdate");
        Route::delete("/ubicacion/{slug}/borrar", "LocationController@doDelete")->name("location.doDelete");
        Route::put("/ubicacion/{slug}/favorito", "LocationController@doFav")->name("location.doFav");
    });