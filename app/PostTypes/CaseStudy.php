<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;


/* 
* Attention: This is also does "contribute" 
* Attention: This is also does "contribute" 
*/


class CaseStudy extends Plugin {

  private $posttype= array("casestudy","contribute");
  // private $taxslugs =[ 'casestudy-type','language'];
  private $taxslugs =[ 'casestudy-type','language','macro-region', 'for-maps-only'];
 

  public function __construct() {
    add_action( 'init', array($this,'load_cpts') );
    add_action( 'init', array($this,'add_tax') );
    /* quick edit nolink field for */
    add_action('quick_edit_custom_box',  array($this,'add_quick_edit'), 10, 2);
    add_action( 'save_post', array($this,'quickedit_save_post'), 10, 2 );
    add_action( 'admin_print_footer_scripts', array($this,'quickedit_javascript') );
    add_filter( 'post_row_actions', array($this,'quickedit_set_data'), 10, 2);
  }


  public function add_tax() {
    $taxslugs = $this->taxslugs;
    $pt = $this->posttype;
    foreach ($taxslugs as $tax) {
      register_taxonomy_for_object_type($tax,$pt[0]);
      register_taxonomy_for_object_type($tax,$pt[1]);
    }
  }

  /**
   * Load CPT and Taxonomies on WordPress
   *
   * @return void
   */
  public function load_cpts() {

    foreach ($this->posttype as $name) {
        // Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
        $tax = register_extended_post_type( $name, array(
        
        // let's now add all the options for this post type
          'description' => __( 'Case Study', 'yours' ), /* Custom Type Description */
         

          'public' => $name=="casestudy" ? true : false, // contributes have no public url
          'publicly_queryable' => $name=="casestudy" ? true : false, 
          // 'exclude_from_search' => $name=="casestudy" ? false : true,
          'exclude_from_search' => false,

          'show_ui' => true,
          'query_var' => true,
          'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */ 
          'menu_icon' => $name=="casestudy" ? 'dashicons-star-filled' :  'dashicons-post-status' , /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) see https://www.kevinleary.net/wordpress-dashicons-list-custom-post-type-icons/ */
          'rewrite'  => array( 'slug' => $name, 'with_front' => false ), /* you can specify its url slug */
          'has_archive' => false, /* you can rename the slug here */
          'capability_type' => 'post',
          'hierarchical' => false,
          'show_in_rest' => true, // For Gutenberg to work in a Custom Post Type you need to enable both 'show_in_rest' and supportys => editor
          /* the next one is important, it tells what's enabled in the post editor */
           /* 
          'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
         */
          /* make sure to have custom-fields on... this is required for all meta https://stackoverflow.com/questions/54952244/gutenberg-custom-meta-blocks-not-saving-meta-to-custom-post-type*/
          'supports' => $name=="casestudy" ? array( 'title', 'editor','revisions','thumbnail', 'custom-fields') : array( 'title', 'revisions','custom-fields'),
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
              'partner' => array(
                'title' => 'Partner',
                'meta_key' => 'casestudy_abbr',
                // 'cap'      => 'manage_options',
              ),
              // 'number' => array(
              //   'title' => 'Number in Map',
              //   'meta_key' => 'casestudy_number',
              //   // 'default' => 'ASC',
              // ),
              'nolink' => array(
                'title' => 'No Link from Maps',
                'meta_key' => 'nolink',
                // 'default' => 'ASC',
              ),

              // "activity" => array(
              //   'title' => 'Activity',
              //   'meta_key' => 'casestudy_case_activity',
              // ),
              'type' => array(
                'title'=> "Type",
                'taxonomy' => 'casestudy-type'
              ),
               'macroregion' => array(
                'title'=> "Macro Region",
                'taxonomy' => 'macro-region'
              ),
              'lang' => array(
                'title'=> "Language",
                'taxonomy' => 'language'
              ),
              // 'translationid' => array(
              //   'title'=> "Translation Base ID",
              //   'meta_key' => 'casestudy_nolink',
              // ),
             // 'casestudy_partner' => array(
             //    'title'=> "casestudy_partner",
             //    'meta_key' => 'casestudy_partner',
             //  ),
              
              'date' => array(
                'title' => 'Date',
                'default' => 'ASC',
              ),
               'author' => array(
                'title' => 'Author',
              ),
              'translationcode' => array(
                'title'=> "Translation Code",
                'meta_key' => 'translation-tax',
              ),
               # Add a dropdown filter to the admin screen:
            ),
            
          ), 
        // lables / names
          array(
            'singular' => __( $name == 'contribute' ?  'Contribute' : 'Case Study',  'yours'),
            'plural' => __( $name == 'contribute' ?  'Contributes' : 'Case Studies',  'yours'),
            'slug'   => __( $name, 'yours' ),
          )
      ); /* end of register post type */
    }
  }

function add_quick_edit($column_name, $post_type) {
    if ( 'casestudy_nolink' != $column_name )
        return;
    ?>
    <fieldset class="inline-edit-col-left">
        <div class="inline-edit-col">
            <label>
                <span class="title" style="width:100px;"><b>No Link in Map</b></span>
                <span class="input-text-wrap"><input name="casestudy_nolink" 
                   type="checkbox"></span>
        </label>
        </div>
    </fieldset>
    <?php 
}



/**********************************************************
 *
 * saving transid in quickedit 
 *
 *********************************************************/

function quickedit_save_post( $post_id, $post ) {
    // if called by autosave, then bail here
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;  

    // does this user have permissions?
     if ( ! current_user_can( 'edit_post', $post_id ) )
         return;

    // update!
    if ( isset( $_POST['casestudy_nolink'] ) ) {
        update_post_meta( $post_id, 'casestudy_nolink', $_POST['casestudy_nolink'] );
    }
}


/**********************************************************
POPULATE WITH LIVE DATA


 *********************************************************/

function quickedit_javascript() {

    /* only for some post types */
    $current_screen = get_current_screen();
    // var_dump($current_screen);
    // die();
    /* this might result in a js error "ReferenceError: inlineEditPost is not defined " 
    when not done only in overview pages
    */
    if ($current_screen->id !== "edit-ovp" || $current_screen->id !== "edit-page" ) 
        return;

    // if ( $current_screen->id != 'edit-post') // || $current_screen->post_type != 'post' )
    //     return;
  
    // Ensure jQuery library loads
    wp_enqueue_script( 'jquery' );
    ?>

    <script type="text/javascript">

        jQuery( function( $ ) {
            // we create a copy of the WP inline edit post function
            var $wp_inline_edit = inlineEditPost.edit;

                    console.log( "hello my frind")
            // and then we overwrite the function with our own code
            inlineEditPost.edit = function( id ) {

                // "call" the original WP edit function
                // we don't want to leave WordPress hanging
                $wp_inline_edit.apply( this, arguments );

                // now we take care of our business
                // get the post ID
                var $post_id = 0;
                if ( typeof( id ) == 'object' ) {
                    $post_id = parseInt( this.getId( id ) );
                }

              

                if ( $post_id > 0 ) {
                    // define the edit row
                    var $edit_row = $( '#edit-' + $post_id );
                    var $post_row = $( '#post-' + $post_id );

                    // get the data
                    var $casestudy_nolink = $post_row.find(".casestudy_nolink");
                    var val = $casestudy_nolink.text();

                    if (val == "on") val = true;

                    // // populate the data
                    $edit_row.find(".casestudy_nolink").val( val );

                }
            };
       
        });
    </script>
    <?php
}


/* populate trans value when  Quick Edit box is being opened. */
function quickedit_set_data( $actions, $post ) {
    $found_value = get_post_meta( $post->ID, 'casestudy_nolink', true );

    if ( $found_value ) {
        if ( isset( $actions['inline hide-if-no-js'] ) ) {
            $new_attribute = sprintf( 'data-casestudy_nolink="%s"', $found_value  );
            $actions['inline hide-if-no-js'] = str_replace( 'class=', "$new_attribute class=", $actions['inline hide-if-no-js'] );
        }
    }

    return $actions;
}





}
