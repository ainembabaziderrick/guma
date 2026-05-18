<?php

namespace App\Http\Controllers;

use App\Models\Debts;
use App\Models\CustomeresModel;
use App\Models\Debtors;

use App\Models\DebtsRecovery;
use App\Models\DebtorsRecovery;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class DebtsController extends Controller
{
   
    public function invoices_list(Request $request)
    {
        return view('admin.debts.list');
    }
    public function Debtor(Request $request)
    {
        return view('debtors.debtor');
    }

    public function Debtors()
    {
        $data['getRecord'] = Debtors::get();
        return view('debtors.user_list', $data);
    }

    public function CustomerDebtors()
    {
        // Get the name of the logged-in user
        $userName = Auth::user()->name;

        // Fetch records from the Debtors table where the name matches the logged-in user's name
        $data['getRecord'] = Debtors::where('name', $userName)->get();

        return view('debtors.customer_list', $data);
    }

     public function CustomerDebtors_customer()
    {
        // Get the name of the logged-in user
        $userName = Auth::user()->name;

        // Fetch records from the Debtors table where the name matches the logged-in user's name
        $data['getRecord'] = Debtors::where('name', $userName)->get();

        return view('debtors.customer_debts', $data);
    }

    public function getData()
{
    $debtors = Debtors::select(['id', 'name', 'description', 'amount', 'date', 'created_at']);

    return DataTables::of($debtors)
        ->addIndexColumn()
        ->editColumn('created_at', function ($debtor) {
            // Format the created_at field to show date and Ugandan time
            return \Carbon\Carbon::parse($debtor->created_at)
                ->setTimezone('Africa/Kampala')
                ->format('d-m-Y H:i:s'); // Format as needed
        })
        ->addColumn('action', function($debtor) {
            return '<a href="'.url('debtors/edit/'.$value->id).'" class="btn btn-sm btn-danger">Clear</a>';
        })
        ->make(true);
}


public function getDatas()
{
    $debtors = Debtors::select(['id', 'name', 'description', 'amount', 'date', 'created_at']); // Include 'id' in the select statement

    return DataTables::of($debtors)
        ->addIndexColumn() // Add an incrementing index column
        ->editColumn('created_at', function ($debtor) {
            // Format the created_at field to show only the date and Ugandan time
            return \Carbon\Carbon::parse($debtor->created_at)
                ->setTimezone('Africa/Kampala') // Set timezone to Uganda
                ->format('d-m-Y H:i:s'); // Format to date and time (Ugandan time)
        })
        ->make(true);
}



public function updatePayment(Request $request)
{
    $request->validate([
        'debtor_id' => 'required|exists:debtors,id', // Ensure debtor_id matches the field name in the database
        'amount' => 'required|numeric|min:1',
        'date' => 'required|date',
    ]);

    // Retrieve the debtor based on `debtor_id`
    $debtor = Debts::findOrFail($request->debtor_id);

    if ($debtor->amount >= $request->amount) {
        // Subtract the payment
        $debtor->amount -= $request->amount; 
        $debtor->update(); // Update the debt amount

        // Insert into DebtsRecovery table
        DebtsRecovery::create([
            'debtor_id' => $request->debtor_id,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        return response()->json(['message' => 'Payment successfully recorded']);
    } else {
        return response()->json(['message' => 'Payment exceeds the total debt amount'], 400);
    }
}
public function index()
{
    // Fetch records where amount is greater than 0
    $getRecord = Debts::where('amount', '>', 0)->get();

    return view('debts.list', compact('getRecord'));
}

public function sub_index()
{
    // Fetch records where amount is greater than 0
    $getRecord = Debts::where('amount', '>', 0)->get();

    return view('debts.sub_list', compact('getRecord'));
}


public function data()
{
    $supplier = Supplier::orderBy('id_supplier', 'desc')->get();

    return datatables()
        ->of($supplier)
        ->addIndexColumn()
        ->addColumn('aksi', function ($supplier) {
            return '
            <div class="btn-group">
                <button type="button" onclick="editForm(`'. route('supplier.update', $supplier->id_supplier) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                <button type="button" onclick="deleteData(`'. route('supplier.destroy', $supplier->id_supplier) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
}


public function store(Request $request)
{
    $request->validate([
        'debtor_id' => 'required|exists:debtors,id', // Ensure debtor_id matches the field name in the database
        'amount' => 'required|numeric|min:1',
        'date' => 'required|date',
    ]);

    // Retrieve the debtor based on `debtor_id`
    $debtor = Debts::findOrFail($request->debtor_id);

    if ($debtor->amount >= $request->amount) {
        // Subtract the payment
        $debtor->amount -= $request->amount; 
        $debtor->update(); // Update the debt amount

        // Insert into DebtsRecovery table
       $debts = DebtsRecovery::create($request->all());

        return response()->json(['message' => 'Payment successfully recorded']);
    } else {
        return response()->json(['message' => 'Payment exceeds the total debt amount'], 400);
    }
}


public function Editdebts($id){
    $debts = Debts::find($id);
    return view('debts.edit', compact('debts'));
 
 }

 public function Updatedebt(Request $request, $id){
    $update = Debts::find($id)->update([
        'name' => $request->name,
        'amount' => $request->amount,
        'date' => $request->date,
    ]);

    return redirect('debts')->with('success', 'Debt Paid Successfully');
}

public function Updatedebts(Request $request, $id)
{
    // Find the debt record
    $debt = Debts::find($id);

    if (!$debt) {
        return redirect()->back()->with('error', 'Debt record not found.');
    }

    // Get the amount to pay from the form
    $amountToPay = $request->input('amount');

    // Check that the payment does not exceed the remaining debt
    if ($amountToPay > $debt->amount) {
        return redirect()->back()->with('error', 'Amount to pay cannot exceed the remaining debt.');
    }

    // Subtract the amount to pay from the debt amount
    $remainingAmount = $debt->amount - $amountToPay;
    $debt->update([
        'amount' => $remainingAmount,
        'name' => $request->name,
        'date' => $request->date,
    ]);

    // Log the transaction in the debts_recovery table
    DebtsRecovery::create([
        'debtor_id' => $debt->id,
        'amount' => $amountToPay,
        'date' => now(),
    ]);

    return redirect('debts')->with('success', 'Debt paid successfully and transaction recorded.');
}

public function debts_recovery()
{
    // Eager load debtor's details for each recovery
    $data['getRecord'] = DebtsRecovery::with('debtor')->get();
    return view('debts.recovery', $data);
}
public function daily_debts_recovery()
{
    // Get today's date
    $today = \Carbon\Carbon::today();

    // Eager load debtor's details for each recovery and filter by today's date
    $data['getRecord'] = DebtsRecovery::with('debtor')
        ->whereDate('date', $today) // Filters records for today
        ->get();

    return view('debts.dailyrecovery', $data);
}

public function daily_debtors_recovery()
{
    // Get today's date
    $today = \Carbon\Carbon::today();

    // Eager load debtor's details for each recovery and filter by created_at for today
    $data['getRecord'] = DebtorsRecovery::with('debtor')
        ->whereDate('created_at', $today) // Filters records created today
        ->get();

    return view('debtors.daily_recovery', $data);
}


public function Editdebtors($id){
    $debts = Debtors::find($id);
    return view('debtors.edit', compact('debts'));
 
 }

 
 public function Updatedebtors(Request $request, $id)
 {
     // Retrieve the debtor record based on ID
     $debt = Debtors::find($id);
 
     if (!$debt) {
         return redirect()->back()->with('error', 'Debtor record not found.');
     }
 
     
    // Get the amount to pay from the form
    $amountToPay = $request->input('amount');

    // Check that the payment does not exceed the remaining debt
    if ($amountToPay > $debt->amount) {
        return redirect()->back()->with('error', 'Amount to pay cannot exceed the remaining debt.');
    }

    // Subtract the amount to pay from the debt amount
    $remainingAmount = $debt->amount - $amountToPay;
    $debt->update([
        'amount' => $remainingAmount,
        'name' => $request->name,
        'date' => $request->date,
    ]);
 
         DebtorsRecovery::create([
             'debtor_id' => $debt->id,
             'amount' => $request->amount,
             'date' => $request->date,
         ]);
 
         return redirect('/debtor')->with('success', 'Debtor cleared successfully.');
    
 }
 
public function debtors_recovery()
{
    // Eager load debtor's details for each recovery
    $data['getRecord'] = DebtorsRecovery::with('debtor')->get();
    return view('debtors.recovery', $data);
}


public function getDebtsData()
{
    $debts = Debts::select(['id', 'name', 'description', 'amount', 'date', 'created_at']);
    return DataTables::of($debts)
        ->addColumn('action', function ($debt) {
            return '<a href="'.url('debts/edit/'.$debt->id).'" class="btn btn-sm btn-success">Pay</a>';
        })
        ->editColumn('created_at', function ($debt) {
            return $debt->created_at->format('d-m-Y H:i:s');
        })
        ->make(true);
}

public function sub_getDebtsData()
{
    $debts = Debts::select(['id', 'name', 'description', 'amount', 'date', 'created_at']);
    return DataTables::of($debts)
        ->editColumn('created_at', function ($debt) {
            return $debt->created_at->format('d-m-Y H:i:s');
        })
        ->make(true);
}


public function getDebtorsData()
{
    $debts = Debtors::select(['id', 'name', 'description', 'amount', 'date', 'created_at', 'status']);

    return DataTables::of($debts)
        ->addIndexColumn()
        ->editColumn('created_at', function ($debt) {
            return \Carbon\Carbon::parse($debt->created_at)->format('d-m-Y H:i:s');
        })
        ->editColumn('date', function ($debt) {
            return \Carbon\Carbon::parse($debt->date)->format('d-m-Y');
        })
        ->addColumn('status', function ($debt) {
            if ($debt->status === 'approved') {
                return '<span class="badge bg-success">Approved</span>';
            } elseif ($debt->status === 'denied') {
                return '<span class="badge bg-danger">Denied</span>';
            }
            return '<span class="badge bg-warning text-dark">Pending</span>';
        })
        ->addColumn('action', function ($debt) {
            $approveBtn = '';
            $denyBtn    = '';
            $payBtn     = '';
            $deleteBtn  = '';

            if ($debt->status === 'pending') {
                // approve/deny
                $approveBtn = '<button class="btn btn-sm btn-success approve-debtor" data-id="'.$debt->id.'">Approve</button>';
                $denyBtn    = '<button class="btn btn-sm btn-warning deny-debtor" data-id="'.$debt->id.'">Deny</button>';
            }

            if ($debt->status === 'approved') {
                // Pay button as a link
                $payBtn    = '<a href="'.url('debtors/edit/'.$debt->id).'" class="btn btn-sm btn-primary">Pay</a>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-debtor" data-id="'.$debt->id.'">Delete</button>';
            }

            if ($debt->status === 'denied') {
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-debtor" data-id="'.$debt->id.'">Delete</button>';
            }

            return $approveBtn.' '.$denyBtn.' '.$payBtn.' '.$deleteBtn;
        })
        ->rawColumns(['status','action'])
        ->make(true);
}


public function deleteDebtor(Request $request)
{
    try {
        $debtor = Debtors::findOrFail($request->id); // Find debtor
        $debtor->delete(); // Delete the record

        return response()->json(['success' => 'Debtor deleted successfully.']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error deleting debtor.']);
    }
}

public function getDebtorzData()
{
     $debtors = Debtors::where('status', 'approved')
        ->select(['id','name','description','amount','date','created_at']);

    return DataTables::of($debtors)
        ->addIndexColumn() // Automatically adds a DT_RowIndex column
        ->editColumn('created_at', function ($debt) {
            return \Carbon\Carbon::parse($debt->created_at)->format('d-m-Y H:i:s'); // Format date
        })
        ->editColumn('date', function ($debt) {
            return \Carbon\Carbon::parse($debt->date)->format('d-m-Y'); // Format date
        })
        ->addColumn('action', function ($debt) {
            return '
                <a href="'.url('debtors/edit/'.$debt->id).'" class="btn btn-sm btn-success">Pay</a>
                
            ';
        })
        ->rawColumns(['action']) // Allow rendering HTML for the action column
        ->make(true);
}

public function Debtors_sub(){
        $getRecord = Debtors::where('amount', '>', 0)->get();

        return view('debtors.sub', compact('getRecord'));
       
    }

public function getData_sub()
{
    $debtors = Debtors::where('status', 'approved')
        ->select(['id','name','description','amount','date','created_at']);

    return DataTables::of($debtors)
        ->addIndexColumn()
        ->editColumn('created_at', function ($debtor) {
            return \Carbon\Carbon::parse($debtor->created_at)
                ->setTimezone('Africa/Kampala')
                ->format('d-m-Y H:i:s');
        })
        ->addColumn('action', function($debtor) {
            return '<a href="'.url('sub/debtors/edit/'.$debtor->id).'" class="btn btn-sm btn-success">Pay</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
}



public function add_debtors(Request $request){
        return view('debtors.sub_add');
    }

  public function insert_add_debtors(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'amount' => 'required|numeric',
        'date' => 'required|date',
    ]);

    $save = new Debtors();
    $save->name = trim($request->name);
    $save->description = trim($request->description);
    $save->amount = trim($request->amount);
    $save->date = trim($request->date);
    $save->status = 'pending'; // ⬅️ key line

    $save->save();

    return redirect()->route('debtor.sub')
                     ->with('success', 'Debtor submitted for admin approval.');
}


public function pendingDebtors()
{
    $pending = Debtors::where('status','pending')->get();
    return view('admin.debtors.pending', compact('pending'));
}


public function approveDebtor(Request $request)
{
    $debt = Debtors::findOrFail($request->id);
    $debt->status = 'approved';
    $debt->save();

    return response()->json(['message' => 'Debtor approved successfully']);
}

public function denyDebtor(Request $request)
{
    $debt = Debtors::findOrFail($request->id);
    $debt->status = 'denied';
    $debt->save();

    return response()->json(['message' => 'Debtor denied successfully']);
}


    public function Editdebtors_sub($id){
    $debts = Debtors::find($id);
    return view('debtors.edit_sub', compact('debts'));
 
 }

 
 public function Updatedebtors_sub(Request $request, $id)
 {
     // Retrieve the debtor record based on ID
     $debt = Debtors::find($id);
 
     if (!$debt) {
         return redirect()->back()->with('error', 'Debtor record not found.');
     }
 
     
    // Get the amount to pay from the form
    $amountToPay = $request->input('amount');

    // Check that the payment does not exceed the remaining debt
    if ($amountToPay > $debt->amount) {
        return redirect()->back()->with('error', 'Amount to pay cannot exceed the remaining debt.');
    }

    // Subtract the amount to pay from the debt amount
    $remainingAmount = $debt->amount - $amountToPay;
    $debt->update([
        'amount' => $remainingAmount,
        'name' => $request->name,
        'date' => $request->date,
    ]);
 
         DebtorsRecovery::create([
             'debtor_id' => $debt->id,
             'amount' => $request->amount,
             'date' => $request->date,
         ]);
 
         return redirect('/debtors/sub')->with('success', 'Debtor cleared successfully.');
    
 }

}
