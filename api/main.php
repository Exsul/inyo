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
  protected function submit($text,$tags){
    $publisher="username";
    $sql_quotes="INSERT INTO quotes (publisher,quote) 
    VALUES ($1,$2) returning id";
    $trans = db::Begin();
    $quote_id = db::Query($sql_quotes,[$publisher,$text],true)->id;

    $res = db::Query("INSERT INTO tags(quote_id, tag) SELECT $1, unnest($2::varchar[]) RETURNING tag", [$quote_id, $tags]);

    $trans->Commit();

    return $this('api', 'main')->quote($quote_id)->id;
    return $this->quote($quote_id);
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