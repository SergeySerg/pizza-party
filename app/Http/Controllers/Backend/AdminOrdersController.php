<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminOrdersController extends Controller
{
    public function index(){			
        $orders = Order::getOrders()->paginate(2);
		return view('backend.orders.list',[
			'orders' => $orders
		]);

    }
    public function change_status(Request $request){	
        if ($request ->isMethod('post')){
			/*get [] from request*/
            $all = $request->all();
            Order::where('id', $all['id'])->update(['status' => !$all['status']]);
            return response()->json([
				'success' => 'true'
			]);
		}		
        

	}
}
