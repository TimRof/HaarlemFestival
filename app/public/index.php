<?php

require __DIR__ . '/../patternrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
error_reporting(E_ALL);

$router = new PatternRouter();
$router->route($uri);
