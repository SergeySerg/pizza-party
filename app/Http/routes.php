<?php
// use App\Http\Controllers\Controller;
// use App\Http\Controllers\Frontend;
// use App\Models\Article;
// use App\Models\Category;
//use App;
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
	/*//Routes for Orders (Backend)
	Route::get('/orders', ['uses' => 'Backend\AdminOrdersController@index', 'as' => 'orders_index']);//Вывод списка заказов
	Route::delete('/orders/{id}', ['uses' => 'Backend\AdminOrdersController@destroy', 'as' => 'orders_delete']);//Вывод списка заказов*/



});
/*/Backend group routes*/


/*Frontend group routes*/
//Route::get('/{lang}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@indexMain', 'as' => 'article_index']);
//Route::group(['domain' => getSetting('domain')], function() {	
	Route::get('/{lang?}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@indexMain', 'as' => 'article_index'])->where('lang', 'ua|ru|en|pl');
	Route::get('/{category}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@renderUrl', 'as' => 'article_category'])->where('category', 'скидки|sales|znyzhky|поиск|poshuk|search|vidhuky|reviews|отзывы');
	Route::get('/{lang?}/{category}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@renderUrl', 'as' => 'article_category'])->where('lang', 'ua|ru|en|pl')->where('category', 'скидки|sales|znyzhky|поиск|poshuk|search|vidhuky|reviews|отзывы');

	Route::get('/{seo_direction}/{url}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@showSeo', 'as' => 'article_show_seo'])->where('seo_direction', 'буковель|bukovel|яремче|yaremche|карпаты|karpaty');
	Route::get('/{lang?}/{seo_direction}/{url}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@showSeo', 'as' => 'article_show_seo'])->where('seo_direction', 'буковель|bukovel|яремче|yaremche|карпаты|karpaty')->where('lang', 'ua|ru|en|pl');
	Route::get('/{subtype}/{name}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@index', 'as' => 'article_index_subdomain']);
	Route::get('/{lang?}/{subtype}/{name}', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@index', 'as' => 'article_index_subdomain'])->where('lang', 'ua|ru|en|pl');
	Route::get('/{subtype}/{name}/{url}', ['middleware' => 'frontend.init','uses' => 'Frontend\ArticleController@renderUrl', 'as' => 'article_url']);
	Route::get('/{lang?}/{subtype}/{name}/{url}', ['middleware' => 'frontend.init','uses' => 'Frontend\ArticleController@renderUrl', 'as' => 'article_url'])->where('lang', 'ua|ru|en|pl');
	Route::get('/{subtype}/{name}/{url}/{id}', ['middleware' => 'frontend.init','uses' => 'Frontend\ArticleController@show', 'as' => 'article_show'])->where('lang', 'ua|ru|en|pl');
	Route::get('/{lang?}/{subtype}/{name}/{url}/{id}', ['middleware' => 'frontend.init','uses' => 'Frontend\ArticleController@show', 'as' => 'article_show'])->where('lang', 'ua|ru|en|pl')->where('id','.*');

	/*Modal routes*/
	Route::post('/{lang}/callback', ['uses' => 'Frontend\ArticleController@callback','as' => 'callback']);//Обработчик Обратной связи при заказе товара
	Route::post('/{lang}/add_review', ['uses' => 'Frontend\ArticleController@add_review','as' => 'add_review']);//Обработчик добавления отзыва
	Route::post('/{lang}/reserved', ['uses' => 'Frontend\ArticleController@reserved','as' => 'reserved']);//Обработчик Обратной связи при заказе номера
	Route::post('/get_prices', ['uses' => 'Frontend\ArticleController@get_prices','as' => 'get_prices']);//Обработчик цени номера

	/*/Modal routes*/
	/*Тимчасово*/
	Route::get('/pumpkin', ['middleware' => 'frontend.init', 'uses' => 'Frontend\ArticleController@pumpkin', 'as' => 'pumpkin']);
	/*Render html page */
	Route::get('/google2ab2a5819a08aedd.html', ['uses' => 'Frontend\ArticleController@googleHtml', 'as' => 'google_html']);
	Route::post('set_dates', function () {
		if (Request::ajax()){
			$dates = (Request::all());
			//$date_start = Input::get('dateStart');
			session([
				'date_start' => $dates['dateStart'],
				'date_finish' => $dates['dateFinish']

				]);
				return response()->json([
					"status" => 'success'
				]);

		}
		//return true;
	});
	
	
//});






//Route::post('/update_rate', ['uses' => 'Frontend\ArticleController@update_rate','as' => 'update_rate']);//Обновление тарифа
//Route::get('/update_rate_debug', ['uses' => 'Frontend\ArticleController@update_rate','as' => 'update_rate']);//Обновление тарифа


/*/Callback group route*/

/*Backend group routes*/

/*Frontend group routes*/
// Route::group(['domain' => '{subdomain}' . '.' . getSetting('domain'), 'middleware' => 'frontend.init'], function(){
// 	//dd('rtyui1');
// 	/*Callback group route*/
// 	Route::post('/{lang}/{type}', ['uses' => 'Frontend\ArticleController@contact','as' => 'contact']);//Обработчик Обратной связи
// 	Route::get('/{lang?}/{type?}', ['uses' => 'Frontend\ArticleController@index', 'as' => 'article_index_subdomain'])->where('lang', 'ua|ru|en|pl');
// 	Route::get('/{lang}/{type}/{link}/{id}', ['uses' => 'Frontend\ArticleController@show', 'as' => 'article_show'])->where('lang', 'ua|ru|en|pl');
// 	Route::post('/{lang}/reserved', ['uses' => 'Frontend\ArticleController@reserved','as' => 'reserved']);//Обработчик Обратной связи при заказе номера
// 	modal_handler();
// 	//frontEndRoutes();
// });

/*Frontend group routes*/
// function modal_handler(){
// 	Route::post('/{lang}/callback', ['uses' => 'Frontend\ArticleController@callback','as' => 'callback']);//Обработчик Обратной связи при заказе товара
// 	Route::post('/{lang}/add_review', ['uses' => 'Frontend\ArticleController@add_review','as' => 'add_review']);//Обработчик добавления отзыва
// }



