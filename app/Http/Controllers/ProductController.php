<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * ProductController Class
 *
 * This controller handles CRUD operations for products.
 * It includes methods for listing, viewing, creating, updating, and deleting products.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class ProductController extends Controller
{
    /**
     * List Products
     *
     * Retrieves a paginated list of products, optionally filtered by search criteria.
     *
     * @param Request $request HTTP request object containing query parameters.
     * @return JsonResponse JSON response containing paginated product data.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function index(Request $request): JsonResponse
    {
        // Retrieve pagination parameters from request
        $per_page = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        // Start building the query to retrieve products
        $products = Product::query();

        // Include related stocks in the query
        $products->with('stocks');

        // Add a select clause to calculate and retrieve total stock for each product
        $products->addSelect([
            'stock' => Stock::selectRaw('COALESCE(sum(stock), 0) as stock')->whereColumn('product_id', 'products.id')->where('type', 0)
        ]);

        // If search criteria are provided, filter the products
        if ($request->has('search')) {
            $search = json_decode($request->input('search'), true);

            foreach ($search as $key => $value) {
                $products->where($key, 'like', '%' . $value . '%');
            }
        }

        // Paginate the results and return as JSON response
        $data = $products->paginate($per_page, ['*'], 'products', $page);

        return ResponseHelper::success(ProductResource::collection($data));
    }

    /**
     * Get Product Detail
     *
     * Retrieves detailed information about a specific product, including its stock.
     *
     * @param string $id UUID of the product.
     * @return JsonResponse JSON response containing product details.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function show(string $id): JsonResponse
    {
        // Check if id is a valid UUID
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return ResponseHelper::error('Invalid Id');
        }

        // Find product by id with related stocks
        $product = Product::with('stocks')->find($id);
        // Calculate total stock for the product
        $product->stock = (int) Stock::where('product_id', $id)->where('type', 0)->sum('stock');

        // If product not found, return error response
        if (!$product) {
            return ResponseHelper::error('Product not found', 404);
        }

        // Return product details as JSON response
        return ResponseHelper::success(new ProductResource($product));
    }

    /**
     * Store Product
     *
     * Creates a new product based on the provided data.
     *
     * @param ProductRequest $request Request containing validated product data.
     * @return JsonResponse JSON response indicating success or failure of product creation.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function store(ProductRequest $request): JsonResponse
    {
        // Create a new product with validated data
        $product = Product::create($request->validated());

        // If stock data provided, create related stock entry
        if ($request->has('stock')) {
            $product->stocks()->create([
                'product_id' => $product->id,
                'stock' => $request->input('stock'),
                'type' => 0
            ]);
        }

        // Return success response with created product data
        return ResponseHelper::success($product, 'Product created', 201);
    }

    /**
     * Update Product
     *
     * Updates an existing product with the provided data.
     *
     * @param ProductRequest $request Request containing validated product data.
     * @param string $id UUID of the product to be updated.
     * @return JsonResponse JSON response indicating success or failure of product update.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function update(ProductRequest $request, string $id): JsonResponse
    {
        // Check if id is a valid UUID
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return ResponseHelper::error('Invalid Id');
        }

        // Find product by id
        $product = Product::find($id);

        // If product not found, return error response
        if (!$product) {
            return ResponseHelper::error('Product not found', 404);
        }

        // Update the product with validated data
        $product->update($request->validated());

        // Return success response with updated product data
        return ResponseHelper::success($product, 'Product updated');
    }

    /**
     * Delete Product
     *
     * Deletes a product with the provided UUID.
     *
     * @param string $id UUID of the product to be deleted.
     * @return JsonResponse JSON response indicating success or failure of product deletion.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function destroy(string $id): JsonResponse
    {
        // Check if id is a valid UUID
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return ResponseHelper::error('Invalid Id');
        }

        // Find product by id
        $product = Product::find($id);

        // If product not found, return error response
        if (!$product) {
            return ResponseHelper::error('Product not found', 404);
        }

        // Soft delete the product
        $product->delete();

        // Return success response indicating product deletion
        return ResponseHelper::success(null, 'Product deleted');
    }
}
