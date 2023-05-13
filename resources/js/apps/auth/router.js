import VueRouter from "vue-router";

export default new VueRouter({
  mode: 'history',
  routes: [
    // 
  ],
});

// // * AuthController - Controls the authentication.
// Route::get('/login', 'AuthController@showLogin')->name('auth.showLogin');
// Route::post('/login', 'AuthController@doLogin')->name('auth.doLogin');
// Route::middleware('auth')->group(function () {
//   Route::get('/dashboard', 'AuthController@dashboard')->name('auth.dashboard');
//   Route::get('/logout', 'AuthController@doLogout')->name('auth.doLogout');
//   Route::get('/panel', 'AuthController@dashboard')->name('auth.panel');
// });