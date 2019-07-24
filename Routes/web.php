<?php

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

Route::get('sitemap.xml', 'Modules\Front\Http\Controllers\SitemapController@sitemap')->name('sitemap');
Route::group([
  // 'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [
      'web',
      // 'localeSessionRedirect',
      // 'localizationRedirect',
      // 'localeViewPath',
      // 'localize'
  ],
], function() {

    Route::get('/', ['as' => 'home', 'uses' => 'ContentController@index']);

    Route::get('/countries/list', 'CountriesController@list')->name('countries.list');
    Route::get('/preview/{id}', 'ContentController@preview')->name('preview');

    Route::get(LaravelLocalization::transRoute('routes.category.index'), 'CategoryController@index')->name('blog.category.index');
    Route::get(LaravelLocalization::transRoute('routes.tag.index'), 'TagController@index')->name('blog.tag.index');

    Route::get('/not-found', 'ContentController@languageNotFound')->name('language-not-found');

    Route::get('/{slug}','ContentController@show')
      ->where('slug', '([A-Za-z0-9\-\/]+)')
      ->name('content.show');

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
    Route::get('js/localization-{locale}.js', 'LocalizationController@localization')->name('localization.js');

});
