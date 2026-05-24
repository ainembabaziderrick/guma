<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class VisaProcessingController extends Controller
{
    public function index()
    {
        return view('visa.index');
    }

    public function data()
    {
        // Show candidates cleared by police
        $candidates = Candidate::where('police_status', 'cleared')
            ->orderBy('id', 'desc');

        return datatables()
            ->of($candidates)
            ->addIndexColumn()
            ->addColumn('visa_status', function($c){
                $labels = [
                    'not_started' => 'default',
                    'submitted' => 'warning',
                    'approved' => 'info',
                    'rejected' => 'danger',
                    'issued' => 'success'
                ];
                $label = $labels[$c->visa_status] ?? 'default';
                return '<span class="label label-'.$label.'">'.str_replace('_', ' ', $c->visa_status).'</span>';
            })
            ->editColumn('visa_date', fn($c) => $c->visa_date ? \Carbon\Carbon::parse($c->visa_date)->format('Y-m-d') : '-')
            ->addColumn('action', function ($c) {
                return '
                <div class="btn-group">
                    <button onclick="openVisaModal('.$c->id.')" class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-edit"></i> Update
                    </button>
                    <button onclick="viewCandidate('.$c->id.')" class="btn btn-xs btn-default btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['visa_status', 'action'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:candidates,id',
            'visa_status' => 'required|in:not_started,submitted,approved,rejected,issued',
            'visa_date' => 'nullable|date',
            'visa_notes' => 'nullable|string'
        ]);

        Candidate::find($request->id)->update([
            'visa_status' => $request->visa_status,
            'visa_date' => $request->visa_date,
            'visa_notes' => $request->visa_notes
        ]);

        return response()->json(['status' => 'success', 'message' => 'Visa status updated']);
    }
}