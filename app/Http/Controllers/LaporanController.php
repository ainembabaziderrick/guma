<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Orders;

use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('laporan.index', compact('tanggalAwal', 'tanggalAkhir'));
    }

    public function getData($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $pendapatan = 0;
        $total_pendapatan = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = tanggal_indonesia($tanggal, false);
            $row['penjualan'] = format_uang($total_penjualan);
            $row['pembelian'] = format_uang($total_pembelian);
            $row['pengeluaran'] = format_uang($total_pengeluaran);
            $row['pendapatan'] = format_uang($pendapatan);

            $data[] = $row;
        }
        // visit "codeastro" for more projects!
        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'penjualan' => '',
            'pembelian' => '',
            'pengeluaran' => 'Total Income',
            'pendapatan' => format_uang($total_pendapatan),
        ];

        return $data;
    }

    public function data($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);

        return datatables()
            ->of($data)
            ->make(true);
    }

    public function exportPDF($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);
        $pdf  = PDF::loadView('laporan.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');
        
        return $pdf->stream('Laporan-pendapatan-'. date('Y-m-d-his') .'.pdf');
    }

    public function getDatas($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $total_penjualan = 0;
        $total_pembelian = 0;
        $total_pengeluaran = 0;
        $total_pendapatan = 0;
    
        $penjualan = Penjualan::whereDate('created_at', '>=', $awal)
            ->whereDate('created_at', '<=', $akhir)
            ->get();
    
        $pembelian = Pembelian::whereDate('created_at', '>=', $awal)
            ->whereDate('created_at', '<=', $akhir)
            ->get();
    
        $pengeluaran = Pengeluaran::whereDate('created_at', '>=', $awal)
            ->whereDate('created_at', '<=', $akhir)
            ->get();
    
        foreach ($penjualan as $item) {
            $total_penjualan += $item->bayar;
            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = tanggal_indonesia($item->created_at, false);
            $row['penjualan'] = format_uang($item->bayar);
            $row['pembelian'] = '-';
            $row['pengeluaran'] = '-';
            $row['pendapatan'] = format_uang($item->bayar);
            $data[] = $row;
        }
    
        foreach ($pembelian as $item) {
            $total_pembelian += $item->bayar;
            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = tanggal_indonesia($item->created_at, false);
            $row['penjualan'] = '-';
            $row['pembelian'] = format_uang($item->bayar);
            $row['pengeluaran'] = '-';
            $row['pendapatan'] = format_uang(-$item->bayar);
            $data[] = $row;
        }
    
        foreach ($pengeluaran as $item) {
            $total_pengeluaran += $item->nominal;
            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = tanggal_indonesia($item->created_at, false);
            $row['penjualan'] = '-';
            $row['pembelian'] = '-';
            $row['pengeluaran'] = format_uang($item->nominal);
            $row['pendapatan'] = format_uang(-$item->nominal);
            $data[] = $row;
        }
    
        $total_pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
    
        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => 'Total',
            'penjualan' => format_uang($total_penjualan),
            'pembelian' => format_uang($total_pembelian),
            'pengeluaran' => format_uang($total_pengeluaran),
            'pendapatan' => format_uang($total_pendapatan),
        ];
    
        return $data;
    }
    

public function datas()
{
    $today = now()->format('Y-m-d');
    $data = $this->getDatas($today, $today);

    return datatables()
        ->of($data)
        ->make(true);
}

public function daily(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('laporan.daily', compact('tanggalAwal', 'tanggalAkhir'));
    }

    public function user(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('laporan.user', compact('tanggalAwal', 'tanggalAkhir'));
    }

   public function getDataz($awal, $akhir)
{
    $no = 1;
    $data = array();
    $total_penjualan = 0;
    $total_pembelian = 0;
    $total_pengeluaran = 0;
    $total_pendapatan = 0;

    // Assuming Penjualan, Pembelian, and Pengeluaran are related to users via user_id
    $penjualan = Penjualan::where('user_id', auth()->id()) // Filter by logged-in user
        ->whereDate('created_at', '>=', $awal)
        ->whereDate('created_at', '<=', $akhir)
        ->get();

    $pembelian = Pembelian::where('user_id', auth()->id()) // Filter by logged-in user
        ->whereDate('created_at', '>=', $awal)
        ->whereDate('created_at', '<=', $akhir)
        ->get();

    $pengeluaran = Pengeluaran::where('user_id', auth()->id()) // Filter by logged-in user
        ->whereDate('created_at', '>=', $awal)
        ->whereDate('created_at', '<=', $akhir)
        ->get();

    foreach ($penjualan as $item) {
        $total_penjualan += $item->bayar;
        $row = array();
        $row['DT_RowIndex'] = $no++;
        $row['tanggal'] = tanggal_indonesia($item->created_at, false);
        $row['penjualan'] = format_uang($item->bayar);
        $row['pembelian'] = '-';
        $row['pengeluaran'] = '-';
        $row['pendapatan'] = format_uang($item->bayar);
        $data[] = $row;
    }

    foreach ($pembelian as $item) {
        $total_pembelian += $item->bayar;
        $row = array();
        $row['DT_RowIndex'] = $no++;
        $row['tanggal'] = tanggal_indonesia($item->created_at, false);
        $row['penjualan'] = '-';
        $row['pembelian'] = format_uang($item->bayar);
        $row['pengeluaran'] = '-';
        $row['pendapatan'] = format_uang(-$item->bayar);
        $data[] = $row;
    }

    foreach ($pengeluaran as $item) {
        $total_pengeluaran += $item->nominal;
        $row = array();
        $row['DT_RowIndex'] = $no++;
        $row['tanggal'] = tanggal_indonesia($item->created_at, false);
        $row['penjualan'] = '-';
        $row['pembelian'] = '-';
        $row['pengeluaran'] = format_uang($item->nominal);
        $row['pendapatan'] = format_uang(-$item->nominal);
        $data[] = $row;
    }

    $total_pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;

    $data[] = [
        'DT_RowIndex' => '',
        'tanggal' => 'Total',
        'penjualan' => format_uang($total_penjualan),
        'pembelian' => format_uang($total_pembelian),
        'pengeluaran' => format_uang($total_pengeluaran),
        'pendapatan' => format_uang($total_pendapatan),
    ];

    return $data;
}

    

public function userdatas()
{
    $today = now()->format('Y-m-d');
    $data = $this->getDataz($today, $today);  // Call the getDataz method

    return datatables()
        ->of($data)
        ->make(true);
}


public function userdaily(Request $request)
{
    // Ensure the user is logged in
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Please log in to access your records.');
    }

    // Default date range: first day of the month to today
    $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
    $tanggalAkhir = date('Y-m-d');

    // Update date range based on user input
    if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir != "") {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;
    }

    // Retrieve only records for the logged-in user
    $userId = auth()->id();
    $getRecord = Orders::where('user_id', $userId)
        ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
        ->get();

    return view('laporan.daily', compact('tanggalAwal', 'tanggalAkhir', 'getRecord'));
}

public function daily_sub(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('laporan.daily_sub', compact('tanggalAwal', 'tanggalAkhir'));
    }


}
