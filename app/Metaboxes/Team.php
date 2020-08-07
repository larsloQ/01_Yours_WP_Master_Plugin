<?php 
namespace Yours\Plugin\Metaboxes;
use Yours\Plugin\Plugin;
/* 
CMB2 META BOXes
good info here https://cmb2.io/docs/box-properties
and here
https://github.com/CMB2/CMB2-Snippet-Library
*/

class Team extends Plugin {

  private static $posttypes = array(
    'team'
  );

  public function __construct() {

    add_action( 'cmb2_init', array($this,'sidebar_info_box') );
    // add_action( 'cmb2_init', array($this,'yours_team_metabox') );
    // add_action( 'add_meta_boxes', array($this,'my_plugin_meta') );
  }

     private static $instructions = "
    <ul>
    <li><b>Featured Image: </b> have this in Square Dimension with at least 700x700 Pixel.</li>
    <li>Set <b>Institution / extra Headline</b> in Sidebar (when first block is selected)</li>
    <li>For consistency, use the 2 default Blocks.</li>
    <li>Use at least the first default block</li>
    <li>You can extend the page after the first block, with more content based on its need.</li>
    </ul>
  ";


  function sidebar_info_box(){
    // $name = $this->posttype;
    $name = "team";
    $prefix = $name.'_info';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Info Team Abmassadors', 'yours' ),
        'object_types'  => self::$posttypes, // Post type
        'context'      => 'side', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => false,
        'show_in_rest' => true
    ) );
    $cmb->add_field( array(
    'name' => '',
    'before_row'     => self::$instructions,
    'id'   => $prefix .'info',
    'show_in_rest' => false,
    ));
   
  }

  function sidebar_box(){
    $prefix = 'team_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Required *', 'cmb2' ),
        'object_types'  => self::$posttypes, // Post type
        'context'      => 'side', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => false,
      
        'show_in_rest' => true
    ) );
    $cmb->add_field( array(
    'name' => 'Institution',
    // 'description' => __( 'Text links', 'cmb2' ),
    'id'   => $prefix .'inst',
    'type' => 'text',
        'show_in_rest' => true,
        'rest_value_cb'   => function( $value ) {
            return  $value;
        },
         //   'mb_callback_args'   =>  [
         //     '__block_editor_compatible_meta_box' => true,
         //      '__back_compat_meta_box' => true
         // ],
    ) );

    }

/* old */
function yours_team_metabox() {
  

  $cmb = new_cmb2_box( array(
    'id'            => $prefix . 'metabox_',
    'title'         => __( 'Role, E-Mail, Motto', 'cmb2' ),
    'object_types'  => self::$posttypes, // Post type
    'priority'   => 'high',
    'closed'     => false,
    ) );
  // Id's for group's fields only need to be unique for the group. Prefix is not needed.
  $cmb->add_field( array(
    'name' => 'Role / Position ',
    // 'description' => __( 'Text links', 'cmb2' ),
    'id'   => $prefix .'role',
    'type' => 'text',
    ) );
  $cmb->add_field( array(
    'name' => 'E-Mail',
    'id'   => $prefix .'mail',
    'type' => 'text_email',
    ) );

  $cmb->add_field( array(
    'name' => 'Link',
    'description' => __( 'External Link (Institute, Webseite)', 'cmb2' ),
    'id'   => $prefix .'link',
    'type' => 'text_url',
    ) );

  $cmb->add_field( array(
    'name' => 'Telephone',
    'description' => __( 'Optional', 'cmb2' ),
    'id'   => $prefix .'tel',
    'type' => 'text',
    ) ); 

  $cmb->add_field( array(
    'name' => 'Fax',
    'description' => __( 'Optional', 'cmb2' ),
    'id'   => $prefix .'fax',
    'type' => 'text',
    ) ); 


   $cmb->add_field( array(
    'name' => 'Instituion',
    'description' => __( 'i.E. University', 'cmb2' ),
    'id'   => $prefix .'insitution',
    'type' => 'textarea_small',
    ) );

  // $cmb->add_field( array(
  //   'name' => 'Gender',
  //   'description' => __( 'Check when no image availablee. Check for "male"', 'cmb2' ),
  //   'id'   => $prefix .'gender',
  //   'type' => 'checkbox',
  //   ) );

   $cmb->add_field( array(
    'name' => 'Short Vita ',
    'description' => __( 'Vita, Text','cmb2' ),
    'id'   => $prefix .'vita',
    // 'type' => 'text',
    'type' => 'wysiwyg',
    ) );

  }
}
