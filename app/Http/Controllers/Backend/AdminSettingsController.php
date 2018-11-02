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
use App\Models\Setting;
use App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Storage;
use Validator;
use Redirect;
use Mail;

class AdminSettingsController extends Controller {

	/* List texts - Display a listing of the Settings */

	public function index()
	{
		$settings = Setting::all();
		// List of Softdeletes items
		$settings_deleted = Setting::onlyTrashed()->get();
		return view('backend.settings.list',[
			'settings' => $settings,
			'settings_deleted' => $settings_deleted
		]);
	}

	/*Show the form for creating a new Setting.*/

	public function create()
	{
		return view('backend.settings.edit',[
			'action_method' => 'post'
		]);
	}

	/* Store a newly created Setting in storage.*/

	public function store(Request $request)
	{
		//validation rules
		$validator = Validator::make($request->all(), [
			'title' => 'required|max:255',
			'description' => 'required|max:255',
			'name' => 'required|max:255',

		]);
		if ($validator->fails()) {
			return Response::json(array(
				'success' => false,
				'message' => $validator->messages()->first()
			));
		}

		$all = $request->all();

		//Create new entry in DB
		Setting::create($all);

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => URL::route('settings_index')
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$setting = Setting::where('id',$id)->first();
		return view('backend.settings.edit',[
			'setting' => $setting,
			'action_method' => 'put'
		]);
	}

	/* Update the Text in storage.(@param  int  $id,@return Response*/

	public function update(Request $request, $id)
	{
		//validation rules
		$validator = Validator::make($request->all(), [
			'title' => 'required|max:255',
			'description' => 'required|max:255',
			'name' => 'required|max:255',
		]);
		if ($validator->fails()) {
			return Response::json(array(
				'success' => false,
				'message' => $validator->messages()->first()
			));
		}

		$setting = Setting::where('id',$id)->first();

		//create var all for date from request
		$all = $request->all();

		//Update all data in DB
		$setting->update($all);

		//Save all data in DB
		$setting->save();

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => URL::route('settings_index')
		]);
	}

	/*Remove the Settings from storage.(@param  int  $id, @return Response */

	public function destroy($id)
	{
		$setting = Setting::where('id',$id)->first();
		if($setting AND $setting->delete()){
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
		Setting::onlyTrashed()
			->restore();
		return redirect()->route('settings_index');
	}

	/*Final Delete items*/

	public function delete(){
		$settings_delete = Setting::onlyTrashed();
		$settings_delete->forceDelete();
		return redirect()->route('settings_index');
	}

}
