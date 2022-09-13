<?php

namespace App\Exports;

use App\Models\Lokasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Termwind\Components\Dd;

class LokasiExport implements FromView
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('exports.lokasi', [
            'lokasi' => Lokasi::whereIn('id', $this->data)->get()
        ]);
    }
}
