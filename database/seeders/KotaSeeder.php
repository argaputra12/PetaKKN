<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kotas = [
            [
                'nama' => 'Kota Surakarta',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Surakarta.js',
            ],
            [
                'nama' => 'Kabupaten Boyolali',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Boyolali.js',
            ],
            [
                'nama' => 'Kabupaten Karanganyar',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Karanganyar.js',
            ],
            [
                'nama' => 'Kabupaten Magetan',
                'provinsi' => 'Jawa Timur',
                'js_coordinates' => 'peta/Magetan.js',
            ],
            [
                'nama' => 'Kabupaten Ngawi',
                'provinsi' => 'Jawa Timur',
                'js_coordinates' => 'peta/Ngawi.js',
            ],
            [
                'nama' => 'Kabupaten Sragen',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Sragen.js',
            ],
            [
                'nama' => 'Kabupaten Sukoharjo',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Sukoharjo.js',
            ],
            [
                'nama' => 'Kabupaten Wonogiri',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Wonogiri.js',
            ],
            [
                'nama' => 'Kota Klaten',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Klaten.js',
            ],
            [
                'nama' => 'Kabupaten Magelang',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Magelang.js',
            ],
            [
                'nama' => 'Kabupaten Kebumen',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Kebumen.js',
            ],
            [
                'nama' => 'Kabupaten Pacitan',
                'provinsi' => 'Jawa Timur',
                'js_coordinates' => 'peta/Pacitan.js',
            ],
            [
                'nama' => 'Kabupaten Grobogan',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Grobogan.js',
            ],
            [
                'nama' => 'Kota Brebes',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Brebes.js',
            ],
            [
                'nama' => 'Kabupaten Cilacap',
                'provinsi' => 'Jawa Tengah',
                'js_coordinates' => 'peta/Cilacap.js',
            ],
            [
                'nama' => 'Kota Pangandaran',
                'provinsi' => 'Jawa Barat',
                'js_coordinates' => 'peta/Pangandaran.js',
            ]
        ];

        foreach ($kotas as $kota) {
            Kota::create($kota);
        }
    }
}
