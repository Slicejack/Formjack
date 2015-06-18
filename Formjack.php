<?php

spl_autoload_register(function ($class) {
    $dir = str_replace(basename(__DIR__), '', __DIR__);
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = "{$dir}" . DIRECTORY_SEPARATOR . "{$class}.php";
    if (is_readable($file))
        require_once $file;
});
