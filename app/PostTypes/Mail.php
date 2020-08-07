<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;

class Mail extends Plugin {

  private $posttype="mail";

  public function __construct() {
    // $this->block_init();
    add_action( 'init', array($this,'load_cpts') );
    add_action( 'admin_init', array($this,'add_id_to_admin_listing') );
    /* disable gutenberg */
    add_filter( 'use_block_editor_for_post_type', array($this,'disable_gutenberg_for_posttype'), 10, 2 );
  }


 function add_id_to_admin_listing() {
    $posttype = $this->posttype;
    add_filter("manage_{$this->posttype}_posts_columns", function($defaults) {
      $defaults['yours_post_id'] = __('ID');
      return $defaults;
    }, 5);
    add_action("manage_{$this->posttype}_posts_custom_column", function($column_name, $id) {
      if($column_name === 'yours_post_id'){
        echo $id;
      }
    }, 5, 2);
  }

 

  /**
 * Disabling the Gutenberg editor for post type
 */
function disable_gutenberg_for_posttype( $can_edit, $post_type ) {
  if ( $post_type === $this->posttype  ) {
    $can_edit = false;
  }
  return $can_edit;
}


  /**
   * Load CPT and Taxonomies on WordPress
   *
   * @return void
   */
  public function load_cpts() {

    $name = $this->posttype;
    // Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
    $tax = register_extended_post_type( $name, array(
    
    // let's now add all the options for this post type
      'description' => __( 'Mail', 'yours' ), /* Custom Type Description */
      'public' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
      'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
      'rewrite'  => array( 'slug' => $name, 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => false, /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      'show_in_rest' => false, // For Gutenberg to work in a Custom Post Type you need to enable both 'show_in_rest' and supportys => editor
      // 'taxonomies' => array('category',$name.'-splits'),
       // 'taxonomies' => array('category',$name.'-cat'),
      /* the next one is important, it tells what's enabled in the post editor */
       /* 
      'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
     */
      /* make sure to have custom-fields on... this is required for all meta */
      'supports' => array( 'title' ), 
      'admin_cols'       => array(
         'is_in_toolbox' => array(
          'title' => 'Displayed Text',
          'meta_key' => 'mail_display_text',
        ),
       ),

      
    ),
    // lables / names
      array(
        'singular' => __( 'Mail',  self::$textdomain),
        'plural'   => __( 'Mails', self::$textdomain ),
        'slug'   => __( 'mail', self::$textdomain ),
      )

    ); /* end of register post type */



   

  }


}
