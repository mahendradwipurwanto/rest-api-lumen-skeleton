<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;

/**
 * HealthController Class
 *
 * This controller handles health-related endpoints and provides information about the application's health status.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class HealthController extends Controller
{
    /**
     * Health Check Endpoint
     *
     * Responds with a success message indicating that the service is healthy.
     *
     * @return JsonResponse JSON response indicating success.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function health(): JsonResponse
    {
        // Return a success response indicating the service is healthy
        return ResponseHelper::success();
    }

    /**
     * Information Endpoint
     *
     * Provides information about the application, including its name, memory usage, and CPU usage.
     *
     * @return JsonResponse JSON response containing application information.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function info(): JsonResponse
    {
        // Initialize an array to store application information
        $info['ms-name'] = env('APP_NAME', 'REST-API'); // Retrieve the application name from environment variables, default to 'REST-API'
        $info['memory_usage'] = GlobalHelper::formatBytes(memory_get_usage(true)); // Get the memory usage of the application
        $info['cpu_usage'] = GlobalHelper::get_server_load(); // Get the CPU usage of the server using GlobalHelper

        // Return a success response containing the application information
        return ResponseHelper::success($info);
    }
}
