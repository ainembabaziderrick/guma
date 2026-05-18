<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Debts;
use App\Models\Debtors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

use PDF;

class TransctionsController extends Controller
{
    public function index()
    {
        return view('transactions.admin');
    }

    public function user()
    {
        return view('transactions.user');
    }
    
    

    public function data()
    {
        $penjualan = Penjualan::with('member', 'user') // include 'user' for kasir column
            ->whereDate('created_at', Carbon::today()) // 🔥 This filters for today only
            ->orderBy('id_penjualan', 'desc')
            ->get();
    
        return datatables()
             ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('total_item', function ($penjualan) {
                return $penjualan->total_item;
            })
            ->addColumn('total_harga', function ($penjualan) {
                return 'Ugx ' . number_format($penjualan->total_harga, 2);
            })
            ->addColumn('bayar', function ($penjualan) {
                return 'Ugx ' . number_format($penjualan->bayar, 2);
            })
            ->addColumn('tanggal', function ($penjualan) {
                return tanggal_indonesia($penjualan->created_at, false);
            })
            ->addColumn('kode_member', function ($penjualan) {
                $member = $penjualan->member->kode_member ?? '';
                return '<span class="label label-success">' . $member . '</span>';
            })
            ->editColumn('diskon', function ($penjualan) {
                return $penjualan->diskon . '%';
            })
            ->editColumn('kasir', function ($penjualan) {
                return $penjualan->user->name ?? '';
            })
            ->addColumn('balance', function ($penjualan) {
                $balance = $penjualan->total_harga - $penjualan->diterima;
                return 'Ugx ' . number_format($balance);
            })
           ->addColumn('aksi', function ($penjualan) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('penjualan.show', $penjualan->id_penjualan) .'`, `'. addslashes($penjualan->member->nama ?? 'Unknown') .'`)" 
                        class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                    
                </div>
                ';
            })
            ->rawColumns(['kode_member', 'aksi'])
            ->make(true);
    }
    

    
public function userdata()
{
    $penjualan = Penjualan::with('member', 'user')
        ->whereDate('created_at', Carbon::today()) // This always filters for today's date
        ->where('id_user', Auth::id())
        ->orderBy('id_penjualan', 'desc')
        ->get();

    return DataTables::of($penjualan)
        ->addIndexColumn()
        ->addColumn('total_item', fn($p) => $p->total_item)
        ->addColumn('total_harga', fn($p) => 'Ugx ' . format_uang($p->total_harga))
        ->addColumn('diterima', fn($p) => 'Ugx ' . format_uang($p->bayar)) // Use correct column name: 'diterima'
        ->addColumn('tanggal', fn($p) => tanggal_indonesia($p->created_at, false))
        ->editColumn('diskon', fn($p) => $p->diskon . '%')
        ->editColumn('kasir', fn($p) => $p->user->name ?? '')
        ->make(true);
}


    
    

    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan->id_member = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);
        return redirect()->route('transaksi.index');
    }

    public function store(Request $request)
    {
        $penjualan = Penjualan::findOrFail($request->id_penjualan);
    
        // Retrieve the subtotal to compare with the payment
        $subtotal = $request->total; // Assuming total is the subtotal passed from the request
        $bayar = $request->bayar; // The amount paid by the user
        $diterima = $request->diterima; // The amount received from the user
    
        // Retrieve the authenticated user
        $user = auth()->user();
    
        // Check if the user level is 2 and if either the payment or the received amount is insufficient
        if ($user->level == 2 && ($bayar > $diterima || $bayar < $subtotal)) {
            return redirect()->back()->with('error', 'Insufficient payment. Transaction cannot be completed.');
        }
    
        // Proceed with saving the transaction
        $penjualan->id_member = $request->id_member;
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $subtotal; // Use subtotal for total_harga
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $bayar;
        $penjualan->diterima = $diterima;
        $penjualan->update();
    
        $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();
    
            $produk = Produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }
    
        return redirect()->route('transaksi.selesai');
    }
    
    public function show($id)
    {
        $detail = PenjualanDetail::with('produk')->where('id_penjualan', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">'. $detail->produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Ugx '. format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Ugx  '. format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }
    
    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $detail    = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->update();
            }

            $item->delete();
        }

        $penjualan->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('penjualan.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (! $penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();
        
        return view('penjualan.nota_kecil', compact('setting', 'penjualan', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (! $penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        $pdf = PDF::loadView('penjualan.nota_besar', compact('setting', 'penjualan', 'detail'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaction-'. date('Y-m-d-his') .'.pdf');
    }

     public function index_sub()
    {
        return view('transactions.sub');
    }

     public function index_data()
    {
        $penjualan = Penjualan::with('member', 'user') // include 'user' for kasir column
            ->whereDate('created_at', Carbon::today()) // 🔥 This filters for today only
            ->orderBy('id_penjualan', 'desc')
            ->get();
    
        return datatables()
             ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('total_item', function ($penjualan) {
                return $penjualan->total_item;
            })
            ->addColumn('total_harga', function ($penjualan) {
                return 'Ugx ' . number_format($penjualan->total_harga, 2);
            })
            ->addColumn('bayar', function ($penjualan) {
                return 'Ugx ' . number_format($penjualan->bayar, 2);
            })
            ->addColumn('tanggal', function ($penjualan) {
                return tanggal_indonesia($penjualan->created_at, false);
            })
            ->addColumn('kode_member', function ($penjualan) {
                $member = $penjualan->member->kode_member ?? '';
                return '<span class="label label-success">' . $member . '</span>';
            })
            ->editColumn('diskon', function ($penjualan) {
                return $penjualan->diskon . '%';
            })
            ->editColumn('kasir', function ($penjualan) {
                return $penjualan->user->name ?? '';
            })
            ->addColumn('balance', function ($penjualan) {
                $balance = $penjualan->total_harga - $penjualan->diterima;
                return 'Ugx ' . number_format($balance);
            })
            ->addColumn('aksi', function ($penjualan) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('penjualan.show', $penjualan->id_penjualan) .'`, `'. addslashes($penjualan->member->nama ?? 'Unknown') .'`)" 
                        class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button onclick="deleteData(`'. route('penjualan.destroy', $penjualan->id_penjualan) .'`)" 
                        class="btn btn-xs btn-danger btn-flat">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                ';
            })
            ->rawColumns(['kode_member', 'aksi'])
            ->make(true);
    }
   

}
