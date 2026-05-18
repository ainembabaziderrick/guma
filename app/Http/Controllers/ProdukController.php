<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use PDF;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');

        return view('produk.index', compact('kategori'));
    }

    public function data()
    {
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
            ->select('produk.*', 'nama_kategori')
            // ->orderBy('kode_produk', 'asc')
            ->get();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '
                    <input type="checkbox" name="id_produk[]" value="'. $produk->id_produk .'">
                ';
            })
            ->addColumn('kode_produk', function ($produk) {
                return '<span class="label label-success">'. $produk->kode_produk .'</span>';
            })
            ->addColumn('harga_beli', function ($produk) {
                return format_uang($produk->harga_beli);
            })
            ->addColumn('harga_jual', function ($produk) {
                return format_uang($produk->harga_jual);
            })
            ->addColumn('stok', function ($produk) {
                return $produk->stok;
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('produk.update', $produk->id_produk) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('produk.destroy', $produk->id_produk) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_produk', 'select_all'])
            ->make(true);
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
        $produk = Produk::latest()->first() ?? new Produk();
        $request['kode_produk'] = 'P'. tambah_nol_didepan((int)$produk->id_produk +1, 6);

        $produk = Produk::create($request->all());

        return response()->json('Data saved successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        return response()->json($produk);
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
        $produk = Produk::find($id);
        $produk->update($request->all());

        return response()->json('Data saved successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }
    // visit "codeastro" for more projects!
    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }

        $no  = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('product.pdf');
    }

    public function getStock($id)
{
    $product = Produk::findOrFail($id);
    return response()->json(['stock' => $product->stok]);
}

 public function sub()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');

        return view('produk.index_sub', compact('kategori'));
    }

     public function data_sub()
    {
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
            ->select('produk.*', 'nama_kategori')
            // ->orderBy('kode_produk', 'asc')
            ->get();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '
                    <input type="checkbox" name="id_produk[]" value="'. $produk->id_produk .'">
                ';
            })
            ->addColumn('kode_produk', function ($produk) {
                return '<span class="label label-success">'. $produk->kode_produk .'</span>';
            })
            ->addColumn('harga_beli', function ($produk) {
                return format_uang($produk->harga_beli);
            })
            ->addColumn('harga_jual', function ($produk) {
                return format_uang($produk->harga_jual);
            })
            ->addColumn('stok', function ($produk) {
                return $produk->stok;
            })
           
            ->rawColumns(['aksi', 'kode_produk', 'select_all'])
            ->make(true);
    }

    //low stock
    public function lowstock()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');

        return view('produk.lowstock', compact('kategori'));
    }

    public function lowstock_data()
{
    $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
        ->where('produk.stok', '<', 10) // only low stock items
        ->select('produk.*', 'kategori.nama_kategori')
        ->get();

    return datatables()
        ->of($produk)
        ->addIndexColumn()

        ->addColumn('select_all', function ($produk) {
            return '<input type="checkbox" name="id_produk[]" value="'.$produk->id_produk.'">';
        })

        ->addColumn('kode_produk', function ($produk) {
            return '<span class="label label-success">'.$produk->kode_produk.'</span>';
        })

        ->addColumn('harga_beli', function ($produk) {
            return format_uang($produk->harga_beli);
        })

        ->addColumn('harga_jual', function ($produk) {
            return format_uang($produk->harga_jual);
        })

        ->addColumn('stok', function ($produk) {

            // highlight stock
            if ($produk->stok < 3) {
                return '<span class="label label-danger">'.$produk->stok.'</span>'; // red
            }

            return '<span class="label label-warning">'.$produk->stok.'</span>'; // yellow
        })

        ->addColumn('aksi', function ($produk) {
            return '
            <div class="btn-group">
                <button type="button" onclick="editForm(`'.route('produk.update', $produk->id_produk).'`)" class="btn btn-xs btn-primary btn-flat">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" onclick="deleteData(`'.route('produk.destroy', $produk->id_produk).'`)" class="btn btn-xs btn-danger btn-flat">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
            ';
        })

        ->rawColumns(['select_all','kode_produk','stok','aksi'])
        ->make(true);
}

public function lowstock_sub()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');

        return view('produk.lowstock_sub', compact('kategori'));
    }

    public function lowstock_data_sub()
{
    $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
        ->where('produk.stok', '<', 10) // only low stock items
        ->select('produk.*', 'kategori.nama_kategori')
        ->get();

    return datatables()
        ->of($produk)
        ->addIndexColumn()

        ->addColumn('select_all', function ($produk) {
            return '<input type="checkbox" name="id_produk[]" value="'.$produk->id_produk.'">';
        })

        ->addColumn('kode_produk', function ($produk) {
            return '<span class="label label-success">'.$produk->kode_produk.'</span>';
        })

        ->addColumn('harga_beli', function ($produk) {
            return format_uang($produk->harga_beli);
        })

        ->addColumn('harga_jual', function ($produk) {
            return format_uang($produk->harga_jual);
        })

        ->addColumn('stok', function ($produk) {

            // highlight stock
            if ($produk->stok < 3) {
                return '<span class="label label-danger">'.$produk->stok.'</span>'; // red
            }

            return '<span class="label label-warning">'.$produk->stok.'</span>'; // yellow
        })       

        ->rawColumns(['select_all','kode_produk','stok','aksi'])
        ->make(true);
}

}
