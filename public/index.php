<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define("PAG", 10);
define("IMG_RAD", 800);

$_SERVER['REQUEST_SCHEME'] = $_SERVER['REQUEST_SCHEME'] ? $_SERVER['REQUEST_SCHEME'] : 'http';

switch ($_SERVER['HTTP_HOST']) {
    case 'localhost':
        define("BTSP_DIR", "/travel_blog/bootstrap/");
        define("PUB_URL", $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/travel_blog/public/');
        define("IMG_DIR", $_SERVER['DOCUMENT_ROOT'].'/travel_blog/public/images/' );
        break;
    case '127.0.0.1:8000':
        define("BTSP_DIR", "/../../travel_blog/bootstrap/");
        define("PUB_URL", $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/travel_blog/public/');
        define("IMG_DIR", $_SERVER['DOCUMENT_ROOT'].'/travel_blog/public/images/' );
        break;
    default:
        define("BTSP_DIR", "/../travel_blog_base/bootstrap/");
        define("PUB_URL", $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/laravel/travel_blog/');
        define("IMG_DIR", $_SERVER['DOCUMENT_ROOT'].'/laravel/travel_blog/images' );
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

// require __DIR__.'/../bootstrap/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].BTSP_DIR.'autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

// $app = require_once __DIR__.'/../bootstrap/app.php';
$app = require_once $_SERVER['DOCUMENT_ROOT'].BTSP_DIR.'app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
