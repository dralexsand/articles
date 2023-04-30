<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;

    public function getUserByEmail(string $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            $resource = null;
        } else {
            $resource = new UserResource($user);
        }

        return $this
            ->getResponse(
                $resource,
                200,
                200,
                'Resource not found'
            );
    }
}
