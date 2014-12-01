<?php
/*
 * Template class of Facile PHP Templating project
 * @author sharif <hello@sharif.co>
 * @link   http://www.sharif.co
 * @filesource system/facilitate.php
 *
 */


/*
|--------------------------------------------------------------------------
| Load Configuration file
|--------------------------------------------------------------------------
|
| Load the configuration file that would contain all the application config
| properties before attempting to bootstrap the system for run.
|
*/

$config = require_once __DIR__.'/../config.php';


/*
|--------------------------------------------------------------------------
| Bootstrap the Application
|--------------------------------------------------------------------------
|
| Check to make sure no error loading the configuration file into the the
| system and bootstrap the application
|
*/

    if($config)
    {

        //Initiate and empty array to collect errors
        $system_load_error = [];

        //Load all th necessary file for the system to function
        $load_facile_system_files = [
            'Facile Functions' => SYSTEM_DIR . 'functions' . EXT,
            'Facile Class' => SYSTEM_DIR . 'facile' . EXT,
            'Template class'=> SYSTEM_DIR.'template'.EXT
        ];

        //Loop through all the required system files and make them available for system use

        foreach ($load_facile_system_files as $key => $system_file)
        {
            if (!require_once $system_file)
                $system_load_error[$key] = " is missing";

        }

        if(!empty($system_load_error))
        {
            throw new Exception("Unable to load system files");
        }

        if(DEBUG_MODE)
        {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        }


        $app = new \Sharif\Facile\facile();
    }
