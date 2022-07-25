<?php

namespace App\Services;


class Pushall
{
  private $apiKey;
  private $id;

  protected $url = "https://pushall.ru/api.php";

  public function __construct($apiKey, $id)
  {
    $this->apiKey = $apiKey;
    $this->id = $id;
  }

  public function send($text, $title = 'Создана новая статья')
  {
    $data = [
      "type" => "self",
      "id" => $this->id,
      "key" => $this->apiKey,
      "text" => $text,
      "title" => $title
    ];

    curl_setopt_array($ch = curl_init(), array(
      CURLOPT_URL => $this->url,
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_RETURNTRANSFER => true
    ));

    $res = curl_exec($ch); //получить ответ или ошибку
    curl_close($ch);

    return $res;
  }
}
