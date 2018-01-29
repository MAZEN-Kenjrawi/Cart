<?php
use Cart\App;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new App;
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cart',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collection'=> 'utf8_unicode_ci',
    'prefix' => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

require_once __DIR__ . '/../app/routes.php';