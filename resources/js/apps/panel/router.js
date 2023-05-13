import VueRouter from "vue-router";

export default new VueRouter({
  mode: 'history',
  routes: [
    // 
  ],
});

// // * CategoryController - Controls the Category.
// Route::middleware('auth')->group(function () {
//   Route::get('/categories/table', 'CategoryController@table')->name('category.table');
//   Route::get('/categories/create', 'CategoryController@showCreate')->name('category.showCreate');
//   Route::post('/categories/create', 'CategoryController@doCreate')->name('category.doCreate');
//   Route::middleware('category')->group(function () {
//     Route::get('/categories/{slug}/update', 'CategoryController@showUpdate')->name('category.showUpdate');
//     Route::put('/categories/{slug}/update', 'CategoryController@doUpdate')->name('category.doUpdate');
//     Route::delete('/categories/{slug}/delete', 'CategoryController@doDelete')->name('category.doDelete');
//   });
// });

// // * LocationController - Controls the Location.
// Route::middleware('auth')->group(function () {
//   Route::get('/locations/table', 'LocationController@table')->name('location.table');
//   Route::get('/locations/create', 'LocationController@showCreate')->name('location.showCreate');
//   Route::post('/locations/create', 'LocationController@doCreate')->name('location.doCreate');
//   Route::middleware('location')->group(function () {
//     Route::get('/locations/{slug}/update', 'LocationController@showUpdate')->name('location.showUpdate');
//     Route::put('/locations/{slug}/update', 'LocationController@doUpdate')->name('location.doUpdate');
//     Route::delete('/locations/{slug}/delete', 'LocationController@doDelete')->name('location.doDelete');
//     Route::put('/locations/{slug}/favorite', 'LocationController@doFav')->name('location.doFav');
//   });
// });

// // * PropertyController - Controls the Property.
// Route::get('/properties', 'PropertyController@list')->name('property.list');
// Route::middleware('property')->group(function () {
//   Route::get('/properties/{slug}/details', 'PropertyController@item')->name('property.item');
// });
// Route::middleware('auth')->group(function () {
//   Route::get('/properties/table', 'PropertyController@table')->name('property.table');
//   Route::get('/properties/create', 'PropertyController@showCreate')->name('property.showCreate');
//   Route::post('/properties/create', 'PropertyController@doCreate')->name('property.doCreate');
//   Route::middleware('property')->group(function () {
//     Route::get('/properties/{slug}/folder', 'PropertyController@showFolder')->name('property.showFolder');
//     Route::put('/properties/{slug}/folder/update', 'PropertyController@doFolder')->name('property.doFolder');
//     Route::get('/properties/{slug}/update', 'PropertyController@showUpdate')->name('property.showUpdate');
//     Route::put('/properties/{slug}/update', 'PropertyController@doUpdate')->name('property.doUpdate');
//     Route::delete('/properties/{slug}/delete', 'PropertyController@doDelete')->name('property.doDelete');
//   });
// });