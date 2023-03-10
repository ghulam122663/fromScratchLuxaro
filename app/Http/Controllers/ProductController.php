<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'from_charter_side' => 'required',
            'type' => 'required',
            'thumbnail_img' => 'required',
            'tags' => 'required',
            'charter_category_id' => 'required',
            'delivery_option_id' => 'required',
            'shipping_type' => 'required',
            'shipping_charge' => 'required',

        ]);

        $product = new Product;
        if ($request->hasFile('thumbnail_img')) {
            $path = asset('storage/' . $request->thumbnail_img->store('productImage'));
            $product->product_image = $path;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->from_charter_side = $request->from_charter_side;
        $product->type = $request->type;
        $product->tags = json_encode($request->tags);
        $product->charter_category_id = json_encode($request->charter_category_id);
        $product->delivery_option_id = json_encode($request->delivery_option_id);
        $product->shipping_type = json_encode($request->shipping_type);
        $product->shipping_charge = $request->shipping_charge;
        $product->save();
        return redirect()->back()->with('success', 'Product created successfully.');
    }
}
