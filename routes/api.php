<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\SendPosition;
use Berkayk\OneSignal\OneSignalClient;
use Berkayk\OneSignal\OneSignalFacade;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function(Request $request) {
   $courier = \App\Courier::where('telephone', $request->get('phone'))->first();
   if($courier) {
       return response()->json(['status' => 'success', 'data' => $courier]);
   }

    return response()->json(['status' => 'error', 'data' => '']);
});

Route::get('orders',function (Request $request){
    //mobil tarafından login olduğu tespit edilen courier id numarasını courier_id parametresi ile yollayacak.
    $orders = \App\Order::where('courier_id', $request->get('courier_id'))->get(['id', 'customer_name']);
    return response()->json([
        'data' =>
            $orders

    ]);
});

//Mobilden gelecek kısım
Route::put('start', function (Request $request){
    $update = App\Order::find($request->get('order_id'));
    $update->track_mode_status = 1;
    $update->courier_number = $request->get('courier_number');
    $update->update();

   /*
   @TODO Müşteriye OneSignal ile bildirim gönderilecek.
   if($update){
        $oneSignal = new OneSignalClient('','',null);
        $oneSignal->sendNotificationToUser(
            "Siparişi Anlık Olarak Takip Etmek İster Misiniz ? 😇",
            $order->player_id,
            $url = "http://localhost?order=".$order->id,
            $data = null,
            $buttons = null,
            $schedule = null,
            $headings = "🚀 Siparişiniz Yola Çıktı 🚀"
        );
    } */
});

//Mobilden Gelecek Kısım
Route::delete('delete/{id}', function ($id){
    $delete = App\Order::find($id)->delete();

    return response()->json([],204);
});

//Mobilden gelecek kısım
Route::post('/map', function(Request $request) {
    $lat = $request->get('lat');
    $long = $request->get('long');
    $courier = $request->get('courier');
    $orderId = $request->get('order_id');
    $order = App\Order::find($orderId);

    $location = ['lat' => $lat, 'long' => $long, 'courier' => $courier ,'order_id' => $orderId];
    if($order && $order->courier_number == $courier){
        event(new SendPosition($location));
        return response()->json(['status' => 'success', 'data' => $location]);
    }

    return response()->json(['status' => 'error', 'data' => '']);
});
