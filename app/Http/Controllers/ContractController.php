<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function index()
    {
        return view('contract.index');
    }

    public function data()
    {
        // Show candidates with issued visa
        $candidates = Candidate::where('visa_status', 'issued')
            ->orderBy('id', 'desc');

        return datatables()
            ->of($candidates)
            ->addIndexColumn()
            ->addColumn('contract_status', function($c){
                $labels = [
                    'not_generated' => 'default',
                    'sent' => 'warning',
                    'signed' => 'success',
                    'rejected' => 'danger'
                ];
                $label = $labels[$c->contract_status] ?? 'default';
                return '<span class="label label-'.$label.'">'.str_replace('_', ' ', $c->contract_status).'</span>';
            })
            ->editColumn('contract_date', fn($c) => $c->contract_date ? \Carbon\Carbon::parse($c->contract_date)->format('Y-m-d') : '-')
            ->addColumn('contract_file', function($c){
                return $c->contract_file 
                    ? '<a href="'.route('contract.download', $c->id).'" class="btn btn-xs btn-info"><i class="fa fa-download"></i> Download</a>'
                    : '-';
            })
            ->addColumn('action', function ($c) {
                return '
                <div class="btn-group">
                    <button onclick="openContractModal('.$c->id.')" class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-edit"></i> Update
                    </button>
                    <button onclick="viewCandidate('.$c->id.')" class="btn btn-xs btn-default btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['contract_status', 'contract_file', 'action'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:candidates,id',
            'contract_status' => 'required|in:not_generated,sent,signed,rejected',
            'contract_date' => 'nullable|date',
            'contract_notes' => 'nullable|string',
            'contract_file' => 'nullable|file|mimes:pdf,docx|max:5120'
        ]);

        $candidate = Candidate::find($request->id);
        $data = $request->only(['contract_status', 'contract_date', 'contract_notes']);

        if ($request->hasFile('contract_file')) {
            if ($candidate->contract_file) {
                Storage::disk('public')->delete($candidate->contract_file);
            }
            $path = $request->file('contract_file')->store('contracts', 'public');
            $data['contract_file'] = $path;
        }

        $candidate->update($data);

        return response()->json(['status' => 'success', 'message' => 'Contract updated']);
    }

    public function download($id)
    {
        $candidate = Candidate::findOrFail($id);
        if (!$candidate->contract_file) {
            abort(404);
        }
        return Storage::disk('public')->download($candidate->contract_file);
    }
}