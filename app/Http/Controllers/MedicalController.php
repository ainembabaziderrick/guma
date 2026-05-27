<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Document;

class MedicalController extends Controller
{
    public function index()
    {
        return view('medical.index');
    }
   

public function data()
{
    $documents = Document::where('type', 'medical_exam')
        ->with('candidate:id,full_name') 
        ->select('documents.*')
        ->latest();

    return datatables()
        ->of($documents)
        ->addIndexColumn()
        ->addColumn('candidate_name', fn($d) => optional($d->candidate)->full_name ?? 'N/A')
        ->addColumn('title', fn($d) => $d->title)
        ->addColumn('type', fn($d) => 'Medical Exam')
        ->editColumn('created_at', fn($d) => $d->created_at->format('d M Y'))
        ->addColumn('action', function ($d) {
            $view = '<a href="'.asset('storage/'.$d->file_path).'" target="_blank" class="btn btn-xs btn-info">
                        <i class="fa fa-eye"></i> View
                     </a>';
            $download = '<a href="'.route('applicant.documents.download', $d->id).'" class="btn btn-xs btn-success">
                            <i class="fa fa-download"></i> Download
                         </a>';
            $update = '<button onclick="openMedicalModal('.$d->candidate_id.')" class="btn btn-xs btn-primary">
                          <i class="fa fa-edit"></i> Update Status
                       </button>';
            return $view.' '.$download.' '.$update;
        })
        ->rawColumns(['action'])
        ->toJson(); 
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