<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Input;
use Image;
use App\Products_attributes;
use App\Product_Image;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if (empty($data['cat_id'])) {
                return redirect()->back()->with(['error' => 'Category name is missing']);
            }
            $product = new Product;
            $product->category_id = $data['cat_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            if (!empty($data['description'])) {
                $product->description = $data['description'];
            } else {
                $product->product_name = ' ';
            }

            if (!empty($data['care'])) {
                $product->care = $data['care'];
            } else {
                $product->care = '';
            }
            $product->price = $data['price'];

            //upload image with size
            if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/product/large/' . $filename;
                    $medium_image_path = 'images/backend_images/product/medium/' . $filename;
                    $small_image_path = 'images/backend_images/product/small/' . $filename;


                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                    $product->image = $filename;
                }
            } else {
                $product->image = '';
            }
            if(empty($data['status'])){
                $product->status=0;
            }else{
                $product->status=2;
            }

            $product->save();
            return redirect()->back()->with(['success' => 'Product added Successfully']);
        }
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select Category...</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('pages.admin.product.addproduct')->with(compact('categories_dropdown'));
    }

    public function viewProduct()
    {
        $products = Product::get();
        foreach ($products as $key => $val) {
            $category_name = Category::where(['id' => $val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('pages.admin.product.viewproductlist')->with(compact('products'));
    }


    public function editProduct(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('image')) {

                $filepath = 'images/backend_images/product/small/';
                $products = Product::where(['id' => $id])->first();
                $fileName = $products->image;
                $old_image = $filepath . $fileName;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }

                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/product/large/' . $filename;
                    $medium_image_path = 'images/backend_images/product/medium/' . $filename;
                    $small_image_path = 'images/backend_images/product/small/' . $filename;


                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                }
            } else {
                $filename = $request->current_image;
            }

            if (empty($request->description)) {
                $request->description = '';
            }
            if (!empty($request->care)) {
                $care = $request->care;
            } else {
                $care = '';
            }

            if(!empty($request->status))
            {
                $status=2;
            }else{
                $status=0;
            }
            $data = [
                'category_id' => $request->cat_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_color' => $request->product_color,
                'price' => $request->price,
                'description' => $request->description,
                'care' => $care,
                'image' => $filename,
                'status'=>$status
            ];
            $update = Product::where('id', '=', $id)->update($data);
            if ($update)
                return redirect()->back()->with(['success' => 'Product Updated sucessfully']);
            else
                return redirect()->back()->with(['dismiss' => 'Product not Updated ']);
        }
        $product_details = Product::where('id', '=', $id)->first();

        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select Category...</option>";
        foreach ($categories as $cat) {
            if ($cat->id == $product_details->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "'" . $selected . ">" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if ($sub_cat->id == $product_details->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'" . $selected . ">&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('pages.admin.product.editproduct')->with(compact('product_details', 'categories_dropdown'));
    }

    //delere image from the database and folder
    public function deleteimage($id)
    {
        if (!empty($id) && is_numeric($id)) {
            $smallfilepath = 'images/backend_images/product/small/';
            $mediumfilepath = 'images/backend_images/product/mediem/';
            $largefilepath = 'images/backend_images/product/large/';
            $products = Product::where(['id' => $id])->first();
            $deleteimage = Product::where(['id' => $id])->update(['image' => '']);
            $fileName = $products->image;
            $old_image = $smallfilepath . $fileName;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $old_image1 = $mediumfilepath . $fileName;
            if (file_exists($old_image1)) {
                @unlink($old_image1);
            }
            $old_image2 = $largefilepath . $fileName;
            if (file_exists($old_image2)) {
                @unlink($old_image2);
            }
            if ($deleteimage) {
                return redirect()->back()->with(['success' => 'ProductImage Deleted Successfully']);
            } else {
                return redirect()->back()->with(['dismiss' => 'ProductImage not Deleted ']);
            }
        }
    }

    public function deleteProduct($id)
    {
        if (isset($id) && is_numeric($id)) {
            $filepath = 'images/backend_images/product/small/';
            $products = Product::where(['id' => $id])->first();
            $fileName = $products->image;
            $old_image = $filepath . $fileName;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $deleteProduct = Product::where(['id' => $id])->delete();
            if ($deleteProduct) {
                return redirect()->back()->with(['success' => 'Product Deleted Successfully']);
            } else {
                return redirect()->back()->with(['dismiss' => 'Product not Deleted']);
            }
        }
    }


    public function addProductAttribute(Request $request, $id = null)
    {
        $products_details = Product::with('attribute')->where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {
                    //check duplicate SKU
                    $countattribute = Products_attributes::where(['sku' => $val])->count();
                    if ($countattribute > 0) {
                        return redirect()->back()->with(['error' => 'This SKU is already exist!! plese insert the another SKU']);
                    }
                    $countsize = Products_attributes::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($countsize > 0) {
                        return redirect()->back()->with(['error' => $data['size'][$key] . ' size already exist for this product!!please insert another size']);
                    } else {
                        $attribute = new Products_attributes;
                        $attribute->product_id = $id;
                        $attribute->sku = $val;
                        $attribute->size = $data['size'][$key];
                        $attribute->price = $data['price'][$key];
                        $attribute->stock = $data['stock'][$key];

                        $attribute->save();
                    }

                }
            }
            return redirect()->back()->with(['success' => 'Attribute Inserted Successfully!']);

        }
        return view('pages.admin.product.product_attribute')->with(compact('products_details'));
    }


    public function updateAttributes(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['id'] as $key => $val) {
                $updateattribute = Products_attributes::where(['id' => $data['id'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
            }
            if ($updateattribute)
                return redirect()->back()->with(['success' => 'Product Attribute updated successfully']);
        }
    }

    public function addProductImage(Request $request, $id = null)
    {
        $products_details = Product::with('attribute')->where(['id' => $id])->first();
        $products_images = Product::with('images')->where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    $image = new Product_Image;
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $largeimage_path = 'images/backend_images/product/large/' . $filename;
                    $smallimage_path = 'images/backend_images/product/small/' . $filename;
                    $mediumimage_path = 'images/backend_images/product/medium/' . $filename;
                    Image::make($file)->save($largeimage_path);
                    Image::make($file)->resize(600, 600)->save($mediumimage_path);
                    Image::make($file)->resize(300, 300)->save($smallimage_path);
                    $image->product_id = $data['product_id'];
                    $image->image = $filename;
                    $image->save();
                }
                return redirect()->back()->with(['success' => 'Image Inserted Successfully']);
            }

        }
        return view('pages.admin.product.addproductimage')->with(compact('products_details', 'products_images'));
    }

    public function deleteproductattribute($id)
    {
        if (isset($id) && is_numeric($id)) {

            $smallfilepath = 'images/backend_images/product/small/';
            $mediumfilepath = 'images/backend_images/product/mediem/';
            $largefilepath = 'images/backend_images/product/large/';
            $products = Products_attributes::where(['id' => $id])->first();
            $fileName = $products->image;
            $old_image = $smallfilepath . $fileName;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $old_image1 = $mediumfilepath . $fileName;
            if (file_exists($old_image1)) {
                @unlink($old_image1);
            }
            $old_image2 = $largefilepath . $fileName;
            if (file_exists($old_image2)) {
                @unlink($old_image2);
            }


            $deleteProductattribute = Products_attributes::where(['id' => $id])->delete();
            if ($deleteProductattribute) {
                return redirect()->back()->with(['success' => 'Product Attribute Deleted Successfully']);
            } else {
                return redirect()->back()->with(['dismiss' => 'Product Attribute not Deleted']);
            }
        }
    }


    public function deleteproductimage($id)
    {
        if (isset($id) && is_numeric($id)) {

            $smallfilepath = 'images/backend_images/product/small/';
            $mediumfilepath = 'images/backend_images/product/mediem/';
            $largefilepath = 'images/backend_images/product/large/';
            $products = Product_Image::where(['id' => $id])->first();
            $fileName = $products->image;
            $old_image = $smallfilepath . $fileName;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $old_image1 = $mediumfilepath . $fileName;
            if (file_exists($old_image1)) {
                @unlink($old_image1);
            }
            $old_image2 = $largefilepath . $fileName;
            if (file_exists($old_image2)) {
                @unlink($old_image2);
            }


            $deleteProductimage = Product_Image::where(['id' => $id])->delete();
            if ($deleteProductimage) {
                return redirect()->back()->with(['success' => 'Product Image Deleted Successfully']);
            } else {
                return redirect()->back()->with(['dismiss' => 'Product Image not Deleted']);
            }
        }
    }

}
