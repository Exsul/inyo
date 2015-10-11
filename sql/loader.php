<?php

function EmergencyCreateDB()
{
  GLOBAL $sql;

  $str = $sql->con_params['origin'];

  $start = 0;
  for (; $start < strlen($str); $start++)
    if ($str[$start] == '@')
      break;
  for (; $start < strlen($str); $start++)
    if ($str[$start] == '/')
      break;
  for ($end = $start; $end < strlen($str); $end++)
    if ($end == ':')
      break;

  $emergency_connection_string =
    substr($str, 0, $start + 1)
    .
    substr($str, $end);

  var_dump("Emergency connect: {$emergency_connection_string}");
  $pg = $sql->Connect($emergency_connection_string);

  $result = $pg->Query("CREATE DATABASE inyo");

  var_dump("Reload page please");
  exit();
}

function SQLLoad($file)
{
  header("SQL: $file", false);

  $con = db::RawConnection();

  $sql = file_get_contents($file);
  pg_send_query($con, $sql);
  if (($error = pg_last_error($con)) !== '')
    die("Failure at loading {{$file}} with {{$error}}");

  while (pg_connection_busy($con))
    sleep(1);

  while (pg_get_result($con) !== false)
    if (($error = pg_last_error($con)) !== '')
      die("Failure at loading {{$file}} with {{$error}}");
}

if (db::RawConnection() == false)
  EmergencyCreateDB();

$res = @db::Query("SELECT * FROM quotes LIMIT 1");
if (is_string($res)) // then its error
  SQLLoad("sql/schema.sql");
else if (!$res())
{
}

header("SQL: OK", false);