<?php

require "../system/helper.php";
require "../vendor/autoload.php";

$config = require "../system/config.php";

$pdo = sys\Database\Connection::make($config['database']);

$router = sys\Router::load("../app/route.php")->direct(sys\Request::URI(), sys\Request::method());


