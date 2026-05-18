<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('user.user');
    }

    public function data()
    {
        $users = User::orderBy('id', 'desc')->get();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function($user){
                return '
                <button onclick="editForm(`'. route('user.update', $user->id) .'`)" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button>
                <button onclick="deleteData(`'. route('user.destroy', $user->id) .'`)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = $this->getLevel($request);
        $user->foto = '/img/user.png';
        $user->save();

        return response()->json('User saved successfully', 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users,email,'.$id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->filled('password')){
            $request->validate(['password'=>'required|min:6|confirmed']);
            $user->password = bcrypt($request->password);
        }

        $user->level = $this->getLevel($request);
        $user->update();

        return response()->json('User updated successfully', 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('User deleted successfully', 200);
    }

    private function getLevel($request)
    {
        if($request->has('is_online_customer')) return 6;
        if($request->has('is_sub_admin')) return 5;
        if($request->has('is_cashier')) return 2;
        if($request->has('is_supplier')) return 4;
        if($request->has('is_customer')) return 3;
        return 1;
    }

     public function profil()
    {
        $profil = auth()->user();
        return view('user.profil', compact('profil'));
    }
    
    
    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        
        $user->name = $request->name;
        if ($request->has('password') && $request->password != "") {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = bcrypt($request->password);
                } else {
                    return redirect()->back()->with('error', 'Confirm password is incorrect');
                }
            } else {
                return redirect()->back()->with('error', 'The old password is incorrect');
            }
        }
    
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
    
            $user->foto = "/img/$nama";
        }
    
        $user->update();
    
        // Return the profil_update view with success message
        return view('user.profil_update', ['profil' => $user])->with('success', 'Profile updated successfully');
    }
    
}
