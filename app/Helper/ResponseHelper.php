<?php

namespace App\Helper;

use Illuminate\Http\Response;

class ResponseHelper
{
    private static function generateResponse($data, $message = '', $statusCode = Response::HTTP_OK) {
        return $data->additional([
            'message' => $message,
            'status' => $statusCode
        ]);
        // return response($data, $statusCode);
    }
    
    public static function success($data = [], $message = 'Success') {
        return self::generateResponse($data, $message, Response::HTTP_OK);
    }

    public static function created($data = [], $message = 'User registered successfully') {
        return self::generateResponse($data, $message, Response::HTTP_CREATED);
    }

    public static function fail($data = [], $message = 'Failure') {
        return self::generateResponse($data, $message, Response::HTTP_BAD_REQUEST);
    }

    public static function unauthorized($data = [], $message = 'Unauthorized') {
        return self::generateResponse($data, $message, Response::HTTP_UNAUTHORIZED);
    }

    public static function noContent($data = [], $message = 'Success'){
        // return self::generateResponse($data, $message, Response::HTTP_NO_CONTENT);
        return response($data, Response::HTTP_NO_CONTENT);
        // return ['data' => $data, 'message' => $message, Response::HTTP_NO_CONTENT];
    }

    public static function notFound($data = [], $message = 'Not Found') {
        return self::generateResponse($data, $message, Response::HTTP_NOT_FOUND);
    }

    public static function serverError($data = [], $message = 'Internal Server Error') {
        return self::generateResponse($data, $message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public static function validationError($errors = [], $message = 'Validation Error') {
        return self::generateResponse($errors, $message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function forbidden($data = [], $message = 'Forbidden') {
        return self::generateResponse($data, $message, Response::HTTP_FORBIDDEN);
    }

    public static function conflict($data = [], $message = 'Conflict') {
        return self::generateResponse($data, $message, Response::HTTP_CONFLICT);
    }
}