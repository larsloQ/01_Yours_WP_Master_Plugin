<?php 
namespace Yours\Plugin\Blocks;
use Yours\Plugin\Plugin;
// use Carbon_Fields\Block;
// use Carbon_Fields\Field;

/*info desc here https://calderaforms.com/2019/01/convert-shortcode-gutenberg-block/*/

class Hero extends Plugin {


  private static $posttypes = array(
    'casestudy',
    "team"
  );

  // private $hero;

 public function __construct () {
  
    /**
 * Enqueue block script and backend stylesheet.
 */
    add_action( 'enqueue_block_editor_assets', function() {

     wp_enqueue_script('heroblock',
      plugins_url( 'js/hero-opener-image.js', __FILE__ ),
      [ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor','wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post'  ]
    );
  
  });

  add_action('init', array($this,"register_block_callback"));

  /**
   * Enqueue styles for backend and frontend.
   */
  // add_action( 'init', 'basic_info_block_init' );
  // $this->register_meta_fields();

  // add_filter( 'allowed_block_types', array($this,'allowed_block_types'), 10, 2 );
 }

function register_block_callback(){
    register_block_type('liaison/hero-opener', array(
    'render_callback' => array($this,'render_block'),
  ));
}


function render_block()
{

  $res = \Yours\Plugin\Metaboxes\Hero\Hero::shortcode_hero();
  /*is_admin is always false in a XHR - Editor request*/
   // if (is_admin()) {
   if (isset($_REQUEST['context']) && $_REQUEST['context']=="edit") {
    /* string replace
      when shortcode is used inside of editor, then we replace lazyloading data-src
    */ 
      $res = str_replace("data-src", "src", $res);
      $res = str_replace("data-srcset", "srcset", $res);
    } 
  if ($res=="") { return "<p class='error'>For this to work first set Hero Image below the Editor. Than save and reload.</p>";}
  return $res;
}



}
