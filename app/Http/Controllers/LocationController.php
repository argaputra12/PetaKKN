<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Error;

class LocationController extends Controller
{
    //public index
    public function index(Request $request)
    {

        $cityName = $request->location;
        // dd($cityName);


        $location = DB::table('locations')->where('name', $cityName)->orWhere('name', 'like', '%' . $cityName . '%')->select('name')->get();

        // return view('components.map');
        // dd($location);

        // dd($location[0]->name);

        switch($location[0]->name){

            case 'Kota Surakarta':
                return view('location.surakarta');
                break;

            case 'Kabupaten Boyolali':
                return view('location.boyolali');
                break;

            case 'Kabupaten Klaten':
                return view('location.klaten');
                break;

            case 'Kabupaten Karanganyar':
                return view('location.karanganyar');
                break;

            case 'Kabupaten Magetan':
                return view('location.magetan');
                break;

            case 'Kabupaten Ngawi':
                return view('location.ngawi');
                break;

            case 'Kabupaten Sragen':
                return view('location.sragen');
                break;

            case 'Kabupaten Sukoharjo':
                return view('location.sukoharjo');
                break;

            case 'Kabupaten Wonogiri':
                return view('location.wonogiri');
                break;

            case 'Kota Klaten':
                return view('location.klaten');
                break;

            case 'Kabupaten Magelang':
                return view('location.magelang');
                break;

            case 'Kabupaten Kebumen':
                return view('location.kebumen');
                break;

            case 'Kabupaten Pacitan':
                return view('location.pacitan');
                break;

            case 'Kabupaten Grobogan':
                return view('location.grobogan');
                break;

            case 'Kota Brebes':
                return view('location.brebes');
                break;

            case 'Kabupaten Cilacap':
                return view('location.cilacap');
                break;

            case 'Kota Pangandaran':
                return view('location.pangandaran');
                break;

        }
    }
}
