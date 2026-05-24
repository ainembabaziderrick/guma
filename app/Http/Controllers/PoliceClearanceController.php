<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class PoliceClearanceController extends Controller
{
    public function index()
    {
        return view('police.index');
    }

    public function data()
    {
        // Show candidates that passed medical or are hired
        $candidates = Candidate::where('medical_status', 'passed')
            ->orderBy('id', 'desc');

        return datatables()
            ->of($candidates)
            ->addIndexColumn()
            ->addColumn('police_status', function($c){
                $labels = [
                    'not_submitted' => 'default',
                    'submitted' => 'warning',
                    'cleared' => 'success',
                    'flagged' => 'danger'
                ];
                $label = $labels[$c->police_status] ?? 'default';
                return '<span class="label label-'.$label.'">'.str_replace('_', ' ', $c->police_status).'</span>';
            })
            ->editColumn('police_date', fn($c) => $c->police_date ? \Carbon\Carbon::parse($c->police_date)->format('Y-m-d') : '-')
            ->addColumn('action', function ($c) {
                return '
                <div class="btn-group">
                    <button onclick="openPoliceModal('.$c->id.')" class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-edit"></i> Update
                    </button>
                    <button onclick="viewCandidate('.$c->id.')" class="btn btn-xs btn-default btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['police_status', 'action'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:candidates,id',
            'police_status' => 'required|in:not_submitted,submitted,cleared,flagged',
            'police_date' => 'nullable|date',
            'police_notes' => 'nullable|string'
        ]);

        Candidate::find($request->id)->update([
            'police_status' => $request->police_status,
            'police_date' => $request->police_date,
            'police_notes' => $request->police_notes
        ]);

        return response()->json(['status' => 'success', 'message' => 'Police clearance updated']);
    }
}