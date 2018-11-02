<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Models\Article;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Translate;
use App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Storage;
use Image;
use League\Flysystem\Config;


class AdminArticlesController extends Controller {

	/* List articles - Display a listing of the Articles */

	public function index(Request $request, $type){			
		$admin_category = Category::where("link",$type)->first();
		$admin_category_parent = $admin_category->category_parent()->first();
		$admin_category_children = $admin_category->category_children()->get();
		//$admin_articles = $admin_category->articles;
		$admin_articles = Article::with('article_parent')->with('article_parent_price')->where('category_id', $admin_category->id)->get();
		//dd($admin_articles);
		$hotels = Category::where('link', "hotels")->first()->articles()->get();
		
		//dd($hotels);
		if ($request->ajax()){
			/*get [] from request*/
			$all = $request->all();
			//dd($all);
			$article_parent_id = $all['id'];
			if($article_parent_id){
				session([
					'hotel_id' => $article_parent_id,
				]);
				$articles = $admin_articles->filter(function($admin_article) use ($article_parent_id){
					//dd($admin_article);

					if($admin_article->article_parent_price()->first() !== null  && $admin_article->article_parent_price()->first()->article_parent()->first()){
						$admin_article['parent_hotel'] = $admin_article->article_parent()->first()->article_parent()->first()->title;
						$admin_article = $admin_article->article_parent()->first()->article_parent()->first()->id == $article_parent_id;
					}else{
						$admin_article['parent_hotel'] = $admin_article->article_parent()->first()->title;
						$admin_article = $admin_article->article_parent()->first()->id == $article_parent_id;
					}
					return $admin_article;
				});

			}else{
				$articles = $admin_articles->map(function($admin_article){
					if($admin_article->article_parent()->first() && $admin_article->article_parent()->first()->article_parent()->first()){
						//dd($admin_article);
						$admin_article['parent_hotel'] = $admin_article->article_parent()->first()->article_parent()->first()->title;
					}

					return $admin_article;
				});

				session()->flush();
			}
			//dd($articles);
			
			return response()->json([
				"status" => 'success',
				"articles" => $articles,
				'type' => $type
			]);
		}
		return view('backend.articles.list')
			->with(
				compact(
				'admin_category',
				'admin_articles',
				'type',
				'admin_category_children',
				'admin_category_parent',
				'hotels'
				)
			);

	}

	/* Optimize images - Minimize uploaded files @return Response */

	public function fileoptimize(Request $request, $id)
	{
		if (isset($id)){
			$articles = [Article::find($id)];
		}
		else {
			$articles = Article::all();
		}

		foreach($articles as $article){
			$files = Storage::Files('upload/articles/'.$article->id.'/images/');

			foreach($files as $key => $file){
				try{
					Image::make($file)
						->resize(1200, null, function ($constraint) { $constraint->aspectRatio();})
						->save($file, 90);

					echo $file . ' > resized <br />';
				}catch(\Exeption $e){
					echo '<span style="color:red">'. $file . ' > error ' . $e->getMessage() . ' </span><br />';
				}

			}
		}
		exit;
	}

	/*Show the form for creating a new Article.*/

	public function create(Request $request, $type)
	{
		//dd('fag');
		$langs = Lang::activelangs()->get();
		$admin_category = Category::where("link","=","$type")->first();

		//Get group attributes for article_parent
		$article_group =  Article::where('category_id',$admin_category['parent_id'])->where('active', 1)->get();
		//dd($article_group);
		//list of base and attributes from Category
		$fields = json_decode($admin_category->fields);

		//list of attributes from Category
		$attributes_fields = $fields->attributes;
		if ($request->ajax()){
			/*get [] from request*/
			$all = $request->all();
			$article_parent_id = $all['id'];
			$category_room = Category::where('link', 'rooms')->first();
			$admin_article = Article::where("id", $article_parent_id)->first();
			$parent_hotel = $admin_article->article_parent;
			$rooms_for_list_price = Article::where('article_id', $parent_hotel->id)->where('category_id', $category_room->id)->get();
			//dd($rooms_for_list_price);
			return response()->json([
			"status" => 'success',
			"articles" => $rooms_for_list_price,
			//"redirect" => URL::to('/adminorieT3/articles/' . $type)
		]);

	
		}

		return view('backend.articles.edit',[
			'langs'=>$langs,
			'admin_category'=>$admin_category,
			'action_method' => 'post',
			'attributes_fields' => $attributes_fields,
			'article_group' => $article_group,
			'type' => $type
		]);
	}

	/* Store a newly created Article in storage.*/

	public function store(Request $request, $type)
	{
		//dd('store');
		$langs = Lang::activelangs()->get();

		//validation rules
		foreach($langs as $lang){
			$this->validate($request, [
				'title_'.$lang['lang'] => 'required|max:255',
				'img' => 'mimes:jpeg,jpg,png,bmp,gif|max:5000'
			]);
		}

		$all = $request->except(['attributes','saved-files-path']);

		// Get current category ID
		$category = Category::where('link',$type)->first();

		$all['category_id'] = $category->id;

		$article_img = $request->file('img');

		//Create new entry in DB
		$article = Article::create($all);

		$all = $request->all();

		//add category img and save in file
		if($article_img){
			$extension = $article_img->getClientOriginalExtension();
			$name_img = $article->id  . '-' . time() . '.' . $extension;
			Storage::put('upload/articles/' .$article->id   .'/main/' . $name_img, file_get_contents($article_img));
			$all['img'] = 'upload/articles/' .$article->id .'/main/' . $name_img;
		}

		if (isset($all['attributes'])) {
			$all= $this->saveImg($all, $article);
		}
		
		if (isset($all['attributes'])){
			$all['attributes'] = json_encode($this->prepareAttributesData($all['attributes']));
		}
		
//dd($all);
		// Сreate array for multilanguage (example- (ua|ru|en))
		$all = $this->prepareArticleData($all);
		//dd($all);
		//update $all after save imgs
		$article->update($all);

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			//"redirect" => URL::to('/adminorieT3/articles/' . $type)
		]);
	}

	/*Show the form for editing the Article. (@param  int  $id @return Response*/

	public function edit(Request $request, $type, $id)
	{		
		//Создание папки соответсвующие id
		Storage::makeDirectory('upload/articles/' . $id, '0777', true, true);
		$category_room = Category::where('link', 'rooms')->first();
		
		$langs = Lang::activelangs()->get();
		$admin_article = Article::where("id", $id)->first();
		if(isset($admin_article->article_parent) && isset($admin_article->article_parent->article_parent)){
			$parent_hotel = $admin_article->article_parent->article_parent;
			//if(isset($parent_hotel)){
			$rooms_for_check_price = Article::where('article_id', $parent_hotel->id)->where('category_id', $category_room->id)->get();
		};
		//dd($admin_article );
		if ($request->ajax()){
			/*get [] from request*/
			$all = $request->all();
			$article_parent_id = $all['id'];
			//$category_room = Category::where('link', 'rooms')->first();
			$admin_article = Article::where("id", $article_parent_id)->first();
			$parent_hotel = $admin_article->article_parent;
			$rooms_for_list_price = Article::where('article_id', $parent_hotel->id)->where('category_id', $category_room->id)->get();
			//dd($rooms_for_list_price);
			return response()->json([
				"status" => 'success',
				"articles" => $rooms_for_list_price,
				//"redirect" => URL::to('/adminorieT3/articles/' . $type)
			]);
		}	
		
		//dd($rooms_for_check_price);
	
		//Var article_id
		$article_id = $admin_article['article_id'];
//dd($admin_article);
		//Decode attributes from articles DB
		$attributes = json_decode($admin_article->attributes, true);
	//dd($attributes);
		$admin_category = Category::where("link", $type)->first();

		//Get group attributes for article_parent
		$article_group =  Article::where('category_id',$admin_category['parent_id'])->where('active', 1)->get();
		
		//Decode base and attributes from categories DB
		$fields = json_decode($admin_category->fields);

		//Decode attributes from categories DB
		$attributes_fields = $fields->attributes;
		//dd($fields);
		return view('backend.articles.edit',[
			'admin_article'=>$admin_article,
			'admin_category' => $admin_category,
			'type'=> $type,
			'langs'=> $langs,
			'action_method' => 'put',
			'attributes_fields' => $attributes_fields,
			'attributes' => $attributes,
			'article_group' => $article_group,
			'article_id' => $article_id,
			'rooms_for_check_price' => (isset($rooms_for_check_price)) ? $rooms_for_check_price : []
		]);
	}

	/* Update the Article in storage.(@param  int  $id,@return Response*/

	public function update(Request $request, $type, $id)
	{
		$langs = Lang::activelangs()->get();

		//validation rules
		foreach($langs as $lang){
			$this->validate($request, [
				'title_' . $lang['lang'] => 'max:255',
				'img' => 'mimes:jpeg,jpg,png,bmp,gif|max:5000'
			]);
		}

		$article = Article::where('id', $id)->first();
		//$article_attributes = json_decode($article->attributes, true);

		//create var all for date from request
		$all = $request->all();
//dd($all);
		//add img
		$article_img = $request->file('img');

		//add category img and save in file
		if($article_img){
			$extension = $article_img->getClientOriginalExtension();
			$name_img = $article->id . '-' . time() . '.' . $extension;
			Storage::deleteDirectory('upload/articles/' . $article->id . '/main');
			Storage::put('upload/articles/' . $article->id . '/main/' . $name_img, file_get_contents($article_img));
			$all['img'] = 'upload/articles/' . $article->id . '/main/' . $name_img;
		}
		elseif($all['img_status'] == 'false'){
			$all['img'] = null;
			Storage::deleteDirectory('upload/articles/' . $article->id . '/main');

		}

		//Pull imgs from folder and present in JSON format
		$files = Storage::Files('upload/articles/'.$id.'/images/');

		Storage::deleteDirectory('upload/articles/' . $id . '/min');
		Storage::deleteDirectory('upload/articles/' . $id . '/full');

		Storage::makeDirectory('upload/articles/' . $id . '/min', '0777', true, true);
		Storage::makeDirectory('upload/articles/' . $id . '/full', '0777', true, true);

		foreach($files as $key => $file){
			$savePathMin = str_replace('/'.$id.'/images/', '/'.$id.'/min/', $file);
			$savePathFull = str_replace('/'.$id.'/images/', '/'.$id.'/full/', $file);
			try{
				$image = Image::make($file)
					->resize(1200, null, function ($constraint) { $constraint->aspectRatio();})
					->save($savePathFull, 80)
					->resize(320, null, function ($constraint) { $constraint->aspectRatio(); })
					->save($savePathMin, 80);

				$files[$key] = [
					'full' => $savePathFull,
					'min' => $savePathMin
				];
			}catch(\Exception $e){
				$files[$key] = [
					'full' => $file,
					'min' => $file
				];
			}
		}
		if (isset($all['attributes'])) {
			$all= $this->saveImg($all, $article);
		}
		//dd($all['attributes']);
		//Encode attributes from request
		if (isset($all['attributes'])){
			//dd($all);
			$all['attributes'] = json_encode($this->prepareAttributesData($all['attributes']));
			//$all['attributes'] = $this->prepareAttributesData($all['attributes']);
		}
		//dd($all['attributes']);
//dd($all);
		//Encode images from request
		$all['imgs'] = json_encode($files);
//dd($all);
		// Сreate array for multilanguage (example- (ua|ru|en))
		$all = $this->prepareArticleData($all);
		//dd($all);
		//Update all data in DB
		$article->update($all);

		//Save all data in DB
		$article->save();

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => URL::to(getSetting('admin.prefix') . '/articles/' . $type)
		]);
	}

	/*Remove the Article from storage.(@param  int  $id, @return Response */

	public function destroy($type, $id)
	{
		$article = Article::where('id', '=', $id)->first();
		if($article AND $article->delete()){
			if($article->article_children()) {
				$article->article_children()->delete();
			}
			// delete related   
			//;
			//$article->article_children_price()->delete();
			Storage::deleteDirectory('upload/articles/' . $id);
			return response()->json([
				"status" => 'success',
				"message" => 'Успешно удалено'
			]);
		}
		else{
			return response()->json([
				"status" => 'error',
				"message" => 'Возникла ошибка при удалении'
			]);
		}
	}

	/* Сreate array for multilanguage (example- (ua|ru|en)) */
	private function prepareArticleData($all){
		$langs = Lang::activelangs()->get();		
		$all = $this->initValuesWithArray($all);
		//Change format DATE
		if (isset($all['date']))
			$all['date'] = date('Y-m-d H:i:s',strtotime($all['date']));
		if (isset($all['date_start']))
			$all['date_start'] = date('Y-m-d H:i:s',strtotime($all['date_start']));
		if (isset($all['date_finish']))
			$all['date_finish'] = date('Y-m-d H:i:s',strtotime($all['date_finish']));

		// Removing gaps at the beginning and end of each field
		// foreach($all as $key => $value){
		// 	$all[$key] = trim($value);
		// }

		// Сreate array example (ua|ru|en)
		foreach($langs as $lang){			
				
			//$all['test']+= [ $lang['lang'] => $all["title_{$lang['lang']}"] ];
			$all['title'] +=  [ $lang['lang'] => $all["title_{$lang['lang']}"] ];
			$all['short_description'] +=  [ $lang['lang'] => (isset($all["short_description_{$lang['lang']}"]) ? $all["short_description_{$lang['lang']}"] : '') ];
			$all['description'] +=  [ $lang['lang'] => (isset($all["description_{$lang['lang']}"]) ? $all["description_{$lang['lang']}"] : '') ];
			$all['meta_title'] +=  [ $lang['lang'] => (isset($all["meta_title_{$lang['lang']}"]) ? $all["meta_title_{$lang['lang']}"] : '') ];
			$all['meta_description'] +=  [ $lang['lang'] => (isset($all["meta_description_{$lang['lang']}"]) ? $all["meta_description_{$lang['lang']}"] : '') ];
			$all['meta_keywords'] +=  [ $lang['lang'] => (isset($all["meta_keywords_{$lang['lang']}"]) ? $all["meta_keywords_{$lang['lang']}"] : '') ];


			/*Block for multilang with Delimiter*/
			// $all['title'] .= $all["title_{$lang['lang']}"] .'@|;';
			// $all['short_description'] .= (isset($all["short_description_{$lang['lang']}"]) ? $all["short_description_{$lang['lang']}"] : '') .'@|;';
			// $all['description'] .= (isset($all["description_{$lang['lang']}"]) ? $all["description_{$lang['lang']}"] : '') .'@|;';
			// $all['meta_title'] .= (isset($all["meta_title_{$lang['lang']}"]) ? $all["meta_title_{$lang['lang']}"] : '') .'@|;';
			// $all['meta_description'] .= (isset($all["meta_description_{$lang['lang']}"]) ? $all["meta_description_{$lang['lang']}"] : '') .'@|;';
			// $all['meta_keywords'] .= (isset($all["meta_keywords_{$lang['lang']}"]) ? $all["meta_keywords_{$lang['lang']}"] : '') .'@|;';

			//Delete var title_ua,title_ru,title_en
			unset($all["title_{$lang['lang']}"]);
			unset($all["short_description_{$lang['lang']}"]);
			unset($all["description_{$lang['lang']}"]);
			unset($all["meta_title_{$lang['lang']}"]);
			unset($all["meta_description_{$lang['lang']}"]);
			unset($all["meta_keywords_{$lang['lang']}"]);
		}
		$all = $this->transformToJson($all);
		return $all;
	}

	/* Сreate array for multilanguage (example- (ua|ru|en)) */
	private function prepareAttributesData($all){
		//dd($all);
		$langs = Lang::activelangs()->get();
		$first_lang = $langs->first()['lang'];		
		foreach($all as $key => $value){
			//dd($value);
			 
			if(stristr($key, '_' . $first_lang) !== FALSE){
				
				$key_without_lang = str_replace("_{$first_lang}", '', $key);
				//dd($key_without_lang);
				/*Block for multilang with Delimiter*/
				// $all[$key_without_lang] = '';
				// foreach($langs as $lang){
				// 	$all[$key_without_lang] .= $all[$key_without_lang . "_{$lang['lang']}"] .'@|;';
				// 	unset($all[$key_without_lang . "_{$lang['lang']}"]);
				// }
				/*/Block for multilang with Delimiter*/
				$all[$key_without_lang] = [];				
				
				foreach($langs as $lang){
					$all[$key_without_lang] +=  [ $lang['lang'] => $all[$key_without_lang . "_{$lang['lang']}"]];
					//dd($key);
					unset($all[$key_without_lang . "_{$lang['lang']}"]);				
				}
				//$all[$key_without_lang] = json_encode($all[$key_without_lang]);;
			}		
			
			
				//dd($all[$key]['title']);
			// if(is_array($all[$key] AND isset($all[$key]['title']) AND $all[$key]['title'])){
			// 	dd($all[$key]['status']);
			// 	$all[$key] = json_encode($all[$key]['title']);
			// 	//dd($all);
			// }
			
			
			
		}
		//dd($all);
		//dd($all);
		return $all;
	}
	private function initValuesWithDelimiter($all){			
		$all['title'] = '';
		$all['short_description'] = '';
		$all['description'] = '';
		$all['meta_title'] = '';
		$all['meta_description'] = '';
		$all['meta_keywords'] ='';

		//Removing gaps at the beginning and end of each field
		foreach($all as $key => $value){
			$all[$key] = trim($value);
		}
		return $all;
	}
	private function initValuesWithArray($all){			
		$all['title'] = [];
		$all['short_description'] = [];
		$all['description'] = [];
		$all['meta_title'] = [];
		$all['meta_description'] = [];
		$all['meta_keywords'] = [];
		return $all;
	}
	private function transformToJson($all){		
		$all['title'] = json_encode($all['title']);
		$all['short_description'] = json_encode($all['short_description']);
		$all['description'] = json_encode($all['description']);
		$all['meta_title'] = json_encode($all['meta_title']);
		$all['meta_description'] = json_encode($all['meta_description']);
		$all['meta_keywords'] = json_encode($all['meta_keywords']);		
		return $all;
	}
	
	public function saveImg($all, $article){
		$attributes = $all['attributes'];
			
			foreach ($attributes  as $key => $attribute ) {
				if (is_object($attribute) && $attribute){
					$extension = $attribute->getClientOriginalExtension();
					$name_img = $article->id . '-' . uniqid()  . '.' . $extension;
					Storage::put('upload/articles/' . $article->id . '/img/' . $name_img, file_get_contents($attribute));
					//$all['img'] = 'upload/articles/' . $article->id . '/main/' . $name_img;
					$attributes[$key] = 'upload/articles/' . $article->id . '/img/' . $name_img;
				}
				elseif(!$attributes[$key] AND isset($all['saved-files-path']) AND $all['saved-files-path'] AND isset($all['saved-files-path'][$key]) AND $all['saved-files-path'][$key]){
					$attributes[$key] = $all['saved-files-path'][$key];
				}
			}

			unset($all['saved-files-path']);
			
			$all['attributes'] = $attributes;
			return $all;
		
	}
}
