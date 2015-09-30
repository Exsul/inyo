<?php

class main extends api{
  protected function Reserve(){
    return[
      "design" => "root/body",
      "data" =>[],
    ];
  }
  protected function home(){
    $quotes= db::Query("SELECT * FROM quotes");
    return[
      "result" => "hello",
      "design" => "quotes/start",
      "data" =>[
        "quotes" => $quotes,
      ],
    ];
  }
  protected function submit($text){

  }
}