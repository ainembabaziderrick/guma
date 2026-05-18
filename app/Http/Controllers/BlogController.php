<?php

namespace App\Http\Controllers;
use App\Models\BlogModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function Homeblog(){
        $getRecord = BlogModel::latest()->get();
        return view('blog.list', compact('getRecord'));
    }

    public function Addblog(){
        return view('blog.add');
    }

    public function Storeblog(Request $request){

        $news_image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($news_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/blog/';
        $last_img = $up_location.$img_name;
        $news_image -> move($up_location, $img_name);

        $save = new BlogModel;
        $save->blog = $request->blog;
        $save->date = $request->date;
        $save->blogger = $request->blogger;
        
        
        $save->image = $last_img;
       
        $save->save();

       

        return redirect('admin/blog')->with('success', 'blog successfully created');
        
    }

    public function Editblog($id){
        $cases = BlogModel::find($id);
       
        return view('blog.edit', compact('cases'));
     
     }

     public function Updateblog(Request $request, $id){
    
        $update =   BlogModel::find($id)->update([
               'blog' => $request->blog,
               'date' => $request->date,
               'blogger' => $request->blogger,
              
               'image' => $request->image,
               
              
                      
           ]);
           return redirect('admin/blog')->with('success','blog Updated succcessfully');
        
        }


        public function Deleteblog($id)
        {
            $delete = BlogModel::findOrFail($id); // Ensures an exception is thrown if not found
            $delete->delete();
        
            return redirect()->back()->with('success', 'blog deleted successfully');
        }
}
