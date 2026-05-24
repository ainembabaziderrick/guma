<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentCommission;
use App\Models\Candidate;
use App\Models\User;

class AgentCommissionController extends Controller
{
    public function index()
    {
        $agents = User::where('level', 2)->get(); 
        return view('commission.index', compact('agents'));
    }

    public function data()
    {
        $commissions = AgentCommission::with(['agent', 'candidate', 'invoice'])
            ->orderBy('id', 'desc');

        return datatables()
            ->of($commissions)
            ->addIndexColumn()
            ->addColumn('agent_name', fn($c) => $c->agent->name?? '-')
            ->addColumn('candidate_name', fn($c) => $c->candidate->full_name?? '-')
            ->addColumn('status', function($c){
                $labels = ['pending'=>'warning', 'approved'=>'info', 'paid'=>'success', 'cancelled'=>'danger'];
                return '<span class="label label-'.$labels[$c->status].'">'.$c->status.'</span>';
            })
            ->editColumn('commission_amount', fn($c) => '$'.number_format($c->commission_amount, 2))
            ->editColumn('earned_date', fn($c) => $c->earned_date->format('Y-m-d'))
            ->addColumn('action', function ($c) {
                $btns = '<button onclick="editCommission('.$c->id.')" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-edit"></i></button>';
                if($c->status == 'approved') {
                    $btns.= ' <button onclick="markPaid('.$c->id.')" class="btn btn-xs btn-success btn-flat"><i class="fa fa-money"></i> Pay</button>';
                }
                $btns.= ' <button onclick="deleteCommission('.$c->id.')" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                return $btns;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:users,id',
            'candidate_id' => 'required|exists:candidates,id',
            'invoice_id' => 'nullable|exists:invoices,id',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'base_amount' => 'required|numeric|min:0',
            'earned_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $commission_amount = ($request->base_amount * $request->commission_rate) / 100;

        AgentCommission::create(array_merge($request->all(), [
            'commission_amount' => $commission_amount,
            'status' => 'pending'
        ]));

        return response()->json(['status' => 'success', 'message' => 'Commission created']);
    }

    public function update(Request $request)
    {
        $commission = AgentCommission::findOrFail($request->id);
        $commission->update($request->only(['status', 'notes', 'paid_date']));
        return response()->json(['status' => 'success', 'message' => 'Commission updated']);
    }

    public function markPaid(Request $request)
    {
        $commission = AgentCommission::findOrFail($request->id);
        $commission->update([
            'status' => 'paid',
            'paid_date' => now()
        ]);
        return response()->json(['status' => 'success', 'message' => 'Marked as paid']);
    }

    public function destroy($id)
    {
        AgentCommission::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}