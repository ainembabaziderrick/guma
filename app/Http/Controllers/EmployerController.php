<?php
namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{    

        public function index()
    {
        return view('employers.index');
    }   

public function data()
{
    $employers = Employer::orderBy('id', 'desc');

    return datatables()
        ->of($employers)
        ->addIndexColumn()
        ->addColumn('select_all', function($employers){
            return '<input type="checkbox" name="id[]" value="'.$employers->id.'">';
        })
        ->addColumn('status', function($employers){
            $label = $employers->status == 'active' ? 'success' : 'default';
            return '<span class="label label-'.$label.'">'.$employers->status.'</span>';
        })
        ->addColumn('aksi', function ($employers) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('employers.update', $employers->id) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('employers.destroy', $employers->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
        })
        ->rawColumns(['select_all', 'status', 'aksi'])
        ->make(true);
}

public function deleteSelected(Request $request)
{
    Employer::whereIn('id', $request->id)->delete();
    return response()->json(['status' => 'success']);
}

    public function create()
    {
        return view('employers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:employers,email',
            'phone' => 'nullable|string|max:20',
        ]);

        Employer::create($request->all());

        return redirect()->route('employers.index')->with('success', 'Employer created successfully');
    }

     public function show($id)
    {
        $employer = Employer::find($id);

        return response()->json($employer); 
    }

        public function edit($id)
{
    $employer = Employer::find($id);
    return response()->json($employer);
}

   

    public function update(Request $request, $id)
    {
        $employer = Employer::find($id);        

        $employer->update($request->all());

        return response()->json('Data saved successfully', 200);
    }

    public function destroy(Employer $employer)
    {
        $employer->delete();
        return back()->with('success', 'Employer deleted');
    }
}