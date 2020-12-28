<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\City;
use App\Province;

class GetOngkir extends Controller
{
    public function index(Request $request)
    {
       if($request == null)
       {
        $origin = "";
        $destination = "";
        $weight = "";
        $courier = "";   
       }

        $origin = $request->origin;
        $destination = $request->destination;
        $weight = $request->weight;
        $courier = $request->courier;
        

        $response = Http::asForm()->withHeaders([
            'key' => '3b0606fea105e59c9abbebdef2ac9e85'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin, 
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,

        ]);
        
        $provinces = Province::all();
        $ongkir = $response['rajaongkir']['results'][0]['costs'];
        
        return view('ongkir', compact('provinces', 'ongkir'));
    }

    public function ajax($id)
    {
        $cities = City::where('province_id','=',$id)->pluck('city_name','id');
        return json_encode($cities);
    }
}
