<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Candidate;
use DB;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index');
    }

    public function data()
    {
        $invoices = Invoice::with('candidate')->orderBy('id', 'desc');

        return datatables()
            ->of($invoices)
            ->addIndexColumn()
            ->addColumn('candidate_name', fn($i) => $i->candidate->full_name ?? '-')
            ->addColumn('status', function($i){
                $labels = ['draft'=>'default', 'sent'=>'warning', 'paid'=>'success', 'cancelled'=>'danger'];
                return '<span class="label label-'.$labels[$i->status].'">'.$i->status.'</span>';
            })
            ->editColumn('total', fn($i) => '$'.number_format($i->total, 2))
            ->editColumn('invoice_date', fn($i) => $i->invoice_date->format('Y-m-d'))
            ->addColumn('action', function ($i) {
                return '
                <div class="btn-group">
                    <a href="'.route('invoice.edit', $i->id).'" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-edit"></i></a>
                    <a href="'.route('invoice.print', $i->id).'" target="_blank" class="btn btn-xs btn-info btn-flat"><i class="fa fa-print"></i></a>
                    <button onclick="deleteInvoice('.$i->id.')" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        $candidates = Candidate::orderBy('full_name')->get();
        return view('invoice.create', compact('candidates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'nullable|exists:candidates,id',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        DB::transaction(function() use ($request) {
            $subtotal = 0;
            foreach($request->items as $item) {
                $subtotal += $item['qty'] * $item['unit_price'];
            }
            $tax = $request->tax ?? 0;
            $total = $subtotal + $tax;

            $invoice = Invoice::create([
                'candidate_id' => $request->candidate_id,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'notes' => $request->notes,
                'status' => 'draft'
            ]);

            foreach($request->items as $item) {
                $invoice->items()->create([
                    'description' => $item['description'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $item['qty'] * $item['unit_price']
                ]);
            }
        });

        return redirect()->route('invoice.index')->with('success', 'Invoice created');
    }

    public function edit($id)
    {
        $invoice = Invoice::with('items', 'candidate')->findOrFail($id);
        $candidates = Candidate::orderBy('full_name')->get();
        return view('invoice.edit', compact('invoice', 'candidates'));
    }

    public function update(Request $request, $id)
    {
        // Same logic as store, but update existing invoice
        $invoice = Invoice::findOrFail($id);
        // ... update logic similar to store
        return redirect()->route('invoice.index')->with('success', 'Invoice updated');
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }

    public function print($id)
    {
        $invoice = Invoice::with('items', 'candidate')->findOrFail($id);
        return view('invoice.print', compact('invoice'));
    }
}