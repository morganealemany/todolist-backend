<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    /**
     * Provide a centralized display of a JSON, with httpStatusCode, to all Controllers
     *
     * @param mixed $data
     * @param integer $httpStatusCode
     * @return void
     */
    protected function sendJsonResponse($data, $httpStatusCode=Response::HTTP_OK) {
        // Return response, with headers
        return response()->json($data, $httpStatusCode);
    }

    /**
     * Provide a centralized empty response, with httpStatusCode, to all Controllers
     *
     * @param integer $httpStatusCode
     * @return void
     */
    protected function sendEmptyResponse($httpStatusCode=Response::HTTP_NO_CONTENT) {
        // Return response, with headers
        return response('', $httpStatusCode);
    }
}
