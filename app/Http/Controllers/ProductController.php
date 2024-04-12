<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = makeMessages();
        //Validar datos
        $request->validate([
            'name' => ['required'],
            'stock' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ], $messages);

        //Crea el usuario
        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        //Redirecciona el usuario
        return redirect()->route('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $product = Product::find($id);

        return view('product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = makeMessages();
        //Validar datos
        $request->validate([
            'name' => ['required'],
            'stock' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ], $messages);

        $product = Product::find($id);

        $product->update($request->all());

        //Redirecciona el usuario
        return redirect()->route('products')->with('success', 'Se actualizaron los campos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('products')->with('success', 'El producto se eliminó con exito');
    }
}
