<?php

function __autoload($class)
{
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require $class . '.php';
}