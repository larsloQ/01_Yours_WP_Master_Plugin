<?php 
namespace Yours\Plugin\Metaboxes;
use Yours\Plugin\Plugin;


class RelatedProjects extends Plugin {

  private static $posttypes = array(
    'relatedprojects'
  );
    private $posttype="relatedprojects";


  public function __construct() {

    add_action( 'cmb2_init', array($this,'sidebar_box') );
    // add_action( 'cmb2_init', array($this,'meta_box') );
  }



  private static $instructions = "
    <ul>
    <li>
    Please use the Link field to set the link to related Project.
    </li>
    <li>
    Keep the description short and similar in length in between Related Projects
    </li>
    <li>
     Related Projects are supposed to be shown on page 'Related Projects'. Anyweay via shortcode 
     <i>[relatedProjects]</i> or <i>[related]</i> they can be shown anywhere.
    </li>
    <li>Please do NOT use any shortcodes or heavy media in den Content-Area. Just a short text-only description.</li>
    </ul>

  ";
 
  function sidebar_box(){

    $name = $this->posttype;
    $prefix = $name.'_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Related Projects', 'yours' ),
        'object_types'  => self::$posttypes, // Post type
        'context'      => 'after_title', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => false,
         // 'mb_callback_args'   =>  [
         //     '__block_editor_compatible_meta_box' => true,
         //      '__back_compat_meta_box' => true
         // ],
        // 'show_in_rest' => __return_true()
    ) );
    $cmb->add_field( array(
    'name' => 'Link',
     'before_row'     => self::$instructions,
    'description' => __( 'Set Link to Related Project. Full URLs (with https://) ', 'yours' ),
    'id'   => $prefix .'link',
    'type' => 'text_url',
      'protocols' => array( 'http', 'https'),//, 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
    'show_in_rest' => false,
    ));

    
   
    }

   

}
