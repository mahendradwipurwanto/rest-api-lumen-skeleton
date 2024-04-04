<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;

class HealthController extends Controller
{
    public function health()
    {
        return ResponseHelper::success(null);
    }

    public function info()
    {
        $info['ms-name'] = env('APP_NAME', 'REST-API');;
        $info['memory_usage'] = memory_get_usage(true);
        $info['cpu_usage'] = GlobalHelper::get_server_load();

        return ResponseHelper::success($info);
    }
}
