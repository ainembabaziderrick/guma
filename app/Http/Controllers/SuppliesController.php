<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debtors; 
use App\Models\SuppliesModel; 
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\Debts;
use DataTables;
use Carbon\Carbon; // Make sure to import Carbon

class SuppliesController extends Controller
{
    
    public function store()
    {
        return view('supplier.supplier_details');  
    }


    public function getData()
    {
        $supplies = SuppliesModel::orderBy('created_at', 'desc')->get();
    
        return DataTables::of($supplies)
            ->addIndexColumn()
            ->editColumn('created_at', function ($supply) {
                return $supply->created_at
                    ? \Carbon\Carbon::parse($supply->created_at)
                        ->setTimezone('Africa/Kampala')
                        ->format('d-m-Y H:i:s')
                    : 'N/A';
            })
            ->editColumn('date', function ($supply) {
                return $supply->date
                    ? \Carbon\Carbon::parse($supply->date)
                        ->format('d-m-Y')
                    : 'N/A';
            })
            ->addColumn('action', function ($supply) {
                return '<a href="'.url('supplies/delete/'.$supply->id).'" class="btn btn-sm btn-danger">Delete</a>
                        <a href="'.url('suplier/edit/'.$supply->id).'" class="btn btn-sm btn-primary">Update</a>';
            })
            ->rawColumns(['action']) // Render HTML for the action column
            ->make(true);
    }
    

    
    

    public function add_supplies(Request $request){
        return view('supplier.supplies_add');
    }

   
    public function insert_add_supplies(Request $request)
    {
        $save = new SuppliesModel;
        $save->supplier = trim($request->supplier);
        $save->quantity = trim($request->quantity);
        $save->total = trim($request->total);
        $save->paid = trim($request->paid);
        $save->date = trim($request->date);
        
        // Add current timestamp
        $save->created_at = Carbon::now();
        $save->updated_at = Carbon::now();
        
        $save->save();
    
        return redirect('/supplies')->with('success', 'Supply Details successfully created');
    }
    

    public function Deletesupplies($id){
        $delete = SuppliesModel::find($id)->Delete();
        return Redirect()->back()->with('success','Supply Details Cleared succcessfully');
     }

     public function supplies()
     {
         // Get the name of the logged-in user
         $userName = Auth::user()->name;
 
         // Fetch records from the Debtors table where the name matches the logged-in user's name
         $data['getRecord'] = SuppliesModel::where('supplier', $userName)->get();
 
         return view('supplier.supplier', $data);
     }

     public function balances()
     {
         // Get the name of the logged-in user
         $userName = Auth::user()->name;
 
         // Fetch records from the Debtors table where the name matches the logged-in user's name
         $data['getRecord'] = Debts::where('name', $userName)->get();
 
         return view('supplier.balances', $data);
     }
     public function Editsuplier($id){
        $debts = SuppliesModel::find($id);
        return view('supplier.edit', compact('debts'));
     
     }
    
     public function Updatesuplier(Request $request, $id){
        $update = SuppliesModel::find($id)->update([
            'supplier' => $request->supplier,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'paid' => $request->paid,
            'date' => $request->date,
        ]);
    
        return redirect('suppliee/details')->with('success', 'Supply Details Updated Successfully');
    }
}
