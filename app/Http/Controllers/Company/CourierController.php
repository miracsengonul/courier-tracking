<?php

namespace App\Http\Controllers\Company;

use App\Courier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierController extends Controller
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
        $couriers = Courier::where('company_id', $company_id)->get();
        return view('company.couriers', compact('couriers'));
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
        $user = Auth::user();
        $company_id = $user->companies->first()->id;

        $name = $request->get('courier_name');
        $phone = $request->get('courier_phone');
        $courier = new Courier();
        $courier->name = $name;
        $courier->telephone = $phone;
        $courier->company_id = $company_id;
        $courier->save();
        if($courier){
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Başarısız, Kurye Eklenemedi !');
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
        $order = Courier::where('company_id', $company_id)->where('id', $id)->delete();
        return redirect()->back();
    }
}
