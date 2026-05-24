<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Candidate;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function data()
    {
        $payments = Payment::with('candidate')->orderBy('id', 'desc');

        return datatables()
            ->of($payments)
            ->addIndexColumn()
            ->addColumn('candidate_name', fn($p) => $p->candidate->full_name?? '-')
            ->addColumn('status', function($p){
                $labels = [
                    'pending' => 'warning',
                    'paid' => 'success',
                    'failed' => 'danger',
                    'refunded' => 'info'
                ];
                return '<span class="label label-'.$labels[$p->status].'">'.$p->status.'</span>';
            })
            ->editColumn('amount', fn($p) => '$'.number_format($p->amount, 2))
            ->editColumn('payment_date', fn($p) => $p->payment_date? $p->payment_date->format('Y-m-d') : '-')
            ->addColumn('action', function ($p) {
                return '
                <div class="btn-group">
                    <button onclick="editPayment('.$p->id.')" class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button onclick="deletePayment('.$p->id.')" class="btn btn-xs btn-danger btn-flat">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'type' => 'required|in:processing_fee,visa_fee,ticket_fee,service_fee,refund',
            'status' => 'required|in:pending,paid,failed,refunded',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|max:50',
            'reference_no' => 'nullable|string|max:100',
            'payment_date' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        Payment::create($request->all());
        return response()->json(['status' => 'success', 'message' => 'Payment created']);
    }

    public function update(Request $request)
    {
        $payment = Payment::findOrFail($request->id);
        $payment->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Payment updated']);
    }

    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Payment deleted']);
    }
}