<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('pengeluaran.index');
    }

    public function data()
    {
        $pengeluaran = Pengeluaran::orderBy('id_pengeluaran', 'desc')->get();

        return datatables()
            ->of($pengeluaran)
            ->addIndexColumn()
            ->addColumn('created_at', function ($pengeluaran) {
                return tanggal_indonesia($pengeluaran->created_at, false);
            })
            ->addColumn('nominal', function ($pengeluaran) {
                return format_uang($pengeluaran->nominal);
            })
            ->addColumn('aksi', function ($pengeluaran) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('pengeluaran.update', $pengeluaran->id_pengeluaran) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function daily()
    {
        return view('pengeluaran.daily');
    }

    public function getdata()
{
    // Get the current date in the format YYYY-MM-DD
    $today = now()->format('Y-m-d');

    // Fetch records created on the current day
    $pengeluaran = Pengeluaran::whereDate('created_at', $today)
        ->orderBy('id_pengeluaran', 'desc')
        ->get();

    return datatables()
        ->of($pengeluaran)
        ->addIndexColumn()
        ->addColumn('created_at', function ($pengeluaran) {
            return tanggal_indonesia($pengeluaran->created_at, false);
        })
        ->addColumn('nominal', function ($pengeluaran) {
            return format_uang($pengeluaran->nominal);
        })
        ->addColumn('aksi', function ($pengeluaran) {
            return '
            <div class="btn-group">
                <button type="button" onclick="editForm(`'. route('pengeluaran.update', $pengeluaran->id_pengeluaran) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                <button type="button" onclick="deleteData(`'. route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

public function userexpense()
    {
        return view('pengeluaran.userdaily');
    }

    public function getdatauserexpense()
{
    // Ensure the user is authenticated
    if (!auth()->check()) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    // Get the current date in the format YYYY-MM-DD
    $today = now()->format('Y-m-d');

    // Log the user ID for debugging purposes (remove this in production)
    \Log::info('Fetching expenses for user ID: ' . auth()->user()->id);

    // Fetch records for the logged-in user created on the current day
    $pengeluaran = Pengeluaran::where('user_id', auth()->user()->id)
        ->whereDate('created_at', $today)
        ->orderBy('id_pengeluaran', 'desc')
        ->get();

    return datatables()
        ->of($pengeluaran)
        ->addIndexColumn()
        ->addColumn('created_at', function ($pengeluaran) {
            return tanggal_indonesia($pengeluaran->created_at, false);
        })
        ->addColumn('nominal', function ($pengeluaran) {
            return format_uang($pengeluaran->nominal);
        })
        // Removed the actions column
        ->rawColumns([])  // This ensures there is no raw HTML rendering for actions
        ->make(true);
}

    
 public function sub_daily()
    {
        return view('pengeluaran.sub_daily');
    }
    
     public function sub_getdata()
{
    // Get the current date in the format YYYY-MM-DD
    $today = now()->format('Y-m-d');

    // Fetch records created on the current day
    $pengeluaran = Pengeluaran::whereDate('created_at', $today)
        ->orderBy('id_pengeluaran', 'desc')
        ->get();

    return datatables()
        ->of($pengeluaran)
        ->addIndexColumn()
        ->addColumn('created_at', function ($pengeluaran) {
            return tanggal_indonesia($pengeluaran->created_at, false);
        })
        ->addColumn('nominal', function ($pengeluaran) {
            return format_uang($pengeluaran->nominal);
        })
        ->rawColumns(['aksi'])
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
        // Add the logged-in user's ID to the request data
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
    
        // Create the expense record with the user_id
        $pengeluaran = Pengeluaran::create($data);
    
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
        $pengeluaran = Pengeluaran::find($id);

        return response()->json($pengeluaran);
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
    // visit "codeastro" for more projects!
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id)->update($request->all());

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
        $pengeluaran = Pengeluaran::find($id)->delete();

        return response(null, 204);
    }
}
