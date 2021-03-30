<?php

require __DIR__ . '/vendor/autoload.php';
function __autoload($class) {
    require_once "/Config/$class.php";
}

use Symfony\Component\Console\Application;

$application = new Application();

# add our commands
$application->add(new MigrationCommand());

$application->run();