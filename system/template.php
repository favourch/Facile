<?php
/*
 * Template class of Facile PHP Templating project
 * @author sharif <hello@sharif.co>
 * @link   http://www.sharif.co
 * @filesource system/template.php
 *
 */
namespace Sharif\Facile;


class template {

    /*
   |--------------------------------------------------------------------------
   | Class properties
   |--------------------------------------------------------------------------
   |
   | @var $template_data: Array to collect templates variables assigned via
   |                      magic method set.
   |
   */

    private  $template_data = [],
             $template="";



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

        //Define the current theme that will be in use

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
} 