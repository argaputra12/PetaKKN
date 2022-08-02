<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // KKN location
        $location = [
                [
                    'name' => 'Kota Surakarta',
                    'js_coordinates' => 'peta/Surakarta.js',
                ],
                [
                    'name' => 'Kabupaten Boyolali',
                    'js_coordinates' => 'peta/Boyolali.js',
                ],
                [
                    'name' => 'Kabupaten Karanganyar',
                    'js_coordinates' => 'peta/Karanganyar.js',
                ],
                [
                    'name' => 'Kabupaten Magetan',
                    'js_coordinates' => 'peta/Magetan.js',
                ],
                [
                    'name' => 'Kabupaten Ngawi',
                    'js_coordinates' => 'peta/Ngawi.js',
                ],
                [
                    'name' => 'Kabupaten Sragen',
                    'js_coordinates' => 'peta/Sragen.js',
                ],
                [
                    'name' => 'Kabupaten Sukoharjo',
                    'js_coordinates' => 'peta/Sukoharjo.js',
                ],
                [
                    'name' => 'Kabupaten Wonogiri',
                    'js_coordinates' => 'peta/Wonogiri.js',
                ],
                [
                    'name' => 'Kota Klaten',
                    'js_coordinates' => 'peta/Klaten.js',
                ],
                [
                    'name' => 'Kabupaten Magelang',
                    'js_coordinates' => 'peta/Magelang.js',
                ],
                [
                    'name' => 'Kabupaten Kebumen',
                    'js_coordinates' => 'peta/Kebumen.js',
                ],
                [
                    'name' => 'Kabupaten Pacitan',
                    'js_coordinates' => 'peta/Pacitan.js',
                ],
                [
                    'name' => 'Kabupaten Grobogan',
                    'js_coordinates' => 'peta/Grobogan.js',
                ],
                [
                    'name' => 'Kota Brebes',
                    'js_coordinates' => 'peta/Brebes.js',
                ],
                [
                    'name' => 'Kabupaten Cilacap',
                    'js_coordinates' => 'peta/Cilacap.js',
                ],
                [
                    'name' => 'Kota Pangandaran',
                    'js_coordinates' => 'peta/Pangandaran.js',
                ]
            ];

        foreach ($location as $loc) {
            Location::create($loc);
        }

    }
}
