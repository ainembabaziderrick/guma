<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function index()
    {
        return view('candidates.index');
    }

    public function data()
{
    $candidates = Candidate::orderBy('id', 'desc');

    return datatables()
        ->of($candidates)
        ->addIndexColumn()
        ->addColumn('select_all', fn($candidates) => '<input type="checkbox" name="id[]" value="'.$candidates->id.'">')
        ->addColumn('status', function($candidates){
            $labels = [
                'pending' => 'warning',
                'shortlisted' => 'info',
                'hired' => 'success',
                'rejected' => 'danger'
            ];
            $label = $labels[$candidates->status]?? 'default';
            return '<span class="label label-'.$label.'">'.$candidates->status.'</span>';
        })
        ->editColumn('date_applied', function($candidates){
                return $candidates->date_applied ? \Carbon\Carbon::parse($candidates->date_applied)->format('Y-m-d') : '';
            })
        ->addColumn('aksi', function ($candidates) {
            return '
            <div class="btn-group">
                <button type="button" onclick="editForm(`'. route('candidates.update', $candidates->id).'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                <button type="button" onclick="deleteData(`'. route('candidates.destroy', $candidates->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['select_all', 'status', 'aksi'])
        ->make(true);
}

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:candidates,email',
        ]);

        Candidate::create($request->all());
        return response()->json('Candidate saved successfully', 200);
    }

    public function show($id)
    {
        $candidate = Candidate::find($id);

        return response()->json($candidate); 
    }

    public function edit($id)
    {
        return response()->json(Candidate::find($id));
    }

    public function update(Request $request, $id)
    {
        Candidate::find($id)->update($request->all());
        return response()->json('Candidate updated successfully', 200);
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return response()->json('Candidate deleted', 200);
    }

    public function deleteSelected(Request $request)
    {
        Candidate::whereIn('id', $request->id)->delete();
        return response()->json(['status' => 'success']);
    }
}
