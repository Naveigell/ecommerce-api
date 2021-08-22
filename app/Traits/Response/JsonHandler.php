<?php


namespace App\Traits\Response;


trait JsonHandler
{
    private function response($payload, $status, $message)
    {
        if ($status >= 400) {
            return error([
                "message"       => $message
            ], $status);
        }

        return json($payload, $status);
    }
}
