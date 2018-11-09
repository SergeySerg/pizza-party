<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Order;
use App\Models\Text;
use App;
use DB;
use Illuminate\Support\Facades\Response;
use Mail;
use Illuminate\Support\Facades\Validator;
use Debugbar;
use Illuminate\Pagination\Paginator;
class ArticleController extends Controller {	

	/**
	 * Display a listing of the resource with subdomain.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{	
		return view('frontend.main');
	}
	public function render_list(Request $request)
	{	
		$type = $request->type;
		if($type != 'map' AND $type != 'cart'){
			$categories = $request->instance()->query('categories');
			$category = $categories->where('link', $type)->first();
			if($type != 'feedback'){
				$articles = $category->articles()->activeAndSortArticles()->get();
			}else{
				$articles = $category->articles()->where ('active',1)->orderBy('date','desc')->simplepaginate(10);
			}
	
		}
		return view('frontend.' . $type)->with(compact('category', 'articles'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		$article = Article::where('attributes->url', $request->url)->first();
		
		if(!$article) return view('frontend.404');
		return view('frontend.article')->with(compact('article'));
	}
	/**
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showSeo(Request $request)
	{
		$seo_article = Article::where('attributes->url->' . App::getLocale(), $request->url )->first();
		
		//dd($seo_article);
		return view('frontend.seo')->with(compact('seo_article'));
	}
	public function show404(Request $request)
	{
		return view('frontend.404');
	}
	
	public function showMainPage($type){
		/*Select slide that check as show_main_page*/
		$category_item = Category::with('articles')->select('id')->where('link', $type)->first();
			Debugbar::info($category_item);
		$main_item = $category_item->articles()->where('attributes->show_main_page', 1)->activeAndSortArticles()->get();
			Debugbar::info($main_item);
		return $main_item;
		
		 
		
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
	public function contact(Request $request, $lang)
	{
		//dd('contact');
		if ($request ->isMethod('post')){
			/*get [] from request*/
			$all = $request->all();

			/*make rules for validation*/
			$rules = [
				'name' => 'required|max:50',
				'email' => 'required|email',
				'text' => 'required|max:600'
			];

			/*validation [] according to rules*/
			$validator = Validator::make($all, $rules);

			/*send error message after validation*/
			if ($validator->fails()) {
				return response()->json(array(
					'success' => false,
					'message' => $validator->messages()->first()
				));
			}

			//Send item on admin email address
			Mail::send('emails.contact', $all, function($message){
				$email = getSetting('config.email');
				$message->to($email, 'Globaltobacco')->subject('Сообщение с сайта "Globaltobacco"');
			});
			return response()->json([
				'success' => 'true'
			]);
		}
	}
	public function reserved(Request $request, $lang)
	{
		//dd('reserved');
		if ($request ->isMethod('post')){
			/*get [] from request*/
			$all = $request->json()->all();
//dd($all);
			/*make rules for validation*/
			$rules = [
				'name' => 'required|max:30',
				'email' => 'email',
				'phone' => 'required|max:15'
			];

			/*validation [] according to rules*/
			$validator = Validator::make($all, $rules);

			/*send error message after validation*/
			if ($validator->fails()) {
				return response()->json(array(
					'success' => false,
					'message' => $validator->messages()->first()
				));
			}
			//Send item on admin email address
			Mail::send('emails.reserved', $all, function($message){
				$email = getSetting('config.email');
				$message->to($email, ' PIzza-party')
						->subject('Бронювання з сайту  PIzza-party');
			});
			return response()->json([
				'success' => 'true'
			]);
		}
	}
	public function callback(Request $request, $lang)
	{
		//dd($request->all());
		if ($request ->isMethod('post')){
			/*get [] from request*/
			$all = $request->all();

			/*make rules for validation*/
			$rules = [
				'callback_name' => 'required|max:50',
				'callback_phone' => 'required|max:15'				
			];

			/*validation [] according to rules*/
			$validator = Validator::make($all, $rules);

			/*send error message after validation*/
			if ($validator->fails()) {
				return response()->json(array(
					'success' => false,
					'message' => $validator->messages()->first()
				));
			}

			//Send item on admin email address
			Mail::send('emails.callback', $all, function($message) use ($all){
				$email = getSetting('config.email');
				$message->to($email, ' PIzza-party')->subject('Зворотній зв\'язок "' . $all['type'] . '"');
			});
			return response()->json([
				'success' => 'true'
			]);
		}
	}
	public function add_review(Request $request, $lang)
	{
		//dd('add_review');
		if ($request ->isMethod('post')){
			/*get [] from request*/
			$all = $request->all();
			
			/*make rules for validation*/
			$rules = [
				'name' => 'required|max:50',
				'review' => 'required|max:500'				
			];

			/*validation [] according to rules*/
			$validator = Validator::make($all, $rules);

			/*send error message after validation*/
			if ($validator->fails()) {
				return response()->json(array(
					'success' => false,
					'message' => $validator->messages()->first()
				));
			}			
			//dd($all);
			//$all = $this->prepareArticleData($all);
			
			$category = Category::where('link', 'feedback')->first();
			
			$data = [
				'category_id' => $category->id,
				'title' =>  json_encode([config('app.locale') => 'Отзыв от' . $all['name']]),
				'date' => date('Y-m-d H:i:s'),
				'active' => 1,
				'attributes' => json_encode($all)

			];
			
			$review = Article::create($data);			
			$data_to_mail = [
				'review_id' => $review->id 	
			];
			
			
			//Send item on admin email address
			Mail::send('emails.add_reviews', $data_to_mail, function($message){
				$email = getSetting('config.email');
				$message->to($email, 'PIzza-party')->subject('Новый отзыв');
			});
			return response()->json([
				'success' => 'true',
				'data' => $review
			]);
		}
	}
}
