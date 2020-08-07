<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;


class Team extends Plugin {

  private $posttype="team";
  // private $taxslugs = ['team-cat','language'];
  private $taxslugs = ['team-cat','language','macro-region', 'for-maps-only'];

  public function __construct() {
  
    add_action( 'init', array($this,'load_cpts') );
    add_action( 'init', array($this,'add_tax') );
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
      'description' => __( 'For Abma./Team', 'yours' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
      'menu_icon' => 'dashicons-marker', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) https://www.kevinleary.net/wordpress-dashicons-list-custom-post-type-icons/ */
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
      // 'taxonomies' => array('team-cat'),
       // 'taxonomies' => array('category','team-cat'),
      /* for gutenberg block templates 
      https://www.billerickson.net/gutenberg-block-templates/
      */
      // 'template'            => array( array( 'core/quote', array( 'className' => 'is-style-large' ) ) ),
      // 'template_lock'      => 'insert', // 'template_lock' => 'insert'

      /* gutenberg template*/
      "template" => array(
          array('liaison/teamtemplate'),
          array( 'core/columns', array(
            "className" => "wp-fakeblock wide",
            "align" => "wide"
          ), array(
              array( 'core/column', array( "className" => "half",), array(
                  array( 'core/paragraph', ["placeholder"=>"address or contact"]),
              ) ),
              array( 'core/column', array("className" => "half"), array(
                  array( 'core/image', array() ),

              ) ),
          ) )
      ),
    

      'admin_cols' => array(
        'featured_image' => array(
          'title'          => 'Featured Image',
          'featured_image' => 'thumbnail'
        ),
        'title',
        'ID',
        'teamcat' => array(
          'taxonomy' => 'team-cat'
        ),
      
        'date' => array(
          'title' => 'Date',
          'default' => 'ASC',
        ),
        'lang' => array(
            'title'=> "Language",
            'taxonomy' => 'language'
          ),
          'translationid' => array(
            'title'=> "Translation Base ID",
            'meta_key' => 'translation_id',
          ),
        'macroregion' => array(
            'title'=> "Macro Region",
            'taxonomy' => 'macro-region'
        ),
      ),
     
      ), 

      array(
        'singular' => __( 'Amba/Team',  self::$textdomain),
        'plural'   => __( 'Amba/Team', self::$textdomain ),
        'slug'   => __( 'abmassadors', self::$textdomain ),
      )

  ); /* end of register post type */
      


  }


}
