<?php 
namespace Yours\Plugin\Blocks;
use Yours\Plugin\Plugin;
// use Carbon_Fields\Block;
// use Carbon_Fields\Field;

/*info desc here https://calderaforms.com/2019/01/convert-shortcode-gutenberg-block/*/

class Mixin extends Plugin {




  // private $hero;

 public function __construct () {
  
    /**
 * Enqueue block script and backend stylesheet.
 */
    add_action( 'enqueue_block_editor_assets', function() {

    //  wp_enqueue_script('mixin',
    //   plugins_url( 'js/mixin.js', __FILE__ ),
    //   [ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor','wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post'  ]
    // );
  
  });

  add_action('init', array($this,"register_block_serverside_render_callback"));
    // add_action( 'init', array($this,'register_meta_fields') );


  /**
   * Enqueue styles for backend and frontend.
   */
  // add_action( 'init', 'basic_info_block_init' );
  // $this->register_meta_fields();

  // add_filter( 'allowed_block_types', array($this,'allowed_block_types'), 10, 2 );
 }



function register_block_serverside_render_callback(){
    register_block_type('liaison/mixin', array(
    'render_callback' => array($this,'render_block'),
  ));
  register_block_type('liaison/mixin-kachel', array(
    'render_callback' => array($this,'render_block_kachel'),
  ));
  register_block_type('liaison/mixin-kachel-3', array(
    'render_callback' => array($this,'render_block_kachel'),
  ));
  
}


function cell_markup ($pid, $cellwide=4, $title, $content, $extra_line, $mediaURL, $flippedClass) {
       $offset = $cellwide == 4 ? "medium-offset-1" : "";
       $cellwide = 4;
       ob_start(); ?>
       <div class="cell small-12 <?php echo 'medium-'.$cellwide ?> <?php echo $offset ?> <?php echo $flippedClass ?>">
        <a href="<?php echo get_permalink( $pid) ?>">
            <?php  if ($mediaURL !== "") { ?>
            <img class="lazyload" data-src="<?php echo $mediaURL; ?>"></img>
            <?php } ?>
            <?php if ($extra_line1 !== "") { ?>
            <h3 class="serif gray">
              <?php echo $title ?>
              </h3>
            <?php } ?>
            <h2 class="">
              <?php echo $extra_line ?>
            </h2>
        </a>
      </div>
       <?php 
        $out = ob_get_clean();
        echo $out;
}


function render_block_kachel($atts) {
  $pid1 = $atts['selectedPostId_1'];
  $pid2 = $atts['selectedPostId_2'];
  $flipped = $atts['flipped'];
  $flippedClass1 = $flipped ? " medium-order-2" : "";
  $flippedClass2 = $flipped ? " medium-order-1" : "";
  $extra_line1 = $atts['extra_line_1'];
  $extra_line2 = $atts['extra_line_2'];
  $content1 = $atts['content_1'];
  $content2 = $atts['content_2'];
  $mediaURL1= get_the_post_thumbnail_url($pid1,"medium_large");
  $mediaURL2= get_the_post_thumbnail_url($pid2,"medium_large");
  $post1 = get_post($pid1);
  $post2 = get_post($pid2);
  $title1 = $post1->post_title;
  $title2 = $post2->post_title;
  /* 3 kachel */
  $tripple = false;
  if (isset($atts['selectedPostId_3'])) {
      $pid3 = $atts['selectedPostId_3'];
      $post3 = get_post($pid3);
      $title3 = $post3->post_title;
      $extra_line3 = $atts['extra_line_3'];
      $mediaURL3= get_the_post_thumbnail_url($pid3,"medium_large");
      $tripple = true;
  }
  $cellwide = $tripple ? 3 : 4;
  $class = $tripple ? "three" : "two";
     ob_start(); ?>
       <div class="grid-container mixin <?php echo $class; ?>">
        <div class="grid-x grid-padding-x ">
        <?php $this->cell_markup($pid1, $cellwide, $title1, $content1, $extra_line1, $mediaURL1, $flippedClass1);?>
        <?php $this->cell_markup($pid2, $cellwide, $title2, $content2, $extra_line2, $mediaURL2, $flippedClass2);?>
        <?php if ($tripple) {
          $this->cell_markup($pid3, $cellwide, $title3, $content3, $extra_line3, $mediaURL3, "");
        }  ?>
      </div>
    </div>
    <?php 
    $out = ob_get_clean();
    return $out;

}
function render_block($atts,$content)
{
  $pid = $atts['selectedPostId'];
  $flipped = $atts['flipped'];
  $flippedClass1 = $flipped ? " medium-order-2" : "";
  $flippedClass2 = $flipped ? " medium-order-1" : "";
  $extra_line = $atts['extra_line'];
  $mediaURL= get_the_post_thumbnail_url($pid,"medium_large");
  $post = get_post($pid);
  $title = $post->post_title;
     ob_start(); ?>
       <div class="grid-container mixin one">
        <div class="grid-x grid-padding-x ">
      <div class="cell small-12 medium-6 <?php echo $flippedClass1 ?>">
          <?php if ($extra_line !== "") { ?>
          <h3 class="serif"><?php echo $extra_line ?></h3>
        <?php } ?>
          <h1>
            <?php echo $title ?>
          </h1>
          <?php echo $content; ?>
          <div class="wp-block-button">
            <a class="wp-block-button__link" href="<?php echo get_the_permalink($pid) ?> "> <?php echo __("Read more","yours")  ?></a>
          </div>
      </div>
      <div class="cell small-12 medium-6 <?php echo $flippedClass2 ?>">
          <?php  if ($mediaURL !== "") { ?>
          <img class="lazyload" data-src="<?php echo $mediaURL; ?>"></img>
          <?php } ?>
      </div>
      </div>
    </div>
    <?php 
    $out = ob_get_clean();
    return $out;
 
}



}
