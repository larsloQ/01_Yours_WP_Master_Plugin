<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;

class Glossary extends Plugin {

  private $posttype="glossary";
  private $taxslugs =['glossary-splits'];


  public function __construct() {
    // $this->block_init();
    add_action( 'init', array($this,'load_cpts') );
      add_action( 'init', array($this,'add_tax') );
    /* disable gutenberg */
    add_filter( 'use_block_editor_for_post_type', array($this,'disable_gutenberg_for_posttype'), 10, 2 );
  }

  public function add_tax() {
    $taxslugs = $this->taxslugs;
    $pt = $this->posttype;
    foreach ($taxslugs as $tax) {
      register_taxonomy_for_object_type($tax,$pt);
    }
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
      'description' => __( 'Glossary', 'yours' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
      'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
      'rewrite'  => array( 'slug' => $name, 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => false, /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      'show_in_rest' => true, // For Gutenberg to work in a Custom Post Type you need to enable both 'show_in_rest' and supportys => editor
      // 'taxonomies' => array('category',$name.'-splits'),
       // 'taxonomies' => array('category',$name.'-cat'),
      /* the next one is important, it tells what's enabled in the post editor */
       /* 
      'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
     */
      /* make sure to have custom-fields on... this is required for all meta */
      'supports' => array( 'title', 'editor','revisions' ), 
      'admin_cols'       => array(
        'splits' => array(
          'taxonomy' => $name.'-splits'
        ),
        'date' => array(
          'title' => 'Date',
          'default' => 'ASC',
        ),
         'author' => array(
          'title' => 'Author',
        ),
     ),
      # Add a dropdown filter to the admin screen:
      'admin_filters' => array(
         'splits' => array(
          'taxonomy' => $name.'-splits'
        ),
      ),
    ),
    // lables / names
      array(
        'singular' => __( 'Glossary',  self::$textdomain),
        'plural'   => __( 'Glossary', self::$textdomain ),
        'slug'   => __( 'glossary', self::$textdomain ),
      )

    ); /* end of register post type */



   

  }


}
