<?php 
namespace Yours\Plugin\Blocks;
use Yours\Plugin\Plugin;
// use Carbon_Fields\Block;
// use Carbon_Fields\Field;
/**/

class LiaisonColumns extends Plugin {


 

 public function __construct () {
    add_action('init', array($this,"register_block_serverside_render_callback"));
 }




 function register_block_serverside_render_callback(){
    register_block_type('liaison/columns', array(
    'render_callback' => array($this,'render_block'),
  ));
}


function render_block($atts,$content)
{
  // <!-- <div class="grid-container columned liaison-columns"> -->
    // <!-- <div class="grid-x grid-padding-x "> -->
      // <!-- </div> -->
    // <!-- </div> -->
  ob_start(); ?>
        <?php echo $content;?>
    <?php 
    $out = ob_get_clean();
    return $out;
 
}






}
