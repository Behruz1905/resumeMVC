<?php
    error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED);
    //BEHRUZ MVC Load Config
    require_once 'config/config.php';

    // Load config
    require_once 'helpers/url_helper.php';
    
    //session helper
    require_once 'helpers/session_helper.php';

    //lang_helper
    require_once 'helpers/lang_az.php';


    // Librarileri yukleyirik
    //AUTOLOAD Core Libraries
    spl_autoload_register(function($className){
        require_once 'libraries/'. $className .'.php';
    });
?>