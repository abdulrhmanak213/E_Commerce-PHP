<?php

trait HttpResponse
{
    public static function success($message,$statue){
        echo json_encode([
            'statue'=>'success',
            'message'=>$message,
        ]);
        http_response_code($statue);
    }
    public function failure($message,$statue)
    {
        echo json_encode(
            [
                'success' => false,
                'message' => $message
            ]
        );
        http_response_code($statue);
    }

    public function returnData($key, $value, $message,$statue)
    {
        echo json_encode(
            [
                'success' => true,
                'message' => $message,
                $key => $value
            ]

        );
        http_response_code($statue);
    }
}