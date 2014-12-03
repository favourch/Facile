<?php
/*
 * facile class or the Facile PHP Templating project
 * @author sharif <hello@sharif.co>
 * @link   http://www.sharif.co
 * @filesource system/functions.php
 *
 */


/*
|--------------------------------------------
| post(); Function
|--------------------------------------------
|
| Gets the value of $_POST[$var] or empty
|
*/

function post($var)
{
    if(isset($_POST[$var]))
    {
        return $_POST[$var];
    }

    return '';
}



/*
|--------------------------------------------
| get(); Function
|--------------------------------------------
|
| Get the value of $_GET[$var] or empty
|
*/

function get($var)
{
    if(isset($_GET[$var]))
    {
        return $_GET[$var];
    }

    return '';
}


/*
|--------------------------------------------
| facile_Check(); Function
|--------------------------------------------
|
| Checks if given file exists and is readable
|
*/

function facile_check($path)
{
   if(file_exists($path) && is_readable($path))
   {
       return true;
   }

    return false;
}



/*
|--------------------------------------------
| facile_readable_dir(); Function
|--------------------------------------------
|
| Check if path is a directory and is not a
| file and is readable
|
*/


function facile_readable_dir($path)
{
    if(is_dir($path) && !is_file($path) && is_readable($path))
    {
        return true;
    }

    return false;
}



/*
|--------------------------------------------
| Facile_readable_file(); Function
|--------------------------------------------
|
| Checks is path is a file and is readable and
| the path is not a directory
|
*/

function facile_readable_file($path)
{
    if(is_file($path) && !is_dir($path) && is_readable($path))
    {
        return true;
    }

    return false;
}



/*
|--------------------------------------------
| Facile_get_file(); Function
|--------------------------------------------
|
| Require in the file if it exists and is
| readable
|
*/

function facile_get_file($path, $fallback=null)
{
    if(facile_check($path))
    {
        return require_once $path;
    }

    return $fallback;
}


/*
|--------------------------------------------
| Get_base_uri(); function
|--------------------------------------------
|
| Returns the base URI of the script with
| right slash is trimmed off.
|
*/

function get_base_uri()
{
    return filter_var(rtrim($_SERVER['SCRIPT_NAME'],'index.php'), FILTER_SANITIZE_URL);
}



/*
|--------------------------------------------
| get_facile_query_string(); Function
|--------------------------------------------
|
| Returns the uri query string
|
*/

function get_facile_query_string($fallback=[])
{
    $url = filter_var(rtrim($_SERVER['QUERY_STRING'], '/'), FILTER_SANITIZE_URL);
    $qs = explode('=', $url);
    if (count($qs) == 2)
        return explode('/', $qs[1]);
    else
        return $fallback;
}


/*
|--------------------------------------------
| is_facile_theme_dir(); function
|--------------------------------------------
|
| Checks if given path is a valid facile theme
| directory and has required theme contents
|
*/

function is_facile_theme_dir($path)
{
    $err=0;

    $facile_theme =['default.php','/css','/js','/img','/css/styles.css','/errors','/errors/404.php'];

    foreach($facile_theme as $req)
    {
        if(!is_readable($path.$req))
        {
           $err ++;
        }
    }

   if($err=0)
   {
       return true;
   }

    return false;


}

/*
|--------------------------------------------
| link_to_asset(); function
|--------------------------------------------
|
| Imports assets like stylesheet and javascript
| into the facile pages.
|
*/
function link_to_asset($type, $assets=[], $fallback=null)
{
    $asset_type = strtolower($type);

    //Where to start the counter for generating automatic directory separators
    $start = defined("AT_403_ON_DIR") ? 0 : 1;

    switch($asset_type)
    {

        case 'css':
            $css="<!--Facile assets auto-dump: Stylesheet //-->".PHP_EOL;
            if(count($assets) >=1){
                foreach($assets as $asset)
                {

                    #ONLY INCLUDE ASSET IF EXISTS TO ELIMINATE 404 ERRORS
                    if(facile_check(CURRENT_THEME_DIR.$asset)) {
                        //Generate separator tp link asset from relative path from current uri
                        $uri = count(get_facile_query_string());
                        $separator="";
                        for($i=$start; $i<$uri; $i++)
                        {
                            $separator.="../";
                        }


                        $css .= '<link rel="stylesheet" href="' . $separator .'assets/'.CURRENT_THEME_NAME.'/'.$asset . '">' . PHP_EOL;
                    }
                }
            }
            return $css;
        case 'js':
            $js="<!--Facile assets auto-dump: JavaScript  //-->".PHP_EOL;
            if(count($assets) >=1)
            {
                foreach($assets as $asset)
                {
                    if(facile_check(CURRENT_THEME_DIR.$asset))
                    {
                        //Generate separator tp link asset from relative path from current uri
                        $uri = count(get_facile_query_string());
                        $separator="";
                        for($i=$start; $i<$uri; $i++)
                        {
                            $separator.="../";
                        }
                        $js.='<script src="'.$separator.$asset.'"> </script>'.PHP_EOL;
                    }
                }
            }
            return $js;
    }
    return $fallback;
}

/*
|--------------------------------------------
| include_facile() function
|--------------------------------------------
|
| Function that will include view partial e.g.
| header, footer and other parts,
| this function can be created in the themes
| file therefore if that is created than
| that will be used instead.
|
*/

if(!function_exists('include_facile'))
{
    /**
     * @param $partial
     * @param array $params
     * @param null $fallback
     * @return mixed|null
     */
    function include_facile($partial, $params = [], $fallback = null)
    {
        //Request require file
        $request =CURRENT_THEME_DIR.facile_whitespace_slashes(PARTIAL_DIR).DS. strtolower($partial) . EXT;

        switch ($partial) {
            case $partial:
                if(strtolower($partial)=="header") {
                    $title              = isset($params['title'])               ? $params['title']              : SITE_NAME;
                    $meta_description   = isset($params['meta_description'])    ? $params['meta_description']   : SITE_DESCRIPTION;
                    $meta_keywords      = isset($params['meta_keywords'])       ? $params['meta_keywords']      : SITE_KEYWORDS;
                }elseif(strtolower($partial)=="sidebar") {
                    $sidebar_title      = isset($params['sidebar_title'])       ? $params['sidebar_title']      : "";
                    $sidebar_content    = isset($params['sidebar_content'])     ? $params['sidebar_content']    : "";
                } elseif(strtolower($partial)=="widgets"){
                    $widget_title       = isset($params['widget_title'])        ? $params['widget_title']       : "";
                    $widget_content     = isset($params['widget_content'])      ? $params['widget_content']     : "";
                }
                return facile_check($request) ? require_once $request: $fallback;
        }
        return $fallback;
    }
}



/*
|--------------------------------------------
| get_theme_config(); function
|--------------------------------------------
| get current theme configuration file
|
*/


function get_theme_config($format, $fallback=false)
{
    $config = defined('THEME_CONFIG_FILE') ? include_once THEME_CONFIG_FILE : null;

    if($config)
    {
        switch($format)
        {
            case 'obj':
                return json_decode($config);
            case 'array':
                return json_decode($config, true);
            case 'json':
                return $config;
        }
    }


    return $fallback;

}


/*
|--------------------------------------------
| Redirect_to(); function
|--------------------------------------------
| Redirects throughout the application and
| renders error pages
|
*/


function Redirect_to($location)
{
    if($location)
    {
        if(is_numeric($location))
        {
            $template = new \Sharif\Facile\facile();

            switch($location)
            {
                case '404':
                    header('HTTP/1.0 404 File Not Found');
                    $template->title = "Error 404 File Not Found";
                    $template->header = "404";
                    $template->body ="Woops, page not found.";

                    $template->make('errors/default');

                    exit;

                case '403':
                    header('HTTP/1.0 403 Forbidden');
                    $template->title = "Error 403 Forbidden Access";
                    $template->header = "403";
                    $template->body = "Woops, you're totally forbidden from here";

                    $template->make('errors/default');

                    exit;

            }
        }else{
            header("location: {$location}");
            exit;
        }
    }
    return false;
}

/*
|--------------------------------------------
| facile_whitespace_slashes; function
|--------------------------------------------
| Redirects throughout the application and
| renders error pages
|
*/

function facile_whitespace_slashes($var)
{
    return trim($var,"\x00..\x20/");
}


## GET FACILE ASCII ART ###
function get_facile_ascii_art()
{
    return <<<FACILEASCII
    <!--
    This website is powered by Facile
         ___       __          ___
        |__   /\  /  ` | |    |__
        |    /~~\ \__, | |___ |___

    http://github.com/sp01010011/facile
    /-->
FACILEASCII;
}


