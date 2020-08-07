<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;

class  Links extends Plugin {


  /* Country tax is already added by an other CPT. */
  private $posttype="links";
  private $taxslugs =['doctype','language', 'thema','country'];


  public function __construct() {
    add_action( 'init', array($this,'load_cpts') );
    add_action( 'init', array($this,'add_tax') );

        // add_action( 'init', array($this,'admin_columns') );
  }


  public function add_tax() {
    $taxslugs = $this->taxslugs;
    $pt = $this->posttype;
    foreach ($taxslugs as $tax) {
      register_taxonomy_for_object_type($tax,$pt);
    }
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
      'description' => __( 'Links', 'yours' ), /* Custom Type Description */
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
      /* the next one is important, it tells what's enabled in the post editor */
       /* 
      'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
     */
      /* make sure to have custom-fields on... this is required for all meta */
      'supports' => array( 'title', 'custom-fields' ), 
      'admin_cols'       => array(
         'description' => array(
          'title' => 'Description',
          'meta_key' => 'description',
        ),
        'country' => array(
          'taxonomy' => 'country',
        ),
        'doctype' => array(
          'taxonomy' => 'doctype',
        ),
        'language' => array(
          'taxonomy' => 'language',
        ),
        'thema' => array(
          'taxonomy' => 'thema',
        ),
        'date' => array(
          'title' => 'Date',
          'default' => 'ASC',
        ),
        'is_in_toolbox' => array(
          'title' => 'Is in Toolbox',
          'meta_key' => 'is_in_toolbox',
          'default' => 'ASC',
        ),
     ),
    ),
    // lables / names
      array(
        'singular' => __( 'Link',  "yours"),
        'plural'   => __( 'Links', "yours" ),
        'slug'   => __( 'Link', "yours" ),
      )

    ); /* end of register post type */




  }




 


}
