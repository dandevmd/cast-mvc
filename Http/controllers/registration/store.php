<?php

use Core\Registrator;
use Http\Forms\LoginForm;

$attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password'],
];
$form = new LoginForm($attributes);

$form->validate($attributes);
$registered = (new Registrator())->attempt($attributes);


if (!$registered) {
  $form->passError('password', 'User already exist!')
    ->throw();
}

redirect('/home');
