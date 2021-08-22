<?php

if (!function_exists("json")) {
    function json($payload = [], int $status = 200): \Illuminate\Http\JsonResponse {
        return response()->json([
            "data"      => $payload,
            "status"    => $status
        ], $status);
    }
}

if (!function_exists("error")) {
    function error($payload = [], int $status = 500): \Illuminate\Http\JsonResponse {
        return response()->json([
            "errors"    => $payload,
            "status"    => $status
        ], $status);
    }
}
