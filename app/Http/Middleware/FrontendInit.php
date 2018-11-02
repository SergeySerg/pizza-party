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

		
		//dd('тут');
		// Get current lang object from db
		//$currentLang = Lang::where('lang', $request->lang)
		//	->first();
			//dd($request->all());
			//dd($request->domain);

		if(is_null($request->lang)){
		// 	$default_lang = Config::get('app.locale');
		App::setLocale(config('app.locale'));
		}else{
		// Locale setting
		App::setLocale($request->lang);
		}
		//dd(route('article_index', [$request->lang]));

		if(route('article_index', [$request->lang]) === $request->url()){
			$subdomain = true;
		}else{
			$subdomain = false;
		}
		//$subdomain = $request->subdomain;
		$name = $request->name;
		//dd($name);
		$base_article = Article::where('attributes->url->' . App::getLocale(), $name )->first();
		//dd($base_article);
		//share type
		$type = $request->type;
		if(is_null($request->type)){
			$type = 'main';
		}		
		// if ( !$subdomain || !$currentLang || !$type ||$request->type){
		// 	abort('404');
		// }
		$langs = Lang::activelangs()->get()/**/;
		
		
		$texts = new Text();
		//get all Category
		$categories = Category::with('articles')->activeCategories()->get();
			//Debugbar::info($categories);
		$categories_data = [];
		$child_article = [];		
		//dd($categories);
		foreach($categories as $category){
			//dd($category);			
			//create arr for categories with type
			$categories_data[$category->link] = $category;
			$category_item = $category
				->articles
				->where('active', 1)
				->sortByDesc('priority');
			//Debugbar::info($category_item);				

			//$dd($category_item);	
							
				//dd($category_item);
			//Children articles in request subdomain	
			if($name){				
				//dd($category->id);
				$subdomain_children_articles = Article::with('article_children')->where('article_id', $base_article->article_id)->activeAndSortArticles()->get()
				//dd($subdomain_children_articles);
				->map(function ($subdomain_child_article) use ($category) {
					//dd($category);
					//dd($subdomain_child_article);
					return $subdomain_child_article
							->article_children()				
							->where('category_id', $category->id)
							->activeAndSortArticles()
							->get();
							//->toArray();						
							//dd($subdomain_child_article);
				})
				->reject(function($subdomain_child_article){
					return count($subdomain_child_article) == 0;
				});
				
				//dd($subdomain_children_articles);
				if(count($subdomain_children_articles) != 0){
					$child_articles = [];
					foreach($subdomain_children_articles as $articles){						
						//dd($articles);
						foreach($articles as $key => $article){
							if($category->link == 'rooms'){
								//dd($base_article);
								$base_hotel = $article->where('article_id', $base_article->article_id)->where('attributes->is_base_hotel', 1)->first();
								//dd($base_hotel);
								//Debugbar::info($base_hotel);
								view()->share('base_hotel', $base_hotel);
							}
							array_push($child_articles, $article);
						}
					}
					$child_articles = collect($child_articles)->sortByDesc('priority');
					if($category->link == 'reviews'){
						view()->share('children_' . $category->link . '_raty', $this->counterReviews($child_articles));
						//Debugbar::info();
						$child_articles = collect($child_articles)->sortByDesc('priority')->paginate( 10 );
						//dd($child_articles);
					}
					//dd($child_articles);
					view()->share('children_' . $category->link, $child_articles);	

				}
				//share Article		
				// if($category->link == 'hotels'){
				// 	dd($category_item);
				// 	//dd(DB::table('articles')->where('attributes->show_main_page', 1)->get());
				// 	dd($category_item->where('attributes->show_main_page', '1'));
					
				// }	
				//dd($collection);
				
				
			//view()->share('children_' . $category->link, $child_articles);	
			}
			// validate count for change method (get() or first()) if one item in array
//			if(count($category_item) == 1){
//				$category_item = $category_item->first();
//				//dd($category_item);
//			}
			//dd($category_item);
			//share Article		
				// if($category->link == 'servicespaid'){
				// 	dd($category_item);
				// 	//dd(DB::table('articles')->where('attributes->show_main_page', 1)->get());
				// 	dd($category_item->where('attributes->show_main_page', '1'));
					
				// }	
			if($category->link == 'reviews'){
				view()->share($category->link . '_raty', $this->counterReviews($category_item));
				//Debugbar::info($this->counterReviews($category_item));
				$category_item = collect($category_item)->sortByDesc('priority')->paginate( 10 );
				//dd($child_articles);
			}
			view()->share($category->link, $category_item);
		}
		$category_for_url = Category::where('url->' . App::getLocale(), $request->url)->first();
		$category_for_subtype = Category::where('url->' . App::getLocale(), $request->subtype)->first();

		//dd($category_for_subtype);
		//dd($children_reviews);
		//dd($category_item);
		//Debugbar::info($category_item);
		//dd($categories_data);



		// Share to views global template variables
		view()->share('default_lang', config('app.locale'));
		view()->share('langs', $langs);
		view()->share('type', $type);
		view()->share('texts', $texts->init());
		view()->share('categories_data', $categories_data);
		view()->share('version', config('app.version'));
		view()->share('subdomain', $name);
		view()->share('subtype', $request->subtype);
		view()->share('url', $request->url);
		view()->share('id', $request->id);
		view()->share('category_for_url', $category_for_url);
		view()->share('category_for_subtype', $category_for_subtype);
		
		return $next($request);
	}
	public function counterReviews($reviews){
		$settings_reviews = Category::where('link', 'revsettings')->first()->articles->first();
		$all_property_for_reviews = json_decode($settings_reviews->attributes, true);
		//dd($all_property_for_reviews);
		foreach ($all_property_for_reviews as $key => $item) {
			//dd($item);
			if($item != 1) {				
				unset($all_property_for_reviews[$key]);
			}
		}
		$rates = [];
		foreach($reviews as $review){				
			$all_attributes = json_decode($review->attributes, true);
			foreach($all_property_for_reviews as $key => $item){
				foreach($all_attributes as $k => $v){
					if(strpos($key, $k) !== false && $v){										
						array_push($rates, $v);						 
					}					
				}				
			}
		}
		//Debugbar::info(collect($rates)->avg());
		return $raty = round(collect($rates)->avg(), 0, PHP_ROUND_HALF_UP); 
		//Debugbar::info($raty);			
	}

}
