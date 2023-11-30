<?php

$router->get('/home', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');



//NOTE ROUTES (read, create,update, delete)
// show all and show one note routes
$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php')->only('auth');
//create new note
$router->get('/notes/create', 'notes/create.php')->only('auth');
$router->post('/notes', 'notes/store.php')->only('auth');
//update note route
$router->get('/note/edit', 'notes/edit.php')->only('auth');
$router->patch('/note', 'notes/update.php')->only('auth');
//delete  note route
$router->delete('/note', 'notes/destroy.php')->only('auth');


//registration  routes
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');


//Enter login info, create session, delete session
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
