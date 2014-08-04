<?php

require '../vendor/autoload.php';

Dotenv::load(__DIR__ . '/..');

$app = New \SlimController\Slim([
    'templates.path'             => 'templates',
    'controller.class_prefix'    => '\\Kieranajp\\Weather\\Controller',
    'controller.method_suffix'   => 'Action',
    'controller.template_suffix' => 'php',
]);

$app->addRoutes([
    '/'                 => 'Home:index',
    '/hello/'           => 'Home:hello',
    '/location/:search' => 'Location:search',
]);

$app->run();
