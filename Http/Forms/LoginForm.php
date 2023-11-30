<?php


namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
  protected   $errors = [];

  public function __construct(public array $attributes)
  {
    $this->attributes = $attributes;

    //validate email
    if (!Validator::email($attributes['email'])) {
      $this->errors['email'] = 'User not found';
    }

    //validate password
    if (!Validator::string($attributes['password'], 3, 7)) {
      $this->errors['password'] = 'Email or password is not correct.';
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);

    $instance->failed() ? $instance->throw() : $instance;
  }

  public function throw(){
    ValidationException::throw($this->errors(), $this->attributes);
  }

  public function failed()
  {
    return count($this->errors);
  }

  public function errors()
  {
    return $this->errors;
  }
  public function passError($field, $message)
  {
    $this->errors[$field] = $message;
    return $this;
  }
}
