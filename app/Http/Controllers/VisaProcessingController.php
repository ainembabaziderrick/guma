<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Document;

class VisaProcessingController extends Controller
{
    public function index()
    {
        return view('visa.index');
    }

    public function data()
    {
        $documents = Document::where('type', 'visa')
            ->with('candidate:id,full_name') 
            ->select('documents.*')
            ->latest();

        return datatables()
            ->of($documents)
            ->addIndexColumn()
            ->addColumn('candidate_name', fn($d) => optional($d->candidate)->full_name ?? 'N/A')
            ->addColumn('title', fn($d) => $d->title)
            ->addColumn('type', fn($d) => 'Visa')
            ->editColumn('created_at', fn($d) => $d->created_at->format('d M Y'))
            ->addColumn('action', function ($d) {
                $view = '<a href="'.asset('storage/'.$d->file_path).'" target="_blank" class="btn btn-xs btn-info">
                            <i class="fa fa-eye"></i> View
                         </a>';
                $download = '<a href="'.route('applicant.documents.download', $d->id).'" class="btn btn-xs btn-success">
                                <i class="fa fa-download"></i> Download
                             </a>';
                $update = '<button onclick="openVisaModal('.$d->candidate_id.')" class="btn btn-xs btn-primary">
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