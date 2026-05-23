<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class ScreeningController extends Controller
{
    public function index()
    {
        return view('screening.index');
    }

    public function data()
    {
        // Show only candidates that are pending or shortlisted
        $candidates = Candidate::whereIn('status', ['pending', 'shortlisted'])
            ->orderBy('id', 'desc');

        return datatables()
            ->of($candidates)
            ->addIndexColumn()
            ->addColumn('select_all', fn($c) => '<input type="checkbox" name="id[]" value="'.$c->id.'">')
            ->addColumn('status', function($c){
                $labels = [
                    'pending' => 'warning',
                    'shortlisted' => 'info',
                ];
                $label = $labels[$c->status] ?? 'default';
                return '<span class="label label-'.$label.'">'.$c->status.'</span>';
            })
            ->editColumn('date_applied', fn($c) => $c->date_applied ? \Carbon\Carbon::parse($c->date_applied)->format('Y-m-d') : '')
            ->addColumn('action', function ($c) {
                $btns = '';
                
                if($c->status == 'pending') {
                    $btns .= '<button onclick="updateStatus('.$c->id.', \'shortlisted\')" class="btn btn-xs btn-info btn-flat" title="Shortlist">
                                <i class="fa fa-thumbs-up"></i> Shortlist
                              </button> ';
                }
                
                if($c->status == 'shortlisted') {
                    $btns .= '<button onclick="updateStatus('.$c->id.', \'pending\')" class="btn btn-xs btn-warning btn-flat" title="Move to Pending">
                                <i class="fa fa-undo"></i> Unshortlist
                              </button> ';
                    $btns .= '<button onclick="updateStatus('.$c->id.', \'hired\')" class="btn btn-xs btn-success btn-flat" title="Hire">
                                <i class="fa fa-check"></i> Hire
                              </button> ';
                    $btns .= '<button onclick="updateStatus('.$c->id.', \'rejected\')" class="btn btn-xs btn-danger btn-flat" title="Reject">
                                <i class="fa fa-times"></i> Reject
                              </button> ';
                }

                $btns .= '<button onclick="viewCandidate('.$c->id.')" class="btn btn-xs btn-default btn-flat" title="View">
                            <i class="fa fa-eye"></i>
                          </button>';

                return $btns;
            })
            ->rawColumns(['select_all', 'status', 'action'])
            ->make(true);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:candidates,id',
            'status' => 'required|in:pending,shortlisted,hired,rejected'
        ]);

        $candidate = Candidate::find($request->id);
        $candidate->update(['status' => $request->status]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status updated to '.$request->status
        ]);
    }
}