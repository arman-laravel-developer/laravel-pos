<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.products.create');
    }

    public function getImageUrl($request)
    {
        $slug = Str::slug($request->name);
        $image = $request->file('image');
        $imageName = $slug.'-.'.uniqid().'.'.$image->getClientOriginalExtension();
        $directory = 'product-images/';
        $image->move($directory,$imageName);
        $imageUrl = $directory.$imageName;
        return $imageUrl;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'unit' => 'required',
            'unit_value' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->unit = $request->unit;
        $product->unit_value = $request->unit_value;
        $product->selling_price = $request->selling_price;
        $product->purchase_price = $request->purchase_price;
        $product->discount = $request->discount ?? 0;
        $product->tax = $request->tax ?? 0;
        if ($request->file('image'))
        {
            $product->image = $this->getImageUrl($request);
        }

        $product->save();

        Alert::success('Product created successfully!');
        return redirect()->route('product.create');
    }
}
