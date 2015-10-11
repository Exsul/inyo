<?php

class auth extends api
{
  protected function uid()
  {
    phoxy_protected_assert
    (
      $this->is_user_authorized(),
      [
        "exception" => "auth_required",
        "origin" => $this->GetExceptionOrigin(),
        "cache" => "no",
        "data" =>
        [
          "origin" => $this->GetExceptionOrigin(),
        ],
      ]
    );

    return $this->login();
  }

  private function GetExceptionOrigin()
  {
    $uri = explode("REDIRECTIT", $_SERVER['QUERY_STRING'])[1];
    return str_replace("/".phoxy_conf()['get_api_param'], "", $uri);
  }

  public function get_uid($id = null)
  {
    global $USER_SENSITIVE;
    $USER_SENSITIVE = true;
    if (session_status() !== PHP_SESSION_ACTIVE)
      session_start();
    global $_SESSION;

    if (!is_null($id))
    {
      $_SESSION['uid'] = $id;
      session_regenerate_id();
    }
    if (isset($_SESSION['uid']))
      return $_SESSION['uid'];
    return 0;
  }

  public function is_user_authorized()
  {
    return !!$this->get_uid();
  }

  public function get_login($id)
  {
    return $this->get_uid($id);
  }

  protected function login()
  {
    return
    [
      "data" =>
      [
        "login" => $this->get_login()
      ],
      "script" => "main/login",
      "before" => "set_uid",
    ];
  }

  protected function logout()
  {
    $this->get_login(0);
    return
    [
      'reset' => true,
    ];
  }

  public function register()
  {
    if ($this->get_uid())
      return $this->get_uid();
    $res = db::Query("INSERT INTO users.info DEFAULT VALUES RETURNING uid", [], true);
    return $this->get_login($res->uid);
  }
}