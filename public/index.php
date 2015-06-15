<?php

namespace Single;

require '../backend/config/constants.php';
require '../backend/config/config.php';
require '../backend/config/routes.php';
require 'application.php';

try 
{
    $application = new \Application($config);
    $application->setRoutes($routes);
    $application->main();
} 
catch (\Exception $e) 
{
    echo $e->getMessage();
}
