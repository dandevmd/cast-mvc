<?php


use Core\Authenticator;
use Http\Forms\LoginForm;

$attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password']
];

$form = new LoginForm($attributes);
$form->validate($attributes);

$signedIn = (new Authenticator())->attempt($attributes['email'], $attributes['password']);

if (!$signedIn) {
  $form->passError('password', 'Email or password is wrong.')
    ->throw();
}

redirect('/home');
