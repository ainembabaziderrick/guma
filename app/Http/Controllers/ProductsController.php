<?php

namespace App\Http\Controllers;
use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function Homeproducts(){
        $getRecord = ProductsModel::latest()->get();
        return view('products.list', compact('getRecord'));
    }

    public function Addproducts(){
        return view('products.add');
    }

    public function Storeproducts(Request $request){
        $news_image = $request->file('image');
    
        // Generate unique name
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($news_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
    
        // Upload location inside public
        $up_location = public_path('image/products/');
        
        // Ensure directory exists
        if (!file_exists($up_location)) {
            mkdir($up_location, 0777, true);
        }
    
        // Move file to public/image/products/
        $news_image->move($up_location, $img_name);
    
        // Save relative path for browser access
        $last_img = 'image/products/'.$img_name;
    
        // Save product
        $save = new ProductsModel;
        $save->type = $request->type;
        $save->price = $request->price;
        $save->image = $last_img;
        $save->save();
    
        return redirect('admin/products')->with('success', 'Product successfully created');
    }
    

    public function Editproducts($id){
        $cases = ProductsModel::find($id);
       
        return view('products.edit', compact('cases'));
     
     }

     public function Updateproducts(Request $request, $id){
    
        $update =   ProductsModel::find($id)->update([
               'type' => $request->type,
               'price' => $request->price,
                            
               'image' => $request->image,
               
              
                      
           ]);
           return redirect('admin/products')->with('success','Products Updated succcessfully');
        
        }


        public function Deleteproducts($id)
        {
            $delete = ProductsModel::findOrFail($id); // Ensures an exception is thrown if not found
            $delete->delete();
        
            return redirect()->back()->with('success', 'Product deleted successfully');
        }
        
}
