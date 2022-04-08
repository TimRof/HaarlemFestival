<?php

require __DIR__ . '/../patternrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
error_reporting(0);

date_default_timezone_set('Europe/Amsterdam');

$router = new PatternRouter();
$router->route($uri);
