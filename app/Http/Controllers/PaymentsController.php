<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Coinbase;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function webhook(){
        // $charges = Coinbase::getCharges();
        // dump($charges);
        // $events = Coinbase::getEvents();
        // dd($events);

        $orders = DB::table('coinbase_webhook_calls')->get();

        return view('testpayments', [
            'payments' => $orders
        ]);
    }

    public function createOrder($modelid, Request $request){
        if($request->isMethod('get')){
            $model = User::where('id', $modelid)->first();
            $services = Service::where('name', $model->name)->get();
            
            return view('orders.createOrder', [
                'model' => $model,
                'services' => $services
                
            ]);
            
        }else if($request->isMethod('post')){
            $validated = $request->validate([
                'service' => 'required',
                'info' => 'required'
            ]);
            $service = explode(';', $request->service);

            $charge = Coinbase::createCharge([
                'name' => 'Boobify',
                'description' => $service[0],
                'local_price' => [
                    'amount' => intval($service[1]+2),
                    'currency' => 'USD',
                ],
                'pricing_type' => 'fixed_price',
                'metadata' => [
                    'user_name' => Auth::user()->name,
                    'model_name' => $request->model,
                    'service_name' => $service[0],
                    'price' => $service[1],
                    'info' => $request->info
                ]
            ]);

            return view('orders.paymentScreen',[
                'charge_code' => $charge['data']['code'],
                'metadata' => [
                    'user_name' => Auth::user()->name,
                    'model_name' => $request->model,
                    'service_name' => $service[0],
                    'price' => $service[1],
                    'info' => $request->info,
                    'current_status' => 'NEW'
                ]
            ]);
        }
    }

    public function viewOrder($code){
         $order = Orders::where('payment_id', $code)->first();

         return view('orders.paymentScreen', [
            'charge_code' => $order->payment_id,
            'metadata' => [
                'user_name' => $order->user_name,
                'model_name' => $order->model_name,
                'service_name' => $order->service_name,
                'price' => $order->price,
                'info' => $order->info,
                'current_status' => $order->current_status
            ]
            ]);
    }

    public function completeOrder($code, Request $request){
        if($request->isMethod('get')){

            $order = Orders::where('payment_id', $code)->first();

            return view('orders.completeOrder', [
                'charge_code' => $code,
                'metadata' => [
                    'user_name' => $order->user_name,
                    'model_name' => $order->model_name,
                    'service_name' => $order->service_name,
                    'price' => $order->price,
                    'info' => $order->info,
                    'current_status' => $order->current_status
                ]
            ]);
        }else if($request->isMethod('post')){
            $validated = $request->validate([
                'images' => 'required'
            ]);

            $img_ids = [];
            foreach ($request->images as $img){
                $file = $img->storeOnCloudinary();
                array_push($img_ids, $file->getPublicId());
            }
            $img_ids = implode(';', $img_ids);

            Orders::where('payment_id', $code)->update([
                'images_links' => $img_ids,
                'current_status' => 'COMPLETED'
            ]);

            $order = Order::where('payment_id', $code)->first();
            $model = User::where('name', Auth::user()->name)->first();
            User::where('name', $order->model_name)->update([
                'earnings' => $model->earnings + intval($order->price)*0.8,
                'balance' => $model->balance + intval($order->price)*0.8
            ]);

            return redirect('dashboard');
        }
    }

    public function receiveImages($code){
        $order = Orders::where('payment_id', $code)->first();
        $imgs = explode(';', $order->images_links);

        return view('orders.receiveImages', [
            'charge_code' => $code,
            'metadata' => [
                'user_name' => $order->user_name,
                'model_name' => $order->model_name,
                'service_name' => $order->service_name,
                'price' => $order->price,
                'info' => $order->info,
                'current_status' => $order->current_status
            ],
            'imgs' => $imgs
        ]);
    }

}
