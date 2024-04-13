<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

// Importing the JsonResponse class from Laravel's HTTP library

/**
 * ResponseHelper Class
 *
 * This class provides helper functions for generating JSON responses.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class ResponseHelper
{
    /**
     * Success Response
     *
     * Generates a JSON response indicating success along with optional data and message.
     *
     * @param mixed|null $data Data to be included in the response.
     * @param string $message Message indicating the success status.
     * @param int $statusCode HTTP status code of the response.
     * @return JsonResponse JSON response indicating success.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public static function success(mixed $data = null, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        // Generate a JSON response with success status, message, and optional data
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Error Response
     *
     * Generates a JSON response indicating error along with optional error message.
     *
     * @param string $message Message indicating the error status.
     * @param int $statusCode HTTP status code of the response.
     * @return JsonResponse JSON response indicating error.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public static function error(string $message = 'Error', int $statusCode = 400): JsonResponse
    {
        // Generate a JSON response with error status and message
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}
