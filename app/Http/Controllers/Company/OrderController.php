<?php

namespace App\Http\Controllers\Company;

use App\Courier;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $company_id = $user->companies->first()->id;
        $orders = Order::where('company_id', $company_id)->get();
        $couriers = Courier::where('company_id', $company_id)->get();
        return view('company.orders', compact('orders','couriers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_name = $request->get('customer_name');
        $pure_customer_phone   = $request->get('customer_phone');
        $courier_id   = $request->get('courier_id');
        $customer_phone = str_replace(['(',')',' '],['','',''],$pure_customer_phone);
        $user = Auth::user();
        $company_id = $user->companies->first()->id;

        $customer = Customer::where('phone', $customer_phone)->first();
        if($customer){
            $order = new Order();
            $order->company_id = $company_id;
            $order->courier_id = $courier_id;
            $order->customer_name = $customer_name;
            $order->customer_phone = $customer_phone;
            $order->save();
            if($order){
                return redirect()->back();
            }
        }
        return redirect()->back()->with('error', 'Bu müşteri henüz sizi takip etmek için sistemimizde bulunmuyor.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $company_id = $user->companies->first()->id;
        $order = Order::where('company_id', $company_id)->where('id', $id)->delete();
        return redirect()->back();
    }
}
