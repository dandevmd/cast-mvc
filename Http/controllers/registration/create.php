<?php

use Core\Sessions;

view('registration/create.view.php', [
  'heading'=> "Fill Registration Form",
  'errors' => Sessions::get('errors') ?? [],
  'email' => Sessions::old('email')
]);