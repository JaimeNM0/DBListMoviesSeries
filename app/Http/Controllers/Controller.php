<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResult(bool $success, string $message, mixed $data, $status = 200)
    {
        return response([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
