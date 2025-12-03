<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Transaction::with(['barang'])
            ->where('user_id', auth()->id())
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Amount',
            'Tanggal',
            'Update Terakhir',
        ];
    }

    public function map($t): array
    {
        return [
            $t->id,
            $t->barang->nama ?? '-',   
            $t->amount,
            $t->created_at->format('Y-m-d'),
            $t->updated_at->format('Y-m-d'),
        ];
    }
}
