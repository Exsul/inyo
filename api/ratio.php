<?php

class ratio extends api{
  protected function vote($id, $delta){
    return db::Query("UPDATE quotes SET ratio=ratio+$2 WHERE id=$1 RETURNING ratio",[$id, $delta], true)->ratio;
  }
}