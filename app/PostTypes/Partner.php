<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;


class Partner extends Plugin {

  private $posttype="partner";
  // private $taxslugs =['partner-type','country'];
  private $taxslugs =['partner-type','country','macro-region', 'for-maps-only'];


  public function __construct() {
    add_action( 'init', array($this,'load_cpts') );
    add_action( 'init', array($this,'add_tax') );
    add_action( 'cmb2_init', array($this,'add_taxonomy_metabox') );
    /* disable gutenberg */
    // add_filter( 'use_block_editor_for_post_type', array($this,'disable_gutenberg_for_posttype'), 10, 2 );
  }

  public function add_tax() {
    $taxslugs = $this->taxslugs;
    $pt = $this->posttype;
    foreach ($taxslugs as $tax) {
      register_taxonomy_for_object_type($tax,$pt);
    }
  }



  /* add a cmb2 meta box to term/ taxonomy partner-type
  its the color box
   */
  function add_taxonomy_metabox(){
    $args = [
    'id'           => 'type_color',
    'object_types' => [ 'term' ],
    'taxonomies'   => [ 'partner-type' ]
  ];

    $cmb_fields = new_cmb2_box( $args );
    $cmb_fields->add_field( [
      'name'    => 'Color',
      'id'      => 'partner_type_color',
      'type'    => 'colorpicker',
      'default' => '',
      'attributes' => array(
          'data-colorpicker' => json_encode( array(
              // Iris Options set here as values in the 'data-colorpicker' array
              'palettes' => array( '#3dd0cc', '#ff834c', '#4fa2c0', '#0bc991', ),
          ) ),
      ),

    ] );

  }

  /**
 * Disabling the Gutenberg editor for post type
 *
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
      'description' => __( 'Partner', 'yours' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
      'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
      'rewrite'  => array( 'slug' => 'partner', 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => false, /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      'show_in_rest' => true, // For Gutenberg to work in a Custom Post Type you need to enable both 'show_in_rest' and supportys => editor
      /* the next one is important, it tells what's enabled in the post editor */
       /* 
      'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
     */
      /* make sure to have custom-fields on... this is required for all meta */
      'supports' => array( 'title', 'editor','thumbnail', 'revisions' , 'custom-fields'),
      'taxonomies' => array('country','partner-type','abc','def'),
    


      'admin_cols' => array(
        'featured_image' => array(
          'title'          => 'Featured Image',
          'featured_image' => 'thumbnail'
        ),
        'title',
        'abbr' => array(
          'title' => 'Abbr',
          'meta_key' => 'partner_abbr',
          'default' => 'ASC',
        ),
        'type' => array(
          'taxonomy' => 'partner-type'
        ),
        'country' => array(
          'taxonomy' => 'country'
        ),
          'macroregion' => array(
            'title'=> "Macro Region",
            'taxonomy' => 'macro-region'
          ),
        'consortium' => array(
          'title' => 'Is Consortium Partner?',
          'meta_key' => 'partner_is_cons',
          'cap'      => 'manage_options',
        ),
        //  'num_in_map' => array(
        //   'title' => 'No# in Map',
        //   'meta_key' => 'casestudy_number',
        //   'cap'      => 'manage_options',
        // ),
        'date' => array(
          'title' => 'Date',
          'default' => 'ASC',
        ),
        'author' => array(
          'title' => 'Author',
        ),
      ),
    ), 
    // lables / names
    array(
      'singular' => __( 'Partner',  self::$textdomain),
      'plural'   => __( 'Partners', self::$textdomain ),
      'slug'   => __( 'partner', self::$textdomain ),
    )

  ); /* end of register post type */


  }



}
