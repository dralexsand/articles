<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $result = [
            'success' => true,
            'data' => [],
        ];

        return response($result, 200);
    }
}
