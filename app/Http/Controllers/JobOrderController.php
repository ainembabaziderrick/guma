<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Employer;
use App\Models\JobOrder;

class JobOrderController extends Controller
{
    public function index()
    {
        $employers = Employer::all();
        $agents = Agent::all();
        return view('job_orders.index', compact('employers', 'agents'));
    }

    public function data()
    {
        $jobOrders = JobOrder::with(['employer', 'agent'])->orderBy('id', 'desc');

        return datatables()
            ->of($jobOrders)
            ->addIndexColumn()
            ->addColumn('select_all', fn($jobOrders) => '<input type="checkbox" name="id[]" value="'.$jobOrders->id.'">')
            ->addColumn('employer_name', fn($jobOrders) => $jobOrders->employer->company_name ?? '-')
            ->addColumn('agent_name', fn($jobOrders) => $jobOrders->agent->agent_name ?? '-')
            ->addColumn('status', function($jobOrders){
                $labels = ['open' => 'success', 'closed' => 'danger', 'on_hold' => 'warning'];
                $label = $labels[$jobOrders->status] ?? 'default';
                return '<span class="label label-'.$label.'">'.$jobOrders->status.'</span>';
            })
            ->addColumn('aksi', function ($jobOrders) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('job-orders.update', $jobOrders->id) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('job-orders.destroy', $jobOrders->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['select_all', 'status', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|unique:job_orders,order_number',
            'employer_id' => 'required|exists:employers,id',
            'job_title' => 'required|string|max:255',
            'vacancies' => 'required|integer|min:1'
        ]);

        JobOrder::create($request->all());
        return response()->json('Job Order saved successfully', 200);
    }

    public function edit($id)
    {
        return response()->json(JobOrder::with(['employer', 'agent'])->find($id));
    }

    public function show($id)
    {
        $JobOrder = JobOrder::find($id);

        return response()->json($JobOrder); 
    }


    public function update(Request $request, $id)
    {
        JobOrder::find($id)->update($request->all());
        return response()->json('Job Order updated successfully', 200);
    }

    public function destroy(JobOrder $jobOrder)
    {
        $jobOrder->delete();
        return response()->json('Job Order deleted', 200);
    }

    public function deleteSelected(Request $request)
    {
        JobOrder::whereIn('id', $request->id)->delete();
        return response()->json(['status' => 'success']);
    }
}
