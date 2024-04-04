<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $products = Product::query();

        $products->with('stocks');

        $products->addSelect([
            'stock' => Stock::selectRaw('COALESCE(sum(stock), 0) as stock')->whereColumn('product_id', 'products.id')->where('type', 0)
        ]);

        if ($request->has('search')) {
            $search = json_decode($request->input('search'), true);

            foreach ($search as $key => $value) {
                $products->where($key, 'like', '%' . $value . '%');
            }
        }

        $data = $products->paginate($per_page, ['*'], 'products', $page);

        return ResponseHelper::success(ProductResource::collection($data));
    }

    //get detail
    public function show($id)
    {
        //check if id uuid "13e9a823-5877-3e8e-9fd8-02cd46e61f78"
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return ResponseHelper::error('Invalid Id', 400);
        }

        //find product by id with stock
        $product = Product::with('stocks')->find($id);
        $product->stock = (int) Stock::where('product_id', $id)->where('type', 0)->sum('stock');

        if (!$product) {
            return ResponseHelper::error('Product not found', 404);
        }

        return ResponseHelper::success(new ProductResource($product));
    }

    //store product and use ProductStore request as validation
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->has('stock')) {
            $product->stocks()->create([
                'product_id' => $product->id,
                'stock' => $request->input('stock'),
                'type' => 0
            ]);
        }

        return ResponseHelper::success($product, 'Product created', 201);
    }

    //update product and use ProductStore request as validation
    public function update(ProductRequest $request, $id)
    {
        //check if id uuid "13e9a823-5877-3e8e-9fd8-02cd46e61f78"
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return ResponseHelper::error('Invalid Id', 400);
        }

        //find product by id
        $product = Product::find($id);

        if (!$product) {
            return ResponseHelper::error('Product not found', 404);
        }

        $product->update($request->validated());

        return ResponseHelper::success($product, 'Product updated');
    }

    //delete product
    public function destroy($id)
    {
        //check if id uuid "13e9a823-5877-3e8e-9fd8-02cd46e61f78"
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return ResponseHelper::error('Invalid Id', 400);
        }

        //find product by id
        $product = Product::find($id);

        if (!$product) {
            return ResponseHelper::error('Product not found', 404);
        }

        //soft delete product
        $product->delete();

        return ResponseHelper::success(null, 'Product deleted');
    }
}
