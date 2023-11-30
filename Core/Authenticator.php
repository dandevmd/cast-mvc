<?php


namespace Core;

class Authenticator
{
  public function login($user)
  {
    $_SESSION['user'] = [
      'email' => $user['email']
    ];

    session_regenerate_id(true);
  }

  public function logout()
  {
    Sessions::destroy();
  }

  public function attempt($email, $password)
  {
    //check if user exist
    $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
      'email' => $email
    ])->find();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $this->login($user);
        return true;
      }
    }
    return false;
  }
}
