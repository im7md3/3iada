<?php

namespace App\Services;

class Whatsapp
{
  public const INSTANCE_ID = 'instance63194';

  public static function send($phone, $message)
  {
    $token = setting()->whatsapp_token;
    $instance_id = setting()->whatsapp_instance_id;

    $str1 = substr($phone, 1);
    $phone = '966' . $str1;
    $params = [
      'token' => $token,
      'to' => $phone,
      'body' => $message
    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.ultramsg.com/" . $instance_id . "/messages/chat",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_HTTPHEADER => [
        "content-type: application/x-www-form-urlencoded"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
  }

  public static function sendWithImage($phone, $message, $image)
  {
    $token = setting()->whatsapp_token;
    $instance_id = setting()->whatsapp_instance_id;

    $str1 = substr($phone, 1);
    $phone = '966' . $str1;
    $params = [
      'token' => $token,
      'to' => $phone,
      'image' => $image, // image path will not work on local
      'caption' => $message,
      'priority' => '',
      'referenceId' => '',
      'nocache' => '',
      'msgId' => '',
      'mentions' => ''
    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.ultramsg.com/" . $instance_id  . "/messages/image",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_HTTPHEADER => [
        "content-type: application/x-www-form-urlencoded"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
  }
}
