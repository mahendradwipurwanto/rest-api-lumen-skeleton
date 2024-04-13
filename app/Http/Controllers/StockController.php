<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Http\Resources\StockResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * StockController Class
 *
 * This controller handles CRUD operations for stocks.
 * It includes methods for listing, viewing, creating, and deleting stocks.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class StockController extends Controller
{
    /**
     * List Stocks
     *
     * Retrieves a list of stocks, optionally filtered by product ID.
     *
     * @param Request $request HTTP request object containing query parameters.
     * @return JsonResponse JSON response containing list of stocks.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function index(Request $request): JsonResponse
    {
        // Start building the query to retrieve stocks
        $stocks = Stock::query();

        // If product_id is provided in the request, filter stocks by that product ID
        $stocks->when($request->product_id, function ($query) use ($request) {
            return $query->where('product_id', $request->product_id);
        });

        // Return the list of stocks as a JSON response
        return response()->json([
            'success' => true,
            'message' => 'List Data Stock',
            'data' => StockResource::collection($stocks->with('product')->get())
        ]);
    }

    /**
     * Get Stock Detail
     *
     * Retrieves detailed information about a specific stock, including its associated product.
     *
     * @param string $id UUID of the stock.
     * @return JsonResponse JSON response containing stock details.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function show(string $id): JsonResponse
    {
        // Check if id is a valid UUID
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Id'
            ], 400);
        }

        // Find stock by id with its associated product
        $stock = Stock::with('product')->find($id);

        // If stock not found, return error response
        if (!$stock) {
            return response()->json([
                'success' => false,
                'message' => 'Stock not found'
            ], 404);
        }

        // Return stock details as a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Stock',
            'data' => new StockResource($stock),
        ]);
    }

    /**
     * List Stocks by Product ID
     *
     * Retrieves a list of stocks associated with a specific product, including both in and out stock entries.
     *
     * @param string $id UUID of the product.
     * @return JsonResponse JSON response containing list of stocks associated with the product.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function listByProduct(string $id): JsonResponse
    {
        // Check if id is a valid UUID
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Id'
            ], 400);
        }

        // Find the product by id
        $product = Product::find($id);
        // Calculate total stock for the product
        $product->stock = (int)Stock::where('product_id', $id)->where('type', 0)->sum('stock');

        // Retrieve in and out stock entries associated with the product
        $data = [
            'product' => $product,
            'stock_in' => Stock::where('product_id', $id)->where('type', 0)->get(),
            'stock_out' => Stock::where('product_id', $id)->where('type', 1)->get()
        ];

        // Return the list of stocks associated with the product as a JSON response
        return response()->json([
            'success' => true,
            'message' => 'List Data Stock',
            'data' => new StockResource($data)
        ]);
    }

    /**
     * Store Stock In
     *
     * Records an incoming stock entry based on the provided data.
     *
     * @param StockRequest $request Request containing validated stock data.
     * @return JsonResponse JSON response indicating success or failure of stock creation.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function storeIn(StockRequest $request): JsonResponse
    {
        // Set the type of stock entry as "in"
        $request->merge(['type' => 0]);

        // Create a new stock entry with the provided data
        $stock = Stock::create($request->all());

        // Return success response with the created stock entry data
        return response()->json([
            'success' => true,
            'message' => 'Data Stock Created',
            'data' => $stock
        ], 201);
    }

    /**
     * Store Stock Out
     *
     * Records an outgoing stock entry based on the provided data.
     *
     * @param StockRequest $request Request containing validated stock data.
     * @return JsonResponse JSON response indicating success or failure of stock creation.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function storeOut(StockRequest $request): JsonResponse
    {
        // Set the type of stock entry as "out"
        $request->merge(['type' => 1]);

        // Create a new stock entry with the provided data
        $stock = Stock::create($request->all());

        // Return success response with the created stock entry data
        return response()->json([
            'success' => true,
            'message' => 'Data Stock Created',
            'data' => $stock
        ], 201);
    }

    /**
     * Delete Stock
     *
     * Deletes a stock entry with the provided UUID.
     *
     * @param string $id UUID of the stock to be deleted.
     * @return JsonResponse JSON response indicating success or failure of stock deletion.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function destroy(string $id): JsonResponse
    {
        // Check if id is a valid UUID
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Id'
            ], 400);
        }

        // Find stock by id
        $stock = Stock::find($id);

        // Delete the stock entry
        $stock->delete();

        // Return success response indicating stock deletion
        return response()->json([
            'success' => true,
            'message' => 'Data Stock Deleted',
            'data' => $stock
        ]);
    }
}
