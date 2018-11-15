<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/_debugbar/assets/stylesheets', [
    'as' => 'debugbar-css',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css'
]);

Route::get('/_debugbar/assets/javascript', [
    'as' => 'debugbar-js',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js'
]);
/* Page 404 */
Route::get('/404', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@show404', 'as' => 'show_404'])->where('lang', 'ua|ru|en|pl');
Route::get('/{lang?}/404', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@show404', 'as' => 'show_404'])->where('lang', 'ua|ru|en|pl');
/* /Page 404 */

Route::get('home', 'HomeController@index');//Для відображення результата після логування

/*Auth group routes*/
Route::controllers([
	/*'auth' => 'Auth\AuthController',*/
	'password' => 'Auth\PasswordController',
]);
Route::get('/register', array('as' => 'signup', 'uses' => 'Auth\AuthController@getRegister'));
Route::post('/register', array('as' => 'signup', 'uses' => 'Auth\AuthController@postRegister'));
Route::get(getSetting('admin.prefix') . '/login', array('as' => 'login', 'uses' => 'Auth\AuthController@getLogin'));
Route::post(getSetting('admin.prefix') . '/login', array('as' => 'login', 'uses' => 'Auth\AuthController@postLogin'));
Route::get(getSetting('admin.prefix') . '/logout', array('as' => 'logout', 'uses' => 'Auth\AuthController@getLogout'));
/*Route::get('/forgot', array('as' => 'forgot', 'uses' => 'Auth\AuthController@getLogin'));
Route::post('/forgot', array('as' => 'forgot', 'uses' => 'Auth\AuthController@postLogin'));*/

/*/Auth group routes*/
Route::group(['prefix'=> getSetting('admin.prefix'), 'middleware' => ['auth', 'backend.init']], function(){

	//Routes for Articles (Backend)
	Route::get('/',['uses' => 'Backend\AdminDashboardController@index','as' => 'admin_dashboard']);
	Route::get('/articles/fileoptimize/{id?}','Backend\AdminArticlesController@fileoptimize');
	Route::get('/articles/{type}',['uses' => 'Backend\AdminArticlesController@index','as' => 'admin_index']);//Вывод списка элементов
	Route::get('/articles/{type}/create',['uses' => 'Backend\AdminArticlesController@create','as' => 'admin_create']);//Вывод формы создания элемента
	Route::post('/articles/{type}/create',['uses' => 'Backend\AdminArticlesController@store','as' => 'admin_store']);//Сохранение элемента
	Route::get('/articles/{type}/{id}',['uses' => 'Backend\AdminArticlesController@edit','as' => 'admin_edit']);//Вывод формы редакторирование элемента..
	Route::put('/articles/{type}/{id}',['uses' =>'Backend\AdminArticlesController@update','as' => 'admin_update']);//Сохранение элемента после редактирования..
	Route::delete('/articles/{type}/{id}',['uses' => 'Backend\AdminArticlesController@destroy','as' => 'admin_delete']);//Удаление элемента

	//Routes for Texts (Backend)
	Route::get('/texts',['uses' => 'Backend\AdminTextsController@index','as' => 'text_index']);//Вывод списка
	Route::get('/texts/create',['uses' => 'Backend\AdminTextsController@create','as' => 'text_create']);//Вывод формы создания элемента
	Route::post('/texts/create',['uses' =>'Backend\AdminTextsController@store','as' => 'text_store']);//Сохранение элемента
	Route::delete('/texts/{id}',['uses' =>'Backend\AdminTextsController@destroy','as' => 'text_delete']);//Удаление элемента
	Route::get('/texts/{id}',['uses' =>'Backend\AdminTextsController@edit','as' => 'text_edit']);//Вывод формы редакторирование
	Route::put('/texts/{id}',['uses' =>'Backend\AdminTextsController@update','as' => 'text_update']);//Сохранение после редактирования
	Route::get('/texts_recovery',['uses' => 'Backend\AdminTextsController@recovery','as' => 'text_recovery']);//Востановление записей после удаления
	Route::get('/texts_delete',['uses' => 'Backend\AdminTextsController@delete','as' => 'texts_delete']);//Окончательное удаление

	//Routes for Categories (Backend)
	Route::get('/categories/create',['uses' => 'Backend\AdminCategoriesController@create','as' => 'admin_categories_create']);//Вывод формы создания категории
	Route::post('/categories/create',['uses' =>'Backend\AdminCategoriesController@store','as' => 'admin_categories_store']);//Сохранение элемента
	Route::get('/categories/{type}',['uses' => 'Backend\AdminCategoriesController@edit','as' => 'admin_categories_edit']);//Вывод формы редактирования категории
	Route::put('/categories/{type}',['uses' =>'Backend\AdminCategoriesController@update','as' => 'admin_categories_update']);//Сохранение после редактирования
	Route::delete('/categories/{type}',['uses' =>'Backend\AdminCategoriesController@destroy','as' => 'admin_categories_delete']);//Удаление категории
	Route::get('/categories/fileoptimize/{type?}','Backend\AdminCategoriesController@fileoptimize');

	//Routes for Settings (Backend)
	Route::get('/settings',['uses' => 'Backend\AdminSettingsController@index','as' => 'settings_index']);//Вывод списка
	Route::get('/settings/create',['uses' => 'Backend\AdminSettingsController@create','as' => 'settings_create']);//Вывод формы создания элемента
	Route::post('/settings/create',['uses' =>'Backend\AdminSettingsController@store','as' => 'settings_store']);//Сохранение элемента
	Route::delete('/settings/{id}',['uses' =>'Backend\AdminSettingsController@destroy','as' => 'settings_delete']);//Удаление элемента
	Route::get('/settings/{id}',['uses' =>'Backend\AdminSettingsController@edit','as' => 'settings_edit']);//Вывод формы редакторирование
	Route::put('/settings/{id}',['uses' =>'Backend\AdminSettingsController@update','as' => 'settings_update']);//Сохранение после редактирования
	Route::get('/settings_recovery',['uses' => 'Backend\AdminSettingsController@recovery','as' => 'settings_recovery']);//Востановление записей после удаления
	Route::get('/settings_delete',['uses' => 'Backend\AdminSettingsController@delete','as' => 'settings_delete']);//Окончательное удаление

	//Routes for Langs (Backend)
	Route::get('/langs',['uses' => 'Backend\AdminLangsController@index','as' => 'langs_index']);//Вывод списка элементов
	Route::get('/langs/create',['uses' => 'Backend\AdminLangsController@create','as' => 'langs_create']);//Вывод формы создания элемента
	Route::post('/langs/create',['uses' => 'Backend\AdminLangsController@store','as' => 'langs_store']);//Сохранение элемента
	Route::get('/langs/{id}',['uses' => 'Backend\AdminLangsController@edit','as' => 'langs_edit']);//Вывод формы редакторирование элемента..
	Route::put('/langs/{id}',['uses' =>'Backend\AdminLangsController@update','as' => 'langs_update']);//Сохранение элемента после редактирования..
	Route::delete('/langs/{id}',['uses' => 'Backend\AdminLangsController@destroy','as' => 'langs_delete']);//Удаление элемента
	//Routes for Orders (Backend)
	Route::get('/orders', ['uses' => 'Backend\AdminOrdersController@index', 'as' => 'orders_index']);//Вывод списка заказов
	Route::delete('/orders/{id}', ['uses' => 'Backend\AdminOrdersController@destroy', 'as' => 'order_delete']);//Удаление заказа*/
	Route::get('/orders/{id}',['uses' => 'Backend\AdminOrdersController@edit','as' => 'order_edit']);//Вывод формы редакторирование элемента..
	Route::put('/orders/{id}',['uses' =>'Backend\AdminOrdersController@update','as' => 'order_update']);//Сохранение элемента после редактирования..
	Route::post('/orders/change_status', ['uses' => 'Backend\AdminOrdersController@change_status', 'as' => 'change_status']);//Вывод списка заказов

});
/*/Backend group routes*/


/*Frontend group routes*/
Route::get('/{lang?}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@index', 'as' => 'article_index'])->where('lang', 'ua|ru|en');
Route::get('/{type}/{url?}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@render_list', 'as' => 'article_list'])->where('type', 'pizza|salad|desserts|drinks|complaints|cart|articles|map')->where('url', 'index.htm');
Route::get('/{lang?}/{type}/{url?}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@render_list', 'as' => 'article_list'])->where('type', 'pizza|salad|desserts|drinks|complaints|cart|articles|map')->where('url', 'index.htm');
Route::get('/{type}/{url}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@show', 'as' => 'article_url'])->where('type', 'articles');
Route::get('/{lang?}/{type}/{url}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@show', 'as' => 'article_url'])->where('type', 'articles');
//Route::get('/map', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@show_map', 'as' => 'article_map']);

/*Modal routes*/
Route::post('/{lang}/callback', ['uses' => 'Frontend\ArticleController@callback','as' => 'callback']);//Обработчик Обратной связи при заказе товара
Route::post('/{lang}/add_review', ['uses' => 'Frontend\ArticleController@add_review','as' => 'add_review']);//Обработчик добавления отзыва
Route::post('/{lang}/reserved', ['uses' => 'Frontend\ArticleController@reserved','as' => 'reserved']);//Обработчик Обратной связи при заказе номера
Route::post('/get_articles', ['uses' => 'Frontend\ArticleController@get_articles','as' => 'get_articles']);//Обработчик товаров
Route::post('/add_order', ['uses' => 'Frontend\ArticleController@add_order','as' => 'add_order']);//Добавление заказа


/*/Modal routes*/
/*/Frontend group routes*/



