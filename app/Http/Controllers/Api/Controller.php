<?php

/*
 * @author weifan
 * Wednesday 1st of April 2020 11:12:35 AM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller extends BaseController
{
    public function errorResponse($statusCode, $message = null, $code = 0)
    {
        throw new HttpException($statusCode, $message, null, [], $code);
    }
}
