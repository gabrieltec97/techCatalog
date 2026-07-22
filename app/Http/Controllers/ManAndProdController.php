<?php

namespace App\Http\Controllers;

use App\Models\DeviceModel;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManAndProdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('catalog.manufacturerAndProducts', ['manufacturers' => $manufacturers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->manufacturer){
            $manufacturer = new Manufacturer();
            $manufacturer->name = $request->manufacturer;
            $manufacturer->save();
        }else{
            $product = new DeviceModel();
            $product->manufacturer_id = $request->prodManufacturer;
            $product->name = $request->product;
            $product->save();
        }
        return redirect()->back();
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
