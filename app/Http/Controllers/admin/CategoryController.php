<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            $category=new Category;

            $category->name=$data['cat_name'];
            $category->parent_id=$data['parent_id'];
            $category->description=$data['description'];
            $category->url=$data['url'];
            $category->save();
            return redirect()->back()->with(['success'=>'Category Insert Successfully']);
        }
        $levels=Category::where(['parent_id'=>0])->get();
        return view('pages.admin.category.addcategory')->with(compact('levels'));
    }

    public function viewCategory()
    {
        $categories=Category::get();
        return view('pages.admin.category.viewcategory')->with(compact('categories'));
    }

    public function editCategory(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            $data=[
                'name'=>$request->cat_name,
                'parent_id'=>$request->parent_id,
                'description'=>$request->description,
                'url'=>$request->url
            ];
            $update=Category::where('id','=',$id)->update($data);
            if($update)
                return redirect()->back()->with(['success'=>'Category Updated sucessfully']);
            else
                return redirect()->back()->with(['dismiss'=>'Category not Updated ']);
        }
        $categories=Category::where('id','=',$id)->first();
        $levels=Category::where(['parent_id'=>0])->get();
        return view('pages.admin.category.editcategory')->with(compact('categories','levels'));
    }

    public function deleteCategory($id)
    {
        if(isset($id) && is_numeric($id)){
            $delete=Category::where(['id'=>$id])->delete();
            if($delete){
                return redirect()->back()->with(['success'=>'Category Deleted successfully']);
            }else{
                return redirect()->back()->with(['dismiss'=>'Category not Deleted']);
            }
        }
    }
}
