<?php

namespace Core;

use Core\App;
use Core\Authenticator;

class Registrator
{
  public function attempt($attributes)
  {

    //check if user exist
    $ifUserExist =  App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
      'email' => $attributes['email']
    ])->find();

    if ($ifUserExist) {
      return false;
    }

    $name = strstr($attributes['email'], '@', true);
    App::resolve(Database::class)->query('INSERT INTO users (email, name, password) VALUES (:email, :name, :password)', [
      'email' => $attributes['email'],
      'name' => $name,
      'password' => password_hash($attributes['password'], PASSWORD_BCRYPT)
    ]);

    (new Authenticator())->login($attributes = [
      'email' => $attributes['email'],
      'password' => $attributes['password']
    ]);
    return true;
  }
}
