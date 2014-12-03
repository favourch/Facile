<?php

    /*
     * Template class of Facile PHP Templating project
     * @author sharif <hello@sharif.co>
     * @link   http://www.sharif.co
     * @filesource index.php
     *
     */



    /*
     ___       __          ___
    |__   /\  /  ` | |    |__
    |    /~~\ \__, | |___ |___
    SIMPLE PHP TEMPLATE ENGINE BY SHARIF.CO

    */


    #< START OF USER CONFIGURATION

    /*
    |--------------------------------------------------------------------------
    | Basic Setting
    |--------------------------------------------------------------------------
    |
    | Basic fallback settings
    |
    */

    //Default site name : used if page title not defined
    define('SITE_NAME', 'Facile PHP Templating Engine');

    //Set default site description used if page does not contain a description
    define('SITE_DESCRIPTION','Facile php based templating engine for small websites');


    //Default site keywords, used when page does not have keywords
    define('SITE_KEYWORDS', 'Facile PHP, PHP Templating Engine, PHP Micro Sites');



    /*
    |--------------------------------------------------------------------------
    | Application Time Zone
    |--------------------------------------------------------------------------
    |
    | Provide system application time zone, be default UTC is used
    |
    */


    define('SYSTEM_TIME_ZONE',     'America/New_York');

    /*
    |--------------------------------------------------------------------------
    | Debug Mode
    |--------------------------------------------------------------------------
    |
    | Turn PHP error reporting on and off, this should be set to false on
    | live website
    |
    */

    define('DEBUG_MODE', true);

    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    |
    | Provide the default theme to be loaded, themes are located in the assets
    | directory and the must contain at least default.php
    |
    */

    define('THEME',         'simplex');  // define your default theme **simplex



    /*
    |--------------------------------------------------------------------------
    | Partial Files Directory
    |--------------------------------------------------------------------------
    |
    | This is the directory in your themes files where you keep
    | header, footer, sidebar and widget. By default Facile uses includes
    | directory as the partial directory, if you do not use partial directory
    | instead have all your files in the root of the theme directory tech is to
    | empty. Do not delete the Constant it will break the system.
    |
    */

    // Custom Partial template file directory relative to themes root
    define('PARTIAL_DIR',   'includes'); // default includes


    /*
    |--------------------------------------------------------------------------
    | Static Look and Feel Page Extension
    |--------------------------------------------------------------------------
    |
    | If you like staticy feel and look for your pages setup and extension e.g.
    | html => facile/about-us.html or  facile/services/web-development.html
    |
    |
    */

    define('PAGE_EXTENSION', 'html');

    /*
    |--------------------------------------------------------------------------
    | Data storage type
    |--------------------------------------------------------------------------
    |
    | Choose a data storage type. By default Facile uses flat file where all the
    | data are stored in the data/page and data/widgets directories. Only one
    | option below should set to true, if both are set to tru, Facile will try to
    | connect to database, if successfully connects it will try to retrieve data
    | from the database, if error occurs will default to flat
    |
    | *DATABASE STORAGE OPTION BY DEFAULT DROPPED DECEMBER 2, 2014 6:35 P.M. EST ~Sharif
    |
    */

    //content are stored in flat file
    define('FLAT_STORAGE',  true);

    /*
    |--------------------------------------------------------------------------
    | SYSTEM CUSTOMIZATION
    |--------------------------------------------------------------------------
    | The system customization will allow you to define your own data, assets,
    | system directories locations and names.
    |
    */



    /*
     |-------------------------------------------------------|
     |              CUSTOM ASSETS DIRECTORY NAME             |
     |-------------------------------------------------------|
     |****** DON'T FORGET TO RENAME THE ACTUAL DIRECTORY ****|
     | path relative to root e.g 'path/to/new/asset_dir'     |
     |-------------------------------------------------------|
    */

    define('CUSTOM_ASSETS_DIR', 'assets');  //default assets

    /*
     |-------------------------------------------------------|
     |              CUSTOM DATA DIRECTORY NAME               |
     |-------------------------------------------------------|
     |****** DON'T FORGET TO RENAME THE ACTUAL DIRECTORY ****|
     | path relative to root e.g 'path/to/new/dat_dir'       |
     |-------------------------------------------------------|
    */

    define('CUSTOM_DATA_DIR', 'data');      // default data

     /*
     |-------------------------------------------------------|
     |              CUSTOM DATA/PAGES DIRECTORY NAME         |
     |-------------------------------------------------------|
     |****** DON'T FORGET TO RENAME THE ACTUAL DIRECTORY ****|
     | path must be a subdir of data_dir, can go several lev-|
     | al deep e.g.'data_dir/path/to/new/pages_dir'          |
     |-------------------------------------------------------|
    */
    define('CUSTOM_PAGES_DIR', 'pages'); //Default pages



    /*
    |-------------------------------------------------------|
    |              CUSTOM DATA/WIDGETS DIRECTORY NAME       |
    |-------------------------------------------------------|
    |****** DON'T FORGET TO RENAME THE ACTUAL DIRECTORY ****|
    | path must be a subdir of data_dir, can go several lev-|
    | al deep e.g.'data_dir/path/to/new/widgets_dir'        |
    |-------------------------------------------------------|
    */

    define('CUSTOM_WIDGETS_DIR', 'widgets');  //Default widgets


     /*
     |-------------------------------------------------------|
     |              CUSTOM SYSTEM DIRECTORY NAME             |
     |-------------------------------------------------------|
     |****** DON'T FORGET TO RENAME THE ACTUAL DIRECTORY ****|
     | path relative to root e.g 'path/to/new/system_dir'    |
     |-------------------------------------------------------|
    */

    define('CUSTOM_SYSTEM_DIR', 'system'); //default system







    #   END OF USER CONFIGURATION />



    /*
    |--------------------------------------------------------------------------
    | EXTREME SYSTEM CUSTOMIZATION
    |--------------------------------------------------------------------------
    | Extremely customize the system
    |
    */

    //Rename functions file
    define('EXC_FUNCTIONS_NAME', 'functions');

    //Rename bootstrap file name
    define('EXC_BOOTSTRAP_NAME', 'bootstrap');





    /*-------------------------------------------------------------|
    |******************* S T O P   H E R E ************************|
    |-------------------------------------------------------------*/




    /*
     |-------------------------------------------------------------------------
     |  HELPERS ** DO NOT MODIFY
     |-------------------------------------------------------------------------
     */

    //OS Directory separator short name
    define('DS',            DIRECTORY_SEPARATOR);

    //System file extension
    define('EXT',           '.php');

    /*
    |--------------------------------------------------------------------------
    | APPLICATION ROOT DIRECTORY
    |--------------------------------------------------------------------------
    |                   **DO NOT MODIFY THIS OPTION***
    | Root dir definition moved from bootstrap to index to allow system
    | customization and being able to move any system components anywhere
    | according to users customization without breaking the system.
    |
    */

    define('ROOT_DIR', __DIR__.DS);

    /*
    |--------------------------------------------------------------------------
    | Bootstrap the Application
    |--------------------------------------------------------------------------
    |
    |Require once Facile bootstrapper aka facilitator to init the application
    |
    */

    require_once CUSTOM_SYSTEM_DIR.DS.EXC_BOOTSTRAP_NAME.EXT;


    /*
    |--------------------------------------------------------------------------
    | Run the application
    |--------------------------------------------------------------------------
    |
    | Once application is successfully bootstrapped, run the application
    |
    */

    $facile->run();


