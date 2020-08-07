<?php 
namespace Yours\Plugin\Blocks;
use Yours\Plugin\Plugin;
// use Carbon_Fields\Block;
// use Carbon_Fields\Field;
/**/

class Team extends Plugin {


  private static $posttypes = array(
    'casestudy',
    "team",
    "page"
  );


 public function __construct () {
    add_action('init', array($this,"register_block_meta"));
    add_action('init', array($this,"register_block_serverside_render_callback"));
  // add_filter( 'allowed_block_types', array($this,'allowed_block_types'), 10, 2 );
 }

// register custom meta tag field

/* these meta fields can be bound to block attributes 
see js block definition

make sure that these are in rest. you can do this by request the rest api endpoint of the post
i.e:
sitename.com/wp-json/wp/v2/POST_TYPE?slug=post-slug
or 
larslo.larslo/liaison/wp-json/wp/v2/team?id=212

in console you can access post data like so:
wp.data.select( 'core/editor' ).getCurrentPost().meta;
*/
function register_block_meta() {
    register_post_meta( '', 'team_member_institution', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string'
    ) );
   
}


/* restrict the allow block types */
function allowed_block_types( $allowed_block_types, $post ) {
    // if (in_array($post->post_type, self::$posttypes)){
    if ( $post->post_type == 'team' ) {
        return array( 'core/paragraph' );
    }
    return $allowed_block_types;
}



 function register_block_serverside_render_callback(){
    register_block_type('liaison/teamtemplate', array(
    'render_callback' => array($this,'render_block'),
  ));
}

/* when 'Liaison Columns (like on Team)' teamtemplate block renders on frontend
see: registerBlockType( 'liaison/teamtemplate', {
    title: 'Liaison Columns (like on Team)',

    we need 
    title, 
    meta team_member_institution
    featured image
    the paragraph info comes with content
*/
function render_block($atts,$content)
{
  global $post;
  $pictureMarkup = \Yours\Plugin\Helpers\Helpers::srcset_markup_for_featured_media($p);
  /* correcting sizes*/
  $sizes = 'sizes="(max-width: '. intval(PAGECONTENTWIDTH)/2 .'px)"';
  $pictureMarkup = preg_replace('/sizes="(.+?)"/i', $sizes, $pictureMarkup);
  // $mediaURL = get_the_post_thumbnail_url($post->ID,"medium_large");
  $secondhead = get_post_meta($post->ID,'team_member_institution', true);
  $cap = isset($atts['imgdesc']) ? $atts['imgdesc'] : "";
  ob_start(); ?>
  <div class="grid-container columned team-opener">
    <div class="grid-x grid-margin-x ">
      <div class="cell small-12 medium-6">
          <h3 class="serif"><?php echo $secondhead ?></h3>
          <h2 class="serif"><?php echo $post->post_title ?></h2>
          <div><?php echo $content ?></div>
      </div>
      <div class="cell small-12 medium-6">
        <figure>
          <?php echo $pictureMarkup  ?>
          <figcaption><?php echo $cap ?></figcaption>
        </figure>

      </div>
      </div>
    </div>
    <?php 
    $out = ob_get_clean();
    return $out;
 
}






}
