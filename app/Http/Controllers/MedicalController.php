<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class MedicalController extends Controller
{
    public function index()
    {
        return view('medical.index');
    }

    public function data()
    {
        // Show only candidates that are shortlisted or further
        $candidates = Candidate::whereIn('status', ['shortlisted', 'hired'])
            ->orderBy('id', 'desc');

        return datatables()
            ->of($candidates)
            ->addIndexColumn()
            ->addColumn('select_all', fn($c) => '<input type="checkbox" name="id[]" value="'.$c->id.'">')
            ->addColumn('medical_status', function($c){
                $labels = [
                    'not_scheduled' => 'default',
                    'scheduled' => 'warning',
                    'passed' => 'success',
                    'failed' => 'danger'
                ];
                $label = $labels[$c->medical_status] ?? 'default';
                return '<span class="label label-'.$label.'">'.str_replace('_', ' ', $c->medical_status).'</span>';
            })
            ->editColumn('medical_date', fn($c) => $c->medical_date ? \Carbon\Carbon::parse($c->medical_date)->format('Y-m-d') : '-')
            ->addColumn('action', function ($c) {
                return '
                <div class="btn-group">
                    <button onclick="openMedicalModal('.$c->id.')" class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-edit"></i> Update
                    </button>
                    <button onclick="viewCandidate('.$c->id.')" class="btn btn-xs btn-default btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['select_all', 'medical_status', 'action'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:candidates,id',
            'medical_status' => 'required|in:not_scheduled,scheduled,passed,failed',
            'medical_date' => 'nullable|date',
            'medical_notes' => 'nullable|string'
        ]);

        Candidate::find($request->id)->update([
            'medical_status' => $request->medical_status,
            'medical_date' => $request->medical_date,
            'medical_notes' => $request->medical_notes
        ]);

        return response()->json(['status' => 'success', 'message' => 'Medical record updated']);
    }
}