<?php

namespace App\Http\Controllers;

use App\Models\DeviceModel;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class ManAndProdController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::paginate(10);
        $products = DeviceModel::paginate(10);
        return view('catalog.manufacturerAndProducts', [
            'manufacturers' => $manufacturers,
            'products' => $products]);
    }
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
    public function update(Request $request, string $id)
    {
        if ($request->manufacturer){
            $manufacturer = Manufacturer::findOrFail($id);
            $manufacturer->name = $request->manufacturer;
            $manufacturer->save();
        }else{
            $product = DeviceModel::findOrFail($id);
            $product->manufacturer_id = $request->prodManufacturer;
            $product->name = $request->product;
            $product->save();
        }
        return redirect()->back();
    }
    public function destroy(string $id)
    {
        Manufacturer::destroy($id);
        return redirect()->back();
    }
    public function destroyProduct(string $id)
    {
        DeviceModel::destroy($id);
        return redirect()->back();
    }
}
