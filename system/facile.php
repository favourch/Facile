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
            $home_filter = ['index','/',''];



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
        //Instantiate Templates
        $this->template = new template();

        //Set the default page title if no title is defined in the data
        $this->template->title = SITE_NAME;

        //Set the default page meta description if no meta description is defined in the data
        $this->template->meta_description = SITE_DESCRIPTION;

        //Set default page keywords is no meta keywords are defined in the data
        $this->template->meta_keywords = SITE_KEYWORDS;



        $data = facile_get_file($this->route().EXT);

        //check to see if the page uses special template

        $user_page_template = isset($data['template']) ? $data['template'] : null;


        //Send each variable in the page to the template
        foreach($data as $k=>$v)
        {
            $this->template->$k=$v;
        }

        //Generate the view

       return  $this->template->make($user_page_template);

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



            //Check to see if the URL[0] is still set

            if(!empty($url[0]))
            {


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

        }

        //Return the full path of the requested and confirmed page without the file extension.
        return $this->page;

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
        return explode('/',filter_var(rtrim(get('url'),'/'), FILTER_SANITIZE_URL));
    }


} 