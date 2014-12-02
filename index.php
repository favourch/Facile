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


    define('TIME_ZONE',     'America/New_York');

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

    define('PARTIAL_DIR',   '/includes/'); // default includes


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
    */

    //content are stored in flat file
    define('FLAT_STORAGE',  true);

    // Contents are stored in database
    define('DB_STORAGE',    false);





    /*
    |--------------------------------------------------------------------------
    | Provide Database Information
    |--------------------------------------------------------------------------
    |
    | Provide database information to connect to database, if info is not supplied
    | the system will bypass this option all together and default to flat storage
    | only fill the properties you know and leave the rest as default
    |
    */

    // Type of database
    define('DB_DRIVER',     'mysql');

    //Name of your database
    define('DB_NAME',       'facile');          # YOUR MUST KNOW

    //Database host address **normally localhost
    define('DB_HOST',       '127.0.0.1');

    //Database username
    define('DB_USER',       'root');            # YOUR MUST KNOW

    //Database password
    define('DB_PASS',       '');                # YOU MUST KNOW

    //Database charset
    define('DB_CHARSET',	'utf8');

    //Database collation
    define('DB_COLLATION', 	'utf8_unicode_ci');



    #   END OF USER CONFIGURATION />

    /********************************************************************/



    /*
    |--------------------------------------------------------------------------
    | Bootstrap the Application
    |--------------------------------------------------------------------------
    |
    |Require once Facile bootstrapper aka facilitator to init the application
    |
    */

    require_once 'system/bootstrap.php';


    /*
    |--------------------------------------------------------------------------
    | Run the application
    |--------------------------------------------------------------------------
    |
    | Once application is successfully bootstrapped, run the application
    |
    */
    $app->run();



