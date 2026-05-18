<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageModel;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    public function messages_list(Request $request)
    {
        // Mark all unread messages as read
        MessageModel::where('is_read', false)->update(['is_read' => true]);
    
        // Fetch all messages
        $data['getRecord'] = MessageModel::all();
    
        // Get the count of unread messages
        $data['unreadCount'] = MessageModel::where('is_read', false)->count();
    
        // Return the view with the unread count data
        return view('messages.list', $data);
    }
    
public function messages_list_sub(Request $request)
    {
        // Mark all unread messages as read
        MessageModel::where('is_read', false)->update(['is_read' => true]);
    
        // Fetch all messages
        $data['getRecord'] = MessageModel::all();
    
        // Get the count of unread messages
        $data['unreadCount'] = MessageModel::where('is_read', false)->count();
    
        // Return the view with the unread count data
        return view('messages.list_sub', $data);
    }
    


    public function add_messages(Request $request){
        return view('messages.add');
    }

    public function insert_add_messages(Request $request){
        $save = new MessageModel;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->phone = trim($request->phone);
        $save->subject = trim($request->subject);
        $save->message = trim($request->message);       
        $save->save();

        return redirect()->back()->with('success', 'We have received your message, We shall respond soon');
        
    }

           public function Deletemessages($id){
            $delete = MessageModel::find($id)->Delete();
            return Redirect()->back()->with('success','Messages Deleted succcessfully');
         }

        
        // The method is defined in the controller
public function getUnreadCount()
{
    $unreadCount = MessageModel::where('is_read', false)->count();
    return response()->json(['unreadCount' => $unreadCount]);
}


public function getData()
{
    $query = MessageModel::query(); // <-- fix model name

    return DataTables::of($query)
        ->addIndexColumn()
        ->editColumn('created_at', function ($row) {
            return $row->created_at
                       ->timezone('Africa/Kampala')
                       ->format('d-m-Y H:i:s');
        })
        ->addColumn('action', function ($row) {
            return '<button class="btn btn-sm btn-danger"
                    onclick="deleteMessage(\''.route('messages.destroy', $row->id).'\')">
                    Delete</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
}
 public function destroy($id)
{
    $message = MessageModel::findOrFail($id);
    $message->delete();
    return response()->json(['success' => true]);
}


public function getData_sub()
{
    $query = MessageModel::query(); // <-- fix model name

    return DataTables::of($query)
        ->addIndexColumn()
        ->editColumn('created_at', function ($row) {
            return $row->created_at
                       ->timezone('Africa/Kampala')
                       ->format('d-m-Y H:i:s');
        })
        
        ->rawColumns(['action'])
        ->make(true);
}
         


}
