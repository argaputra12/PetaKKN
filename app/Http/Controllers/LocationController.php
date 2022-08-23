<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kota;
use App\Models\Lokasi;
use App\Models\Proker;
use Illuminate\Console\View\Components\Component;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $nama_kota = Kota::whereId($request->id)->first();

        $desa = Desa::where('kota_id', $request->id)->get();


        switch($nama_kota->nama){
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
                return view('location.klaten', compact('desa'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //

        $data = Lokasi::where('desa_id', $request->desa_id)->first();
        $proker = Proker::where('kelompok_id', $data->kelompok_id)->first();

        return view('components.table-data', compact('data', 'proker'));

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
        //
    }
}
