<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Lang;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Storage;

class AdminLangsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$langs = Lang::all();
		return view('backend.langs.list')->with(compact('langs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$langs = Lang::activelangs()->get();
		return view('backend.langs.edit',[
			'langs'=>$langs,
			'action_method' => 'post',
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//validation rules
		$validator = Validator::make($request->all(), [
			'lang' => 'required|max:2|unique:langs'
		]);

		if ($validator->fails()) {
			return Response::json(array(
				'success' => false,
				'message' => $validator->messages()->first()
			));
		}

		$all = $request->all();

		//dd($all);
		//add img
		$img = $request->file('img');
		if($img){
			$extension = $img->getClientOriginalExtension();
			$name_img = $all['lang']  . '-' . time() . '.' . $extension;
			Storage::put('upload/langs/' . $all['lang'] .'/' . $name_img, file_get_contents($img));
			$all['img'] = 'upload/langs/' . $all['lang'] .'/' . $name_img;
		}
		//Create new entry in DB
		Lang::create($all);

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => URL::route('langs_index')
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
		$lang = Lang::where('id',$id)->first();
		return view('backend.langs.edit',[
			'lang' => $lang,
			'action_method' => 'put'
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//validation rules
		$validator = Validator::make($request->all(), [
			'lang' => 'required|max:2'
		]);
		if ($validator->fails()) {
			return Response::json(array(
				'success' => false,
				'message' => $validator->messages()->first()
			));
		}

		$lang = Lang::where('id',$id)->first();

		//create var all for date from request
		$all = $request->all();
		//create var all for date from request
		$all = $request->all();
		//dd($all);
		//add img
		$img = $request->file('img');
		if($img){
			$extension = $img->getClientOriginalExtension();
			$name_img = $all['lang']  . '-' . time() . '.' . $extension;
			Storage::put('upload/langs/' . $all['lang'] .'/' . $name_img, file_get_contents($img));
			$all['img'] = 'upload/langs/' . $all['lang'] .'/' . $name_img;
		}
		elseif($all['img_status'] == 'false'){
			$all['img'] = null;
			Storage::deleteDirectory('upload/langs/' . $all['lang']);

		}
		//Update all data in DB
		$lang->update($all);

		//Save all data in DB
		$lang->save();

		//JSON respons when entry in DB successfully
		return response()->json([
			"status" => 'success',
			"message" => 'Успешно сохранено',
			"redirect" => URL::route('langs_index')
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
