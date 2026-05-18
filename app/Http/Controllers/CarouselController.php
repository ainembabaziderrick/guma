<?php

namespace App\Http\Controllers;
use App\Models\CarouselModel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function Homecarousel(){
        $getRecord = CarouselModel::latest()->get();
        return view('carousel.list', compact('getRecord'));
    }

    public function Addcarousel(){
        return view('carousel.add');
    }

    public function Storecarousel(Request $request){

        $news_image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($news_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/carousel/';
        $last_img = $up_location.$img_name;
        $news_image -> move($up_location, $img_name);

        $save = new CarouselModel;
        $save->type = $request->type;
        $save->description = $request->description;
            
        
        $save->image = $last_img;
       
        $save->save();

       

        return redirect('admin/carousel')->with('success', 'carousel successfully created');
        
    }

    public function Editcarousel($id){
        $cases = CarouselModel::find($id);
       
        return view('carousel.edit', compact('cases'));
     
     }

     public function Updatecarousel(Request $request, $id){
    
        $update =   CarouselModel::find($id)->update([
               'type' => $request->type,
               'description' => $request->description,
               
              
               'image' => $request->image,
               
              
                      
           ]);
           return redirect('admin/carousel')->with('success','carousel Updated succcessfully');
        
        }


        public function Deletecarousel($id)
        {
            $delete = CarouselModel::findOrFail($id); // Ensures an exception is thrown if not found
            $delete->delete();
        
            return redirect()->back()->with('success', 'carousel deleted successfully');
        }
}
