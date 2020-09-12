<?php

namespace App\Traits;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

trait ResponseTrait
{

    public static function successResponse($message = 'Success', $data = null)
    {
        $res = [
            'status' => true,
            'msg' => $message
        ];
        if ($data) {
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public static function failureResponse($message = 'Error Occurred', $data = [])
    {
        $res = [
            'status' => false,
            'msg' => $message
        ];
        if (count($data)) {
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public static function validationResponse($validator)
    {
        $errors = $validator->errors()->all();
        $res = [
            'status' => false,
            'msg' => collect($errors)->reduce(function ($carry, $item) {
                return $carry . $item . " ";
            }),
            'data' => $errors
        ];
        return response()->json($res);
    }

    public static function exceptionResponse(\Exception $exception, $module = '')
    {
        report($exception);

        if ($exception instanceof \Illuminate\Database\QueryException) {
            $message = $exception->errorInfo;
        } else if ($exception instanceof RequestException) {
            return json_decode($exception->getResponse()->getBody()->getContents(), true);
        } else {
            $message = $exception->getMessage();
        }

        return response()->json([
            'status' => 'false',
            'error' => $message,
            'file' => $exception->getFile(),
            'code' => $exception->getCode(),
            'line' => $exception->getLine(),
            'message' => "Exception in module: {$module}",
            'details' => $exception->getTraceAsString()
        ], 500);
    }

    public static function errorResponse($module = '', $error = 'create', $hint = '', $code = 409, $data = [])
    {
        return response()->json([
            'error' => self::errorType($error),
            'code' => $code,
            'hint' => $hint,
            'message' => "Can't {$error} {$module}",
            'data' => $data
        ], $code);
    }

    private static function errorType($error)
    {
        switch ($error) {
            case 'create':
                return 'not_be_created';
            case 'update':
                return 'not_be_updated';
            case 'delete':
                return 'not_be_deleted';
            default:
                return ((empty($error)) ? 'Unknown' : $error);
        }
    }
}
