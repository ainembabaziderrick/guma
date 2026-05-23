<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller
{
    public function index()
    {
        return view('agents.index');
    }

    public function data()
    {
        $agents = Agent::orderBy('id', 'desc');

        return datatables()
            ->of($agents)
            ->addIndexColumn()
            ->addColumn('select_all', function($agents){
                return '<input type="checkbox" name="id[]" value="'.$agents->id.'">';
            })
            ->addColumn('status', function($agents){
                $label = $agents->status == 'active' ? 'success' : 'default';
                return '<span class="label label-'.$label.'">'.$agents->status.'</span>';
            })
            ->addColumn('aksi', function ($agents) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('agents.update', $agents->id) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('agents.destroy', $agents->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['select_all', 'status', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'agent_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:agents,email',
        ]);

        Agent::create($request->all());
        return response()->json('Agent saved successfully', 200);
    }

    public function show($id)
    {
        $agent = Agent::find($id);

        return response()->json($agent); 
    }

    public function edit($id)
    {
        return response()->json(Agent::find($id));
    }

    public function update(Request $request, $id)
    {
        Agent::find($id)->update($request->all());
        return response()->json('Agent updated successfully', 200);
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        return response()->json('Agent deleted', 200);
    }

    public function deleteSelected(Request $request)
    {
        Agent::whereIn('id', $request->id)->delete();
        return response()->json(['status' => 'success']);
    }
}
