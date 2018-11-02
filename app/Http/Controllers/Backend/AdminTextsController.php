<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend;
//use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use App\Models\Article;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Translate;
use App\Models\Text;
use App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Storage;


class AdminTextsController extends Controller {

	/* List texts - Display a listing of the Texts */

	public function index()
	{
		$admin_texts = Text::all()
			->sortByDesc("priority");
		// List of Softdeletes items
		$admin_texts_deleted = Text::onlyTrashed()->get();

		return view('backend.texts.list',[
			'admin_texts' => $admin_texts,
			'admin_texts_deleted' => $admin_texts_deleted,
		]);
	}

	/*Show the form for creating a new Text.*/

	public function create()
	{
		$langs = Lang::activelangs()->get();
		return view('backend.texts.create', [
			'langs'=>$langs,
			'action_method' => 'post'
		]);
	}

	/* Store a newly created Text in storage.*/

	public function store(Request $request)
	{
		$langs = Lang::activelangs()->get();

		//validation rules
		foreach($langs as $lang){
			$this->validate($request, [
				'title' => 'required|max:255',
			]);
		}
		$all = $request->all();

		// Сreate array for multilanguage (example- (ua|ru|en))
		$all = $this->prepareTextData($all);

		//Create new entry in DB
		Text::create($all);

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => URL::route('text_index')
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

	/*Show the form for editing the Text. (@param  int  $id @return Response*/

	public function edit($id)
	{
		$langs = Lang::activelangs()->get();
		$admin_text = Text::where("id","=","$id")->first();
		return view('backend.texts.edit',[
			'admin_text'=>$admin_text,
			'langs'=>$langs,
			'action_method' => 'put'
		]);
	}

	/* Update the Text in storage.(@param  int  $id,@return Response*/

	public function update(Request $request, $id)
	{
		$langs = Lang::activelangs()->get();

		$admin_text = Text::where('id', '=', $id)->first();

		//create var all for date from request
		$all = $request->all();

		// Сreate array for multilanguage (example- (ua|ru|en))
		$all = $this->prepareTextData($all);
//dd($all);
		//Update all data in DB
		$admin_text->update($all);

		//Save all data in DB
		$admin_text->save();

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => URL::route('text_index')
		]);
	}

	/*Remove the Article from storage.(@param  int  $id, @return Response */

	public function destroy($id)
	{
		$text = Text::where('id', '=', $id)->first();
		if($text AND $text->delete()){
			return response()->json([
				"status" => 'success',
				"message" => 'Успешно удалено'
			]);
		}
		else{
			return response()->json([
				"status" => 'error',
				"message" => 'Виникла помилка при видаленні'
			]);
		}
	}

	/*Recovery Softdeletes items*/

	public function recovery(){
		Text::onlyTrashed()
			->restore();
		return redirect()->route('text_index');
	}

	/*Final Delete items*/

	public function delete(){
		$texts_delete = Text::onlyTrashed();
		$texts_delete->forceDelete();
		return redirect()->route('text_index');
	}

	/* Сreate array for multilanguage (example- (ua|ru|en)) */

	private function prepareTextData($all){
		$langs = Lang::activelangs()->get();

		//if(isset($all['description']))
		//	return $all;

		// Removing gaps at the beginning and end of each field
		// foreach($all as $key => $value){
		// 	$all[$key] = trim($value);
		// }
		// $all['description'] = '';
	//dd($all);
		if(empty($all['description'])){
			$all['description'] = [];
		}

		// Сreate array example (ua|ru|en)
		foreach($langs as $lang){

			if($all['lang_active'] != 0){
				// //dd($all);
				// $all['description'] .=  [ $lang['lang'] => $all["description"]];
				// }else{
				//dd($all);
				$all['description'] +=  [ $lang['lang'] => (isset($all["description_{$lang['lang']}"]) ? $all["description_{$lang['lang']}"] : '') ];
				unset($all["description_{$lang['lang']}"]);

			}
			//dd($all);
			//dd($all);
		}
		$all['description'] = json_encode($all['description']);
		//dd($all);
		return $all;
	}
}
