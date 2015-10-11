<?php

class main extends api{
  protected function Reserve(){
    return[
      "design" => "root/body",
      "data" =>[],
    ];
  }
  protected function home(){
    $quotes= db::Query("SELECT * FROM quotes ORDER BY date DESC");
    return[
      "result" => "hello",
      "design" => "quotes/start",
      "data" =>[
        "quotes" => $quotes,
      ],
    ];
  }
  protected function submit($text){
    $publisher="username";
    $sql="INSERT INTO quotes (publisher,quote) 
    VALUES ($1,$2) returning id";
    return db::Query($sql,[$publisher,$text],true)->id;
  }

  protected function quote($id){
    $quote= db::Query("SELECT * FROM quotes WHERE id=$1",[$id],true);
    return[
      "result" => "hello",
      "design" => "quotes/quote",
      "data" => $quote,
    ];
  }
}