<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffModel;


class StaffController extends Controller
{
    public function staff(){
        $data['getRecord'] = StaffModel::get();
        return view('staff.list', $data);
    }

    public function add_staff(Request $request){
        return view('staff.add');
    }

    public function insert_add_staff(Request $request){
        $save = new StaffModel;
        $save->name = trim($request->name);
        $save->number = trim($request->number);
        $save->email = trim($request->email);
        $save->address = trim($request->address);
        $save->nin = trim($request->nin);
        $save->nok = trim($request->nok);
        $save->nok_contact = trim($request->nok_contact);
        $save->nok_nin = trim($request->nok_nin);
        
        $save->save();

        return redirect('/staff')->with('success', 'Staff successfully created');
        
    }

    public function Deletestaff($id){
        $delete = StaffModel::find($id)->Delete();
        return Redirect()->back()->with('success','Staff deleted succcessfully');
     }
}
