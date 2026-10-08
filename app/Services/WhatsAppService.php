<?php

namespace App\Services;

class WhatsAppService
{
    private $token = "wi9mcns3mbf0px3s";
    private $instance = "instance184888";

    public function send($number, $message)
    {
        // Remove +, space, -, etc.
        $number = preg_replace('/\D/', '', $number);

        // Add India country code if missing
        if (substr($number, 0, 2) != '91') {
            $number = '91' . $number;
        }

        $params = [
            'token' => $this->token,
            'to'    => $number,
            'body'  => $message,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.ultramsg.com/{$this->instance}/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return curl_error($curl);
        }

        curl_close($curl);

        return $response;
    }
}