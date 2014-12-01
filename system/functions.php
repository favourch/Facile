<?php
/*
 * facile class or the Facile PHP Templating project
 * @author sharif <hello@sharif.co>
 * @link   http://www.sharif.co
 * @filesource system/functions.php
 *
 */
//check $_POST
function post($var)
{
    if(isset($_POST[$var]))
    {
        return $_POST[$var];
    }

    return '';
}


//Check $_GET
function get($var)
{
    if(isset($_GET[$var]))
    {
        return $_GET[$var];
    }

    return '';
}


//Check if file_exist and is readable

function facile_check($path)
{
   if(file_exists($path) && is_readable($path))
   {
       return $path;
   }

    return false;
}

//check if its directory and not file and is readable

function facile_readable_dir($path)
{
    if(is_dir($path) && !is_file($path) && is_readable($path))
    {
        return true;
    }

    return false;
}


//Check if is file and not directory and is readable

function facile_readable_file($path)
{
    if(is_file($path) && !is_dir($path) && is_readable($path))
    {
        return true;
    }

    return false;
}


//Include if file exist and is readable

function facile_get_file($path, $fallback=null)
{
    if(facile_check($path))
    {
        return require_once $path;
    }

    return $fallback;
}


/**
 * @return mixed
 */
function get_base_uri()
{
    return filter_var(rtrim($_SERVER['SCRIPT_NAME'],'index.php'), FILTER_SANITIZE_URL);
}



/**
 * @param array $fallback
 * @return array
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

/**
 * @param $path
 * @return bool
 */
function is_facile_theme_dir($path)
{
    $err=0;
    $facile_theme =[
        'default.php',
        '/css',
        '/js',
        'img',
        '/css/styles.css'
    ];

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

/**
 * Function to replace class link_to_asset, that will load public assets
 * @param $type
 * @param array $assets
 * @param null $fallback
 * @return null|string
 */
function link_to_asset($type, $assets=[], $fallback=null)
{
    $asset_type = strtolower($type);
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
                        for($i=1; $i<$uri; $i++)
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
                        for($i=0; $i<$uri; $i++)
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


/**
 * Function that will include view partial e.g. header, footer and other parts,
 * this function can be created in the themes file therefore if that is created than
 * that will be used instead.
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
        $request =CURRENT_THEME_DIR.trim(PARTIAL_DIR,'/').DS. strtolower($partial) . EXT;

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


//get current theme configuration file

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

