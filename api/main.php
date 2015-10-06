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
    $date="now";
    $publisher="username";
    $sql="INSERT INTO quotes (date,publisher,quote) 
    VALUES ($1,$2,$3)";
    db::Query($sql,[$date,$publisher,$text],true);
  }
}