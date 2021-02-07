<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\Homepage\SavePhoneOfCustomerRequest;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = $request->get('order');
        $findOrder = Order::where('id',$order)->where('track_mode_status',1)->first();
        if($findOrder)
        {
            $courierNumber = $findOrder->courier_number;
            return view('welcome', compact('findOrder','courierNumber'));
        }

        return view('index');
    }

    public function savePhoneOfCustomer(SavePhoneOfCustomerRequest $request)
    {
        $pure_phone = $request->get('phone');
        $player_id = $request->get('one_signal_user_id');
        $phone = str_replace(['(',')',' '],['','',''],$pure_phone);
        $customer = Customer::updateOrCreate(['phone' => $phone],['phone' => $phone, 'player_id' => $player_id]);
        if($customer){
            return response()->json(['msg'=> 'Başarıyla Kayıt Oldunuz !']);
        }
        return response()->json(['msg'=> 'Üzgünüm, gerekli izinleri vermeniz gerekiyor !']);
    }
}
