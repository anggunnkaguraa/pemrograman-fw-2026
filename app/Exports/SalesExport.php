<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection(): Collection
    {
        return Transaction::with('user')
            ->whereBetween('created_at', [$this->start, $this->end])
            ->latest()
            ->get();
    }


    public function headings(): array
    {
        return ['No. Invoice', 'Tanggal', 'Kasir', 'Total', 'Bayar'];
    }

    public function map($row): array
    {
        return [
            $row->invoice ?? $row->id,
            $row->created_at->format('d-m-Y H:i'),
            $row->user->name ?? 'Kasir tidak ditemukan',
            $row->total,
            $row->bayar,
        ];
    }
}
