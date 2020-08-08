<?php
namespace Yours\Plugin;

class Plugin
{
    private static $instance;
    public static $requirements;
    public static $textdomain;
    public static $config;

    public static function instance($requirements = array(), $textdomain = "yours")
    {

        if (!isset(self::$instance) && !(self::$instance instanceof Plugin)) {
            self::$instance     = new Plugin;
            self::$requirements = $requirements;
            self::$textdomain   = $textdomain;
            add_action('plugins_loaded', array(self::$instance, 'load_plugin'));
        }

        return self::$instance;

    }

    /**
     * Load plugin classes - Modify as needed, remove features that you don't need.
     *
     * @since 0.2.0
     */
    public function load_plugin()
    {

        if (!$this->verify_dependencies()) {
            return;
        }

        // Add Customizer panels and options
        // new Settings\Customizer_Options();

        // Enqueue scripts and stylesheets, all for backend functionality only
        // new EnqueueScripts();

        /* taxonomies */
        // new Tax\Taxes();

        /* custom post types */
        new PostTypes\Team();

        /* metaboxes */
        new Metaboxes\Team();

        /* quick edit admin columns */
        new AdminColumns\NumberInMap();

        /* rest api endpoints*/
        // new Endpoints\All();

        /* gutenberg blocks*/
        // new Blocks\AllBuildBlocks();
        // new Blocks\Team();

        /* widgets */
        // new Widgets\Widget_Loader();

        /* shortcodes */
        new Shortcodes\Shortcode_Loader();

    }

    /**
     * Function to verify dependencies
     *
     * @param bool $die If true, plugin execution is halted with die(), useful for
     *    outputting error(s) in during activate()
     * @return bool
     * @since 0.2.0
     */
    private function verify_dependencies($die = false, $activate = false)
    {

        // Check if underDEV_Requirements class is loaded
        if (!class_exists('underDEV_Requirements')) {
            if ($die) {
                die('MU-Plugin "yours" needs an plugin called "underDEV_Requirements" which is required to check other dependencies');
            } else {
                return false;
            }
        }

        $requirements = new \underDEV_Requirements("Yours Master Plugin", self::$requirements);
        // Display errors if requirements not met
        if (!$requirements->satisfied()) {
            if ($die) {
                die($requirements->notice());
            } else {
                add_action('admin_notices', array($requirements, 'notice'));
                return false;
            }
        }

        return true;

    }

}
