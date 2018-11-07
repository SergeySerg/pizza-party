<?php namespace App\Http\Middleware;

use Closure;
use App;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\Article;
use App\Models\Category;
use App\Models\Text;
use App\Models\Lang;
use League\Flysystem\Config;
//use DB;
use Debugbar;
//use Config;


class FrontendInit {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(is_null($request->lang)){
			App::setLocale(config('app.locale'));
		}else{
		// Locale setting
			App::setLocale($request->lang);
		}
		
		$type = $request->type;
		if(is_null($request->type)){
			$type = 'main';
		}		
		$texts = new Text();
		//get all Category
		$categories = Category::with('articles')->activeCategories()->get();
			Debugbar::info($categories);
			//dd($categories->where('link','slides')->first()->articles()->get());
		$categories_for_menu = $categories->where('is_menu',1);
		//dd($categories_for_menu);
		// $categories_data = [];
		// $child_article = [];		
		// //dd($categories);
		// foreach($categories as $category){
		// 	//dd($category);			
		// 	//create arr for categories with type
		// 	$categories_data[$category->link] = $category;
		// 	$category_item = $category
		// 		->articles
		// 		->where('active', 1)
		// 		->sortByDesc('priority');
		// 	view()->share($category->link, $category_item);
		// }

		


		// Share to views global template variables
		//view()->share('langs', $langs);
		view()->share('type', $type);
		view()->share('texts', $texts->init());
		view()->share('categories', $categories);
		view()->share('categories_for_menu', $categories_for_menu);
		view()->share('version', config('app.version'));
		
		return $next($request);
	}
	

}
