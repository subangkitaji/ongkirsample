<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GetOngkir extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'key' => '3b0606fea105e59c9abbebdef2ac9e85'
        ])->get('https://api.rajaongkir.com/starter/province');
        return $response['rajaongkir']['results'];

    }
}
