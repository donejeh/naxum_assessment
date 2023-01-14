<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Helper\Helper;
use Response;

class ReportController extends Controller
{
    //

    public function index(){
       
        //using lazy loading in eloquent for fast query loading
        $users = Order::with(['user','product'])->paginate(getPaginate(5));

        return view('home',compact('users'));
    }
    
    // fetch function for model
    public function fetch(Request $request){

        $order = Order::with(['product'])->where('purchaser_id',$request->id)->get();

        $tr = [];
        foreach ($order as $order){
            $tr[] = '<tr>
            <td> '. $order->product[0]->sku .'</td>
            <th scope="row">'. $order->product[0]->name .'</th>
            <td>'. $order->product[0]->price .' </td>
            <td>'. $order->product[0]->pivot->qantity .' </td>
            <td>'. $order->product[0]->price * $order->product[0]->pivot->qantity .'</td>
        </tr>';
    }

    return $tr;
   
    }

    public function search(Request $request)
    {
        $users = Order::whereBetween('order_date', [$request->from, $request->to])->with(['user','product'])
        ->orderBy('order_date','desc')->paginate(getPaginate());

        return view('home',compact('users'));
    }
    
    //Distributor filter autocomplete here
    public function autocomplete(Request $request)
    {
        $data = User::select("username as value", "id",'first_name','last_name')
                    ->where('last_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->orWhere('first_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->orWhere('id', 'LIKE', '%'. $request->get('search'). '%')
                    ->limit(5)
                    ->get();
    
        return response()->json($data);
    }

    public function topDistributors(){


        $topUsers =  DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.purchaser_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
           // ->where('order_items.product_id', '=', 'products.id')
            ->select(['users.first_name','users.last_name',DB::raw('sum(order_items.qantity * products.price) as total')])
            ->groupBy('orders.purchaser_id')
            ->orderByDesc('total')
            ->limit(100)
            ->paginate(getPaginate(15));

            return view('top',compact('topUsers'));
            
    }
}
