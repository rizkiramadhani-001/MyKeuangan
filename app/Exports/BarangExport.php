<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::where('user_id', auth()->user()->id)->select('id', 'user_id', 'nama', 'deskripsi', 'tipe', 'harga')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'UserId',
            'Nama Barang',
            'Deskripsi',
            'Tipe',
            'Harga',    
        ];
    }
}
