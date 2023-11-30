<?php

namespace Core;

class Sessions
{
  public static function get($key)
  {
    return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? null;
  }
  public static function put($key, $value)
  {
    return $_SESSION[$key] = $value;
  }
  public static function has($key)
  {
    return (bool) static::get($key);
  }
  public static function flash($key, $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }
  public static function unflash()
  {
    unset($_SESSION['_flash']);
  }
  public static function flush()
  {
    $_SESSION = [];
  }
  public static function destroy()
  {
    //clear the session file
    static::flush();

    // Destroy the session
    session_destroy();

    //delete the cookie by setting it in the past
    $params = session_get_cookie_params(); //get all the cookie info 
    setcookie('PHPSESSID', '', -3600, $params['path'], $params['domain']);
  }

  public static function old($key, $default = ''){
    return $_SESSION['_flash']['old'][$key] ?? $default;
  }
}
