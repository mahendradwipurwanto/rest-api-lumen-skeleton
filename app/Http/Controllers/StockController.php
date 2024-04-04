<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Http\Resources\StockResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //index
    public function index(Request $request)
    {
        $stocks = Stock::query();
        $stocks->when($request->product_id, function ($query) use ($request) {
            return $query->where('product_id', $request->product_id);
        });

        return response()->json([
            'success' => true,
            'message' => 'List Data Stock',
            'data' => StockResource::collection($stocks->with('product')->get())
        ], 200);
    }

    //get detail
    public function show($id)
    {
        //check if id uuid "13e9a823-5877-3e8e-9fd8-02cd46e61f78"
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Id'
            ], 400);
        }

        //find stock by id with product
        $stock = Stock::with('product')->find($id);

        if (!$stock) {
            return response()->json([
                'success' => false,
                'message' => 'Stock not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Stock',
            'data' => new StockResource($stock),
        ], 200);
    }

    //list stock by product id
    public function listByProduct($id)
    {
        //check if id uuid "13e9a823-5877-3e8e-9fd8-02cd46e61f78"
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Id'
            ], 400);
        }

        $product = Product::find($id);
        $product->stock = (int) Stock::where('product_id', $id)->where('type', 0)->sum('stock');

        $data = [
            'product' => $product,
            'stock_in' => Stock::where('product_id', $id)->where('type', 0)->get(),
            'stock_out' => Stock::where('product_id', $id)->where('type', 1)->get()
        ];

        return response()->json([
            'success' => true,
            'message' => 'List Data Stock',
            'data' => new StockResource($data)
        ], 200);
    }

    //store using StockRequest
    public function storeIn(StockRequest $request)
    {
        $request->merge(['type' => 0]);

        $stock = Stock::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Stock Created',
            'data' => $stock
        ], 201);
    }

    //store using StockRequest
    public function storeOut(StockRequest $request)
    {
        $request->merge(['type' => 1]);

        $stock = Stock::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Stock Created',
            'data' => $stock
        ], 201);
    }

    //delete
    public function destroy($id)
    {
        //check if id uuid "13e9a823-5877-3e8e-9fd8-02cd46e61f78"
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Id'
            ], 400);
        }

        //find stock by id
        $stock = Stock::find($id);

        $stock->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Stock Deleted',
            'data' => $stock
        ], 200);
    }
}
