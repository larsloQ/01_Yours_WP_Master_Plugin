<?php
namespace Yours\Plugin\Settings;
use Yours\Plugin\Plugin;


class Parents_Settings_Page extends Plugin {

  
  private static $instructions = "
    <p>For the Breadcrumps to work on these Posttypes, set its parent page ID here</p>
  ";


  private static $posttypes_with_url = ["team","casestudy","partner"];
  private static $posttypes_with_url_names = ["Ambassadors","Case-Studies","Partner"];

  public function __construct() {
    add_action( 'cmb2_admin_init', array(__CLASS__, 'add_settings_page') );
    // add_action('wp_enqueue_scripts', array(__CLASS__, 'append_script') , 998);
  }

  
    static function add_settings_page()
  {
    $cmb_options = new_cmb2_box( array(
    'id'           => 'parents_for_posttypes',
    'title'        => esc_html__( 'Set Parents for Types', 'yours' ),
    'object_types' => array( 'options-page' ),

    /*
     * The following parameters are specific to the options-page box
     * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
     */

    'option_key'      => 'parents_for_posttypes', // The option key and admin menu page slug.
    // 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
    'icon_url'        => 'dashicons-welcome-learn-more', // Menu icon. Only applicable if 'parent_slug' is left empty.
    'menu_title'      => esc_html__( 'Parents for Types', 'yours' ), // Falls back to 'title' (above).
    'parent_slug'     => 'options-general.php', // Make options page a submenu item of the themes menu. Comment it out to have a main menu item 
    'capability'      => 'manage_options', // Cap required to view options-page.
    'position'        => 1000, // Menu position. Only applicable if 'parent_slug' is left empty.
    // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
    // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
    // 'save_button'     => esc_html__( 'Save Theme Options', 'yours' ), // The text for the options-page save button. Defaults to 'Save'.
  ) );
    $cmb_options->add_field( array(
        'name' => __( $posttypes_with_url_names[$count], 'yours' ),
        'before_row'     => self::$instructions,
        'desc' => __( "", 'yours' ),
        'id'   => 'parentpageinstructions',
        'type' => '',
      ) );

    $count = 0;
    foreach (self::$posttypes_with_url as $pt) {
      $cmb_options->add_field( array(
        'name' => __( self::$posttypes_with_url_names[$count], 'yours' ),
        'id'   => 'parentpage_'.$pt,
        'type' => 'text',
      ) );
      $count++;
    }



  }
}
