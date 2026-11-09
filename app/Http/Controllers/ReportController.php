<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function sales(Request $request)
    {
        $start = $request->filled('start') ? Carbon::parse($request->start) : now()->subDays(6)->startOfDay();
        $end = $request->filled('end') ? Carbon::parse($request->end)->endOfDay() : now()->endOfDay();

        $transactions = Transaction::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->latest()
            ->get();

        $totalPenjualan = $transactions->sum('total');
        $jumlahTransaksi = $transactions->count();

        return view('reports.sales', compact('transactions', 'totalPenjualan', 'jumlahTransaksi', 'start', 'end'));
    }

    public function export(Request $request)
    {
        $start = $request->filled('start') ? Carbon::parse($request->start) : now()->subDays(6)->startOfDay();
        $end = $request->filled('end') ? Carbon::parse($request->end)->endOfDay() : now()->endOfDay();

        $filename = 'laporan-penjualan-' . $start->format('Ymd') . '-' . $end->format('Ymd') . '.xlsx';

        return Excel::download(new SalesExport($start, $end), $filename);
    }

    public function dashboard()
    {
        $omzetHariIni = \App\Models\Transaction::whereDate('created_at', today())->sum('total');
        $omzetKemarin = \App\Models\Transaction::whereDate('created_at', today()->subDay())->sum('total');

        $transaksiHariIni = \App\Models\Transaction::whereDate('created_at', today())->count();
        $produkMenipis = \App\Models\Product::where('stock', '<=', 10)->count();

        $produkTerlaris = \App\Models\Product::withSum('transactionDetails as total_qty', 'qty')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        $labelTren = [];
        $dataTren = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = today()->subDays($i);
            $labelTren[] = $tanggal->format('d M');
            $dataTren[] = \App\Models\Transaction::whereDate('created_at', $tanggal)->sum('total');
        }

        return view('dashboard', compact(
            'omzetHariIni',
            'omzetKemarin',
            'transaksiHariIni',
            'produkMenipis',
            'produkTerlaris',
            'labelTren',
            'dataTren'
        ));
    }
}
