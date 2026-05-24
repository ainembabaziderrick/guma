<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class PostDeploymentController extends Controller
{
    public function index()
    {
        return view('postdeployment.index');
    }

    public function data()
    {
        // Show candidates who have arrived
        $candidates = Candidate::where('deployment_status', 'arrived')
            ->orderBy('arrival_date', 'desc');

        return datatables()
            ->of($candidates)
            ->addIndexColumn()
            ->addColumn('post_deployment_status', function($c){
                $labels = [
                    'not_started' => 'default',
                    'in_probation' => 'warning',
                    'confirmed' => 'success',
                    'terminated' => 'danger'
                ];
                $label = $labels[$c->post_deployment_status] ?? 'default';
                return '<span class="label label-'.$label.'">'.str_replace('_', ' ', $c->post_deployment_status).'</span>';
            })
            ->editColumn('probation_end_date', fn($c) => $c->probation_end_date ? \Carbon\Carbon::parse($c->probation_end_date)->format('Y-m-d') : '-')
            ->editColumn('last_followup_date', fn($c) => $c->last_followup_date ? \Carbon\Carbon::parse($c->last_followup_date)->format('Y-m-d') : '-')
            ->addColumn('action', function ($c) {
                return '
                <div class="btn-group">
                    <button onclick="openPostDeploymentModal('.$c->id.')" class="btn btn-xs btn-primary btn-flat">
                        <i class="fa fa-edit"></i> Update
                    </button>
                    <button onclick="viewCandidate('.$c->id.')" class="btn btn-xs btn-default btn-flat">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['post_deployment_status', 'action'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:candidates,id',
            'post_deployment_status' => 'required|in:not_started,in_probation,confirmed,terminated',
            'probation_end_date' => 'nullable|date',
            'last_followup_date' => 'nullable|date',
            'post_deployment_notes' => 'nullable|string'
        ]);

        Candidate::find($request->id)->update($request->only([
            'post_deployment_status', 'probation_end_date', 'last_followup_date', 'post_deployment_notes'
        ]));

        return response()->json(['status' => 'success', 'message' => 'Post deployment updated']);
    }
}