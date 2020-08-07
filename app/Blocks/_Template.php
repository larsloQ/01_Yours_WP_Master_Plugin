<?php 
namespace Yours\Plugin\Blocks;
use Yours\Plugin\Plugin;
// use Carbon_Fields\Block;
// use Carbon_Fields\Field;

/*
  Given that certain blocks are binded to certain CPTs this Class can be used as a template.
  what it is supposed to do:
  1. enqueue Block CSS and JS for backend (enqueue_block_editor_assets)
  2. enqueue Block CSS and JS for frontend (enqueue_block_assets)
  3. register meta fields for usage in block (see team block) : make sure that the CPT supports "custom-fields" !!!
*/

class Template extends Plugin {

 public function __construct () {
 /**
 * 1.
 * Enqueue block script and backend stylesheet.
 */
  add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_script('block1',
      plugins_url( 'js/editor.blocks.js', __FILE__ ),
      [ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor','wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post'  ]
    );
    wp_enqueue_style('yours',
      plugins_url( 'css/editor.blocks.css', __FILE__ )
    );
  });

  /**
   * 2.
   * Enqueue styles for backend and frontend.
   */
  add_action( 'enqueue_block_assets', function() {
    wp_enqueue_style(
      'yours',
      plugins_url( 'assets/css/frontend.blocks.css', __FILE__ )
    );
  } );

  /**
   * 3. 
   * register meta fields for usage in block (see team block)
   * make sure that the CPT supports "custom-fields" !!!
  */
  add_action( 'cmb2_init', array($this,'register_meta_fields') );

    add_filter( 'allowed_block_types', array($this,'allowed_block_types'), 10, 2 );

 
 }



/* restrict the allow block types per CPT */
function allowed_block_types( $allowed_block_types, $post ) {
    if ( $post->post_type == 'team' ) {
        return array( 'core/paragraph' );
    }
    return $allowed_block_types;
}
 



/**
 * Registering meta fields for block attributes that use meta storage
 * 
 * changes in wp 5.3.x on this see https://make.wordpress.org/core/2019/10/03/wp-5-3-supports-object-and-array-meta-types-in-the-rest-api/
 */
function register_meta_fields() {

  register_meta( 'CPT-slug-ID', 'field_slug_ID', array(
    'type'    => 'string',
    'single'  => true,
    'show_in_rest'  => true, // this is important, since 5.3 we can use array and other non primive (see link above)
  ) );
}


}
