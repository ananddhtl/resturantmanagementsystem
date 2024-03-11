<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
        $validated_data = $request->validated();
        if (isset($validated_data['image'])) {
            $file = File::query()->where('file_name', '=', $validated_data['image'])->first();
            $validated_data['image_id'] = $file->id;
            unset($validated_data['image']);
        }
        $validated_data['category_id'] = $validated_data['category'];
        Product::query()->create($validated_data);
        return redirect()->route('admin.products.index')->with('notification', 'Product has been added successfully!');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $product = Product::query()->findOrFail($id);
        $categories = ProductCategory::all();
        return view('admin.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(ProductRequest $request, string $id)
    {
        $product = Product::query()->findOrFail($id);
        $validated_data = $request->validated();
        if (isset($validated_data['image'])) {
            $file = File::query()->where('file_name', '=', $validated_data['image'])->first();
            $validated_data['image_id'] = $file->id;
            unset($validated_data['image']);
        }
        $validated_data['category_id'] = $validated_data['category'];
        $product->update($validated_data);
        return redirect()->route('admin.products.index')->with('notification', 'Product has been updated successfully!');
    }

    public function destroy(string $id)
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('notification', 'Product has been deleted successfully!');
    }
}
