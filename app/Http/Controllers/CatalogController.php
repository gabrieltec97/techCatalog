<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('catalog.catalog', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('catalog.new-item');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'          => 'required|string|max:255',
            'device'         => 'required|string|max:100',
            'manufacturer'   => 'required|string|max:100',
            'model'          => 'required|string|max:100',
            'storage'        => 'nullable|string|max:50',
            'ram'            => 'nullable|string|max:50',
            'condition'      => 'required|string|max:100',
            'grade'          => 'nullable|string|max:255',
            'battery'        => 'nullable|integer|min:0|max:100',
            'color'          => 'nullable|string|max:100',
            'repairs'        => 'nullable|string|max:255',
            'accessories'    => 'nullable|string|max:255',
            'imei'           => 'nullable|string|max:50',
            'guarantee'      => 'nullable|string|max:100',
            'account_status' => 'required|string|max:100',
            'cost_price'     => 'nullable|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'quantity'       => 'required|integer|min:1',
            'description'    => 'nullable|string',
            'images.*'       => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Salvando a imagem na pasta 'storage/app/public/products'.
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        $validatedData['images'] = $imagePaths;
        Product::create($validatedData);

        return redirect()->route('catalogo.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
