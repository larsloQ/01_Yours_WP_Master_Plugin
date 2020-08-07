<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;
// use Carbon_Fields\Container;
// use Carbon_Fields\Field;
use PostTypes\PostType;
use WPBP\CPT_COLUMNS\CPT_columns as CPT_columns;
use WP_CUSTOM_BULK_ACTIONS\Seravo_Custom_Bulk_Action as Seravo_Custom_Bulk_Action;

/* LFK 2019-12-22_14.12.37:
  register post types. 
  !!!! when using custom-fields (meta_fields) inside of Blocks, dont forget to set supports => custom_fields

  also here you can set admin views for listings in backend. not much docs about this but its working and see to 2 namespaces/plugins above for diving in

  see 
*/

class Template extends Plugin {

  private $posttype="NAME__SLUG";


  public function __construct() {
    add_action( 'init', array($this,'load_cpts') );
    add_action( 'init', array($this,'gutenberg_register_meta') );
    add_filter( 'use_block_editor_for_post_type', array($this,'disable_gutenberg_for_posttype'), 10, 2 );
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



/* 
make sure to call this AFTER CPT definition
these meta fields can be bound to block attributes 
see js block definition

make sure that these are in rest. you can do this by request the rest api endpoint of the post
i.e:
sitename.com/wp-json/wp/v2/POST_TYPE?slug=post-slug
or 
larslo.larslo/liaison/wp-json/wp/v2/team?id=212

in console you can access post data like so:
wp.data.select( 'core/editor' ).getCurrentPost().meta;
*/
function gutenberg_register_meta () {
  register_post_meta( $this->posttype, 'team_member_institution', array(
    'type'         => 'number',
    'single'       => true,
    'show_in_rest' => true,
  ) );
}



  /**
   * Load CPT and Taxonomies on WordPress
   *
   * @return void
   */
  public function load_cpts() {


    // Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
    $tax = register_extended_post_type( $this->posttype, array(
    
    // let's now add all the options for this post type
      'description' => __( 'For Abma./Team', 'yours' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
      'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
      'rewrite'  => array( 'slug' => 'abmassadors', 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => false, /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      'show_in_rest' => true, // For Gutenberg to work in a Custom Post Type you need to enable both 'show_in_rest' and supportys => editor
      /* the next one is important, it tells what's enabled in the post editor */
       /* 
      'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
     */
      /* make sure to have custom-fields on... this is required for all meta */
      'supports' => array( 'title', 'thumbnail','editor', 'revisions', 'custom-fields'),
      'taxonomies' => array('team-cat'),
       // 'taxonomies' => array('category','team-cat'),
      /* for gutenberg block templates 
      https://www.billerickson.net/gutenberg-block-templates/
      */
      // 'template'            => array( array( 'core/quote', array( 'className' => 'is-style-large' ) ) ),
      // 'template_lock'      => 'all', // 'template_lock' => 'insert'

      /* gutenberg template*/
      // "template" => array(
      //     array( 'core/columns', array(
      //       "id"=>"main"
      //     ), array(
      //         array( 'core/column', array(), array(
      //             array( 'core/heading', array( 'level' => '2', 'placeholder' => 'Institution', 
      //               "className"=>"serif"
      //              ) ),
      //             array( 'core/heading', array( 'level' => '1', 'placeholder' => 'Name' ) ),
      //             array( 'core/paragraph' ),
      //         ) ),
      //         array( 'core/column', array(), array(
      //             array( 'core/image', array() ),
      //         ) ),
      //     ) )
      // ),
      //  "template" => array(
      //     array( 'carbon-fields/team-default', array() ), 
      // ),


      'admin_cols' => array(
        'featured_image' => array(
          'title'          => 'Featured Image',
          'featured_image' => 'thumbnail'
        ),
        'title',
        'genre' => array(
          'taxonomy' => 'demo-section'
        ),
        'custom_field' => array(
          'title' => 'By Lib',
          'meta_key' => '_demo_text',
          'cap'      => 'manage_options',
        ),
        'date' => array(
          'title' => 'Date',
          'default' => 'ASC',
        ),
      ),
      # Add a dropdown filter to the admin screen:
      'admin_filters' => array(
        'genre' => array(
          'taxonomy' => 'team-cat'
        )
      )
      ), 
    // lables / names
      array(
        'singular' => __( 'Amba/Team',  self::$textdomain),
        'plural'   => __( 'Amba/Team', self::$textdomain ),
        'slug'   => __( 'abmassadors', self::$textdomain ),
      )

  ); /* end of register post type */
      

  

    $tax->add_taxonomy( $name.'-cat', array(
     'hierarchical' => false,
     'show_ui' => false,
    ) );
    // Create Custom Taxonomy https://github.com/johnbillion/extended-taxos
    register_extended_taxonomy( $name.'-cat', $name, array(
     // Use radio buttons in the meta box for this taxonomy on the post editing screen:
     'meta_box'         => 'radio',
     // Show this taxonomy in the 'At a Glance' dashboard widget:
     'dashboard_glance' => true,
     // Add a custom column to the admin screen:
     'admin_cols'       => array(
       'featured_image' => array(
         'title'          => 'Featured Image',
         'featured_image' => 'thumbnail'
       ),
     ),
     'slug'             => 'story-cat',
     'show_in_rest'     => true,
    ), array(
     // Override the base names used for labels:
     'singular' => __( 'story Category', self::$textdomain ),
     'plural'   => __( 'story Categories', self::$textdomain ),
    )
    );

  }



  /* add admin columns*/
  function admin_columns () {

    // Hide unnecessary publishing options like Draft, visibility, etc.
    // add_action( 'admin_head-post.php', array( $this, 'hide_publishing_actions' ) );
    // add_action( 'admin_head-post-new.php', array( $this, 'hide_publishing_actions' ) );
    /*
     * Custom Columns
     */
    $post_columns = new CPT_columns( 'story' );
    $post_columns->add_column( 'cmb2_field', array(
       'label'    => __( 'CMB2 Field', self::$textdomain ),
       'type'     => 'post_meta',
       'meta_key' => '_story_' . self::$textdomain . '_text',
       'orderby'  => 'meta_value',
       'sortable' => true,
       'prefix'   => '<b>',
       'suffix'   => '</b>',
       'def'      => 'Not defined', // Default value in case post meta not found
       'order'    => '-1',
     )
    );
    //  * Custom Bulk Actions
    $bulk_actions = new Seravo_Custom_Bulk_Action( array( 'post_type' => 'story' ) );
    $bulk_actions->register_bulk_action(
     array(
       'menu_text'    => 'Mark meta',
       'admin_notice' => 'Written something on custom bulk meta',
       'callback'     => function( $post_ids ) {
         foreach ( $post_ids as $post_id ) {
           update_post_meta( $post_id, '_story_' . self::$textdomain . '_text', 'Random stuff' );
         }

         return true;
       },
     )
    );
    $bulk_actions->init();
    // Add bubble notification for cpt pending
    // add_action( 'admin_menu', array( $this, 'pending_cpt_bubble' ), 999 );
    add_filter( 'pre_get_posts', array( $this, 'filter_search' ) );

  }



  /**
   * Add support for custom CPT on the search box
   *
   * @param object $query Wp_Query.
   *
   * @since 1.0.0
   *
   * @return object
   */
  public function filter_search( $query ) {
    if ( $query->is_search && !is_admin() ) {
      $post_types = $query->get( 'post_type' );
      if ( $post_types === 'post' ) {
        $post_types = array( $post_types );
        $query->set( 'post_type', array_push( $post_types, array( 'story' ) ) );
      }
    }

    return $query;
  }

}
