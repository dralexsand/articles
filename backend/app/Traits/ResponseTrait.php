<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ResponseTrait
{
    public function getResponse($data, $successfulStatus = 200, $failedStatus = 200, $failedMessage = 'Error'): Response
    {
        if ($data) {
            $responseData = [
                'successful' => true,
                'data' => $data,
            ];
            $status = $successfulStatus;
        } else {
            $responseData = [
                'successful' => false,
                'message' => $failedMessage,
            ];
            $status = $failedStatus;
        }

        return response($responseData, $status);
    }
}