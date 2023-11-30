<?php

use Core\Response;

// die and dump function, stop the script and gives the value of arg
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

//gives back the uri from url (ex: /home)
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

//return request status code 404 and stop the script
function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}


// It's a filter for a condition (ex.: input_user === database_user )
function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

// go back one step from public folder where main file index.php  is located
function base_path($path)
{
    return BASE_PATH . $path;
}


//return the view for each controller
function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($uri){
    header('location: ' . $uri);
    exit();
}


