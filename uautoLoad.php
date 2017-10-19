<?php
    spl_autoload_register(function($className) {
        if (substr($className, 0, 1) === 'U' ) {
            require lcfirst($className) . '.php';
        }else if (substr($className, 0, 1) === 'M' ) {
            require lcfirst($className) . '.php';
        }else if (substr($className, 0, 1) === 'V' ) {
            require lcfirst($className) . '.php';
        }
        
    });
?>