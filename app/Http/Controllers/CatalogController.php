<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $manufacturers = Manufacturer::orderBy('name')->get();
        return view('catalog.new-product', compact('manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'             => 'required|string|max:255',
            'device'            => 'required|string|max:100',
            'manufacturer_id'   => 'required|exists:manufacturers,id',
            'device_model_id'   => 'required|exists:device_models,id', // se no HTML o select se chamar "working_product_id", altere aqui
            'storage'           => 'nullable|string|max:50',
            'ram'               => 'nullable|string|max:50',
            'condition'         => 'required|string|max:100',
            'grade'             => 'nullable|string|max:255',
            'battery'           => 'nullable|integer|min:0|max:100',
            'color'             => 'nullable|string|max:100',
            'repairs'           => 'nullable|string|max:255',
            'accessories'       => 'nullable|string|max:255',
            'imei'              => 'nullable|string|max:50',
            'guarantee'         => 'nullable|string|max:100',
            'account_status'    => 'nullable|string|max:100',
            'cost_price'        => 'nullable|numeric|min:0',
            'selling_price'     => 'required|numeric|min:0',
            'quantity'          => 'required|integer|min:1',
            'description'       => 'nullable|string',
            'images.*'          => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Trata os campos opcionais ocultados pelo JS
        $textFields = ['storage', 'ram', 'grade', 'repairs', 'account_status'];

        foreach ($textFields as $field) {
            if (empty($validatedData[$field] ?? null)) {
                $validatedData[$field] = 'N/A';
            }
        }

        if (!isset($validatedData['battery']) || $validatedData['battery'] === '') {
            $validatedData['battery'] = null;
        }

        // Upload de imagens
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        $validatedData['images'] = $imagePaths;

        // Cria o produto com a nova estrutura relacional
        Product::create($validatedData);

        return redirect()->route('catalogo.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('catalog.product', compact('product'));
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
        $product = Product::findOrFail($id);
        if (!empty($product->images) && is_array($product->images)) {
            Storage::disk('public')->delete($product->images);
        }

        $product->delete();
        return redirect()->route('catalogo.index')->with('deleted', 'Produto deletado com sucesso!');
    }
}
