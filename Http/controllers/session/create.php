<?php

use Core\Sessions;

view('session/create.view.php', [
  'heading'=> "Complete Login Form",
  'errors' => Sessions::get('errors') ?? [],
  'email' => Sessions::old('email')
]);