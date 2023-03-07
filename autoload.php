<?php

session_start();

spl_autoload_register('autoload');

function autoload($classe_name)
{
    $array_paths = array(
        'database/',
        'app/classes',
        'models/',
        'controllers/'
    );

    $parts = explode('\\',$classe_name);
    $name = array_pop($parts);

    foreach ($array_paths as $path) {
        $file = sprintf($path.'%s.php',$name);
        if (is_file($file)) {
            include_once $file;
        }
    }
}