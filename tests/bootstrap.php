<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
function loader($class)
{
    $file = $class . '.php';

    if (file_exists($file)) {
        include $file;
    }

}

spl_autoload_register('loader');
