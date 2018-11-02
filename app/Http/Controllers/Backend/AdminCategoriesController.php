<?php namespace App\Http\Controllers\Backend;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend;
//use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
//use Illuminate\Support\Facades\Redirect;
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
use Validator;


class AdminCategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($type)
	{
		//
	}
	/* Optimize images - Minimize uploaded files @return Response */

	public function fileoptimize(Request $request, $type)
	{
		App::setLocale('ua');
		if (isset($type)){
			$categories = [Category::where('link',$type)];
		}
		else {
			$categories = Category::all();
		}

		foreach($categories as $category){
			$files = Storage::Files('upload/categories/'.$category->id.'/images/');

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


	/*Show the form for creating a new Category.*/

	public function create()
	{
		$langs = Lang::activelangs()->get();

		return view('backend.categories.edit',[
			'langs'=>$langs,
			'action_method' => 'post'
		]);
	}

	/* Store a newly created Category in storage.*/

	public function store(Request $request)
	{
		$langs = Lang::activelangs()->get();

		//validation rules
		foreach($langs as $lang){
			$this->validate($request, [
				'title_'.$lang['lang'] => 'required|max:255',
				'link' => "required|unique:categories",
				'url_' . $lang['lang'] => 'required|max:255',
				'img' => 'mimes:jpeg,jpg,png,bmp,gif|max:5000'
			]);
		}

		$all = $request->all();

		//create rightly slug
		$all['link'] = str_slug($all['link'], '-');

		//add img
		$category_img = $request->file('img');
		//dd($category_img);


		/*else{
			$all['img'] = null;
			Storage::deleteDirectory('upload/categories/' . $type);

		}*/

		// Сreate array for multilanguage (example- (ua|ru|en))
		$all = $this->prepareArticleData($all);

		//Create new entry in DB
		$category = Category::create($all);

		//add category img and save in file
		if($category_img){
			$extension = $category_img->getClientOriginalExtension();
			$name_img = $all['link'] . '-' . time() . '.' . $extension;
			Storage::put('upload/categories/' . $category->id . '/main/' . $name_img, file_get_contents($category_img));
			$all['img'] = 'upload/categories/' . $category->id . '/main/' . $name_img;
		}

		//update $all after save img
		$category->update($all);


		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => route('admin_dashboard')
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/*Show the form for editing the Category. (@param  int  $id @return Response*/

	public function edit($type = null)
	{
		$langs = Lang::activelangs()->get();
		$admin_category = Category::where("link","=","$type")->first();

		//Var article_parent
		$category_parent = $admin_category['parent_id'];

		//create folder with id
		Storage::makeDirectory('upload/categories/' . $admin_category->id, '0777', true, true);

		//Decode base and attributes from categories DB
		$fields = json_decode($admin_category->fields);

		//Decode attributes from articles DB
		$attributes_fields = $fields->attributes;
		return view('backend.categories.edit')
			->with(compact('langs','admin_category','type','attributes_fields','category_parent'))
			->with(['action_method' => 'put']);

		/*return view('backend.categories.edit', [
			'admin_category' => $admin_category,
			'langs' => $langs,
			'type' => $type,
			'action_method' => 'put',
			'attributes_fields' => $attributes_fields,
			'article_parent' => $article_parent
		]);*/
        /*[
			'admin_category' => $admin_category,
			'langs' => $langs,
			'type' => $type,
			'action_method' => 'put',
			'attributes_fields' => $attributes_fields,
			'article_parent' => $article_parent
		]);*/
	}

	/* Update the Category in storage.(@param  int  $id,@return Response*/

	public function update(Request $request, $type)
	{
		$langs = Lang::activelangs()->get();

		$category = Category::where('link',$type)->first();

		//create var all for date from request
		$all = $request->all();

		//validation rules
		foreach($langs as $lang){
			$this->validate($request, [
				'title_' .$lang['lang'] => 'required|max:255',
				'link' => "required",
				//'url_' . $lang['lang'] => 'required|unique:categories',
				'img' => 'mimes:jpeg,jpg,png,bmp,gif|max:5000'
			]);
		}

		//create rightly slug
		$all['link'] = str_slug($all['link'], '-');

		$category_img = $request->file('img');
		//dd($category_img);

		//add category img and save in file
		if($category_img){
			$extension = $category_img->getClientOriginalExtension();
			$name_img = $all['link'] . '-' . time() . '.' . $extension;
			Storage::deleteDirectory('upload/categories/' . $category->id . '/main');
			Storage::put('upload/categories/' . $category->id . '/main/' . $name_img, file_get_contents($category_img));
			$all['img'] = 'upload/categories/' . $category->id . '/main/' . $name_img;
		}
		elseif($all['img_status'] == 'false'){
			$all['img'] = null;
			Storage::deleteDirectory('upload/categories/' . $category->id . '/main');

		}

		// Сreate array for multilanguage (example- (ua|ru|en))
		$all = $this->prepareArticleData($all);

		//Pull imgs from folder and present in JSON format
		$files = Storage::Files('upload/categories/'.$category->id.'/images/');

		Storage::deleteDirectory('upload/categories/' . $category->id . '/min');
		Storage::deleteDirectory('upload/categories/' . $category->id . '/full');

		Storage::makeDirectory('upload/categories/' . $category->id . '/min', '0777', true, true);
		Storage::makeDirectory('upload/categories/' . $category->id . '/full', '0777', true, true);

		foreach($files as $key => $file){
			$savePathMin = str_replace('/'.$category->id.'/images/', '/'.$category->id.'/min/', $file);
			$savePathFull = str_replace('/'.$category->id.'/images/', '/'.$category->id.'/full/', $file);
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

		//Encode images from request
		$all['imgs'] = json_encode($files);

		//Update all data in DB
		$category->update($all);

		//Save all data in DB
		$category->save();

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			//"redirect" => route('admin_dashboard')
		]);
	}

	/*Remove Category with Articles from storage.(@param  int  $id, @return Response */

	public function destroy(Request $request, $type)
	{
		$all = $request->all();
		$id = $all['id'];
		$category = Category::where('id',$id)->first();
		$articles = $category->articles;
		/*Delete articles in category*/
		if($articles){
			foreach($articles as $key => $article){
				$articles[$key]->delete();
				Storage::deleteDirectory('upload/articles/' . $article['id']);
			}
		}

		/*Delete category*/
		if($category AND $category->delete()){
			Storage::deleteDirectory('upload/categories/' . $id);
			return response()->json([
				"status" => 'success',
				"message" => 'Успешно удалено',
				"redirect" => URL::route('admin_dashboard')
			]);
		}
		else{
			return response()->json([
				"status" => 'error',
				"message" => 'Виникла помилка при видаленні'
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
		
		// Removing gaps at the beginning and end of each field
		// foreach($all as $key => $value){
		// 	$all[$key] = trim($value);
		// }

		// Сreate array example (ua|ru|en)
		foreach($langs as $lang){
			$all['title'] +=  [ $lang['lang'] => $all["title_{$lang['lang']}"] ];
			$all['url'] +=  [ $lang['lang'] => $all["url_{$lang['lang']}"] ];

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
			unset($all["url_{$lang['lang']}"]);
			unset($all["short_description_{$lang['lang']}"]);
			unset($all["description_{$lang['lang']}"]);
			unset($all["meta_title_{$lang['lang']}"]);
			unset($all["meta_description_{$lang['lang']}"]);
			unset($all["meta_keywords_{$lang['lang']}"]);
		}
		$all = $this->transformToJson($all);
		return $all;		
	}
	private function initValuesWithDelimiter($all){			
		$all['title'] = '';
		$all['url'] = '';
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
		$all['url'] = [];
		$all['short_description'] = [];
		$all['description'] = [];
		$all['meta_title'] = [];
		$all['meta_description'] = [];
		$all['meta_keywords'] = [];
		return $all;
	}
	private function transformToJson($all){		
		$all['title'] = json_encode($all['title']);
		$all['url'] = json_encode($all['url']);
		$all['short_description'] = json_encode($all['short_description']);
		$all['description'] = json_encode($all['description']);
		$all['meta_title'] = json_encode($all['meta_title']);
		$all['meta_description'] = json_encode($all['meta_description']);
		$all['meta_keywords'] = json_encode($all['meta_keywords']);		
		return $all;
	}
}
