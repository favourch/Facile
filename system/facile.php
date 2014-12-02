<?php
/*
 * facile class or the Facile PHP Templating project
 * @author sharif <hello@sharif.co>
 * @link   http://www.sharif.co
 * @filesource system/facile.php
 *
 */


namespace Sharif\Facile;

class facile {

    /*
    |--------------------------------------------------------------------------
    | Class properties
    |--------------------------------------------------------------------------
    |
    | @var $page: holds default page to load if no page is requested
    | @var $template: holds the current template directory for the page
    | @var $home_filter: holds list of filter referred to as home
    |
    */

    private $page = 'index',
            $template ="",
            $template_data = [];


    /*
    |--------------------------------------------------------------------------
    | Run method instantiates ths system
    |--------------------------------------------------------------------------
    |
    | The run method calls the dispatch() method and load the application
    |
    */

    public function run()
    {

        return $this->dispatch();

    }


    /*
    |--------------------------------------------------------------------------
    | Dispatch method
    |--------------------------------------------------------------------------
    |
    | The dispatch method instantiates the the template and put together all
    | inner workings and bootstraps the application
    |
    */
    private function dispatch()
    {

        //Set the default page title if no title is defined in the data
        $this->title = SITE_NAME;

        //Set the default page meta description if no meta description is defined in the data
        $this->meta_description = SITE_DESCRIPTION;

        //Set default page keywords is no meta keywords are defined in the data
        $this->meta_keywords = SITE_KEYWORDS;



        $data = facile_get_file($this->route().EXT);

        //check to see if the page uses special template

        $user_page_template = isset($data['template']) ? $data['template'] : null;


        //Send each variable in the page to the template
        foreach($data as $data_key=>$data_value)
        {
            $this->$data_key=$data_value;
        }

        //Generate the view

       return  $this->make($user_page_template);

    }


     /*
     |--------------------------------------------------------------------------
     | Route method
     |--------------------------------------------------------------------------
     |
     | Prepares the uri
     |
     */


    private function route()
    {
        //Default page value

        $this->page = PAGES.$this->page;

        //Get the URI Array Values
        $url = $this->get_url();

        //Confirm that there is at array index
        if(count($url)>=1)
        {
            //Check to see if the first option set is directory if it is than check second option for being a file
            if(facile_readable_dir(PAGES.$url[0]))
            {

                //Check to see if url one is setup
                if(isset($url[1])){

                    //If it is setup explode by page extension
                    $eval_page_request = explode('.', facile_whitespace_slashes($url[1]));

                    //Make sure the exploded var is two part file and extension
                    if(count($eval_page_request)==2)
                    {

                        //Assign parts to a variables
                        $final_page = $eval_page_request[0];
                        $extension = $eval_page_request[1];

                        //Test to see if evaluated extension is equal to one in config
                        if($extension!=PAGE_EXTENSION)

                            //If the extension is not the same, this has happened in error send to 404
                            unset($url[1]);
                        else

                            //If the extension is the same as what is in config while than assign the file to the variable
                            $url[1] = $final_page;
                    }

                }

                //Set up the file to check
                $file = PAGES.$url[0].DS.@$url[1];


                //Since the first Index or the URI array is also a directory check is second index is set
                if(facile_readable_file($file.EXT))
                {

                    //Tested and confirmed assign the file to default page
                    $this->page = $file;

                    //Unset the found file from the array list
                    unset($url[1]);

                    //Also since a file is found unset the first array index as well
                    unset($url[0]);
                }

            }


            /*----------------------------------
            |       THROW ERROR 404            |
            | THE SHOULD BE NO $URL[1] HERE    |
            ----------------------------------*/

            if(isset($url[1]))
                return Redirect_to(404);


            //Check to see if the URL[0] is still set

            if(isset($url[0]))
            {

                //If it is setup explode by page extension
                $eval_page_request = explode('.', facile_whitespace_slashes($url[0]));

                //Make sure the exploded var is two part file and extension
                if(count($eval_page_request)==2)
                {

                    //Assign parts to a variables
                    $final_page = $eval_page_request[0];
                    $extension = $eval_page_request[1];

                    //Test to see if evaluated extension is equal to one in config
                    if($extension==PAGE_EXTENSION) {
                        //If the extension is the same as what is in config while than assign the file to the variable
                        $url[0] = $final_page;
                    }


                }


                //We have learned url index 0 still set, lets check if this is a file
                $file = PAGES.$url[0];

                //Check for a existing and readable file
                if(facile_check($file.EXT))
                {

                    //If found a result assign the default page index 0
                    $this->page = $file;

                    //Unset index 0 in case we would like to do more checking in the future
                    unset($url[0]);
                }

            }

            /*----------------------------------
            |       THROW ERROR 404            |
            | THE SHOULD BE NO $URL[0] HERE    |
            ----------------------------------*/
            if(isset($url[0])) {

               // Only throw in the 404 error when the $url[0] is not empty
              //  Otherwise continue with default page

                if(!empty($url[0])){

                    if(is_dir(ROOT_DIR.$url[0]))
                    {
                        define('AT_403_ON_DIR',true);

                        return Redirect_to(403);
                    }

                    return Redirect_to(404);
                }


                //Terminate the url[0] here and continue with default page
                unset($url[0]);
            }

        }


    /*
    |--------------------------------------------------------------------------
    | RETURN PAGE LOCATION
    |--------------------------------------------------------------------------
    |
    | Request processing completed, return the request without the file
    | extension to the dispatch to be processed.
    |
    */
        return $this->page;

    }

    /*
    |--------------------------------------------------------------------------
    | Make() Method
    |--------------------------------------------------------------------------
    |
    | A method responsible for validating and generating request view template
    | from the current theme
    |
    */
    public function make($path=null)
    {

        //Initiate the template directory
        $template_dir = is_facile_theme_dir(ASSETS_DIR.THEME) ? THEME : 'simplex';

        //template to be used

        $this->template = ASSETS_DIR.$template_dir.DS;

        //Theme name used to grab only the name
        define('CURRENT_THEME_NAME', $template_dir);

        //Theme dir used for internal only
        define('CURRENT_THEME_DIR', $this->template);

        // Theme configuration file

        if($theme_config = facile_check(CURRENT_THEME_DIR.CURRENT_THEME_NAME.'.json'))
        {
            define('THEME_CONFIG_FILE', $theme_config);
        }

        // Send variable to the template

        foreach($this->template_data as $data=>$value)
        {
            $$data = $value;
        }

        if($path)
        {

            if(facile_check($this->template.$path.EXT))
            {

                return require_once $this->template . $path . EXT;
            }
        }


        return require_once $this->template.'default'.EXT;

    }


    /*
   |--------------------------------------------------------------------------
   | Static Render()
   |--------------------------------------------------------------------------
   |
   | Allows calling Facile view maker vi==
   |
   */

    public static function render($path)
    {
        return self::make($path);
    }


    /*
    |--------------------------------------------------------------------------
    | Magic Setter
    |--------------------------------------------------------------------------
    |
    | PHP magic method to set template variables
    |
    */

    public function __set($k, $v)
    {
        $this->template_data[$k] = $v;
    }


    /*
    |--------------------------------------------------------------------------
    | get_url method
    |--------------------------------------------------------------------------
    |
    | Parses the uri for the route method
    |
    */
    private function get_url()
    {
        return explode('/',filter_var(facile_whitespace_slashes(get('url')), FILTER_SANITIZE_URL));
    }


}