<?php
    /*
     * Template class of Facile PHP Templating project
     * @author sharif <hello@sharif.co>
     * @link   http://www.sharif.co
     * @filesource system/facilitate.php
     *
     */

    #< START OF SYSTEM CONFIGURATION

    /*
    |--------------------------------------------------------------------------
    | INTERNAL CONFIGURATION OPTIONS *** DO NOT MODIFY ***
    |--------------------------------------------------------------------------
    |
    | Unless you know what you are doing do not modify any of the following
    | configuration, they are depended on through out the system, one inappropriate
    | change will cause breakdown of the overall system.
    |
    */

    $get_public_uri = filter_var(rtrim($_SERVER['SCRIPT_NAME'],"index.php"), FILTER_SANITIZE_URL);

    //Helpers
    define('FACILE',        true);
    define('DS',            DIRECTORY_SEPARATOR);
    define('EXT',           '.php');

    //Root
    define('ROOT_DIR',      __DIR__.DS.'..'.DS);

    //System
    define('SYSTEM_DIR',    ROOT_DIR.DS.trim(CUSTOM_SYSTEM_DIR,"\x00..\x20/").DS);
    define('ASSETS_DIR',    ROOT_DIR.DS.trim(CUSTOM_ASSETS_DIR,"\x00..\x20/").DS);
    define('DATA_DIR',      ROOT_DIR.DS.trim(CUSTOM_DATA_DIR,"\x00..\x20/").DS);

    //Data
    define('PAGES',         DATA_DIR.trim(CUSTOM_PAGES_DIR,"\x00..\x20/").DS);
    define('WIDGETS',       DATA_DIR.trim(CUSTOM_WIDGETS_DIR,"\x00..\x20/").DS);

    //Public
    define('PUBLIC_ROOT',  $get_public_uri);
    define('PUBLIC_ASSETS',PUBLIC_ROOT.trim(CUSTOM_ASSETS_DIR,"\x00..\x20/").'/');

    # END OF SYSTEM CONFIGURATION />


    /*
    |--------------------------------------------------------------------------
    | Bootstrap the Application
    |--------------------------------------------------------------------------
    |
    | Check to make sure no error loading the configuration file into the the
    | system and bootstrap the application
    |
    */


    //Initiate and empty array to collect errors
    $system_load_error = [];

    //Load all th necessary file for the system to function
    $load_facile_system_files = ['facile'.EXT, 'functions'.EXT];

    //Loop through all the required system files and make them available for system use

    foreach ($load_facile_system_files as $key => $system_file)
    {
        if (!require_once $system_file)
            $system_load_error[$system_file] = " is missing";

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


    $facile = new \Sharif\Facile\facile();

