<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class DeploymentController extends Controller
{
    public function index()
    {
        return view('deployment.index');
    }

    public function data()
    {
        // Show candidates with signed contract
        $candidates = Candidate::where('contract_status', 'signed')
            ->orderBy('departure_date', 'asc');

        return datatables()
            ->of($candidates)
            ->addIndexColumn()
            ->addColumn('deployment_status', function($c){
                $labels = [
                    'not_scheduled' => 'default',
                    'scheduled' => 'warning',
                    'departed' => 'info',
                    'arrived' => 'success',
                    'cancelled' => 'danger'
                ];
                $label = $labels[$c->deployment_status] ?? 'default';
                return '<span class="label label-'.$label.'">'.str_replace('_', ' ', $c->deployment_status).'</span>';
            })
            ->editColumn('departure_date', fn($c) => $c->departure_date ? \Carbon\Carbon::parse($c->departure_date)->format('Y-m-d') : '-')
            ->editColumn('arrival_date', fn($c) => $c->arrival_date ? \Carbon\Carbon::parse($c->arrival_date)->format('Y-m-d') : '-')
            ->addColumn('action', function ($c) {
                return '
                <div class="btn-group">
                    <button onclick="openDeploymentModal('.$c->id.')" class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-edit"></i> Update
                    </button>
                    <button onclick="viewCandidate('.$c->id.')" class="btn btn-xs btn-default btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['deployment_status', 'action'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:candidates,id',
            'deployment_status' => 'required|in:not_scheduled,scheduled,departed,arrived,cancelled',
            'departure_date' => 'nullable|date',
            'arrival_date' => 'nullable|date|after_or_equal:departure_date',
            'flight_number' => 'nullable|string|max:50',
            'destination' => 'nullable|string|max:255',
            'deployment_notes' => 'nullable|string'
        ]);

        Candidate::find($request->id)->update($request->only([
            'deployment_status', 'departure_date', 'arrival_date', 
            'flight_number', 'destination', 'deployment_notes'
        ]));

        return response()->json(['status' => 'success', 'message' => 'Deployment updated']);
    }
}