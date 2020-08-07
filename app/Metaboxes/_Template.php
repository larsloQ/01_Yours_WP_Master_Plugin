<?php 
namespace Yours\Plugin\Metaboxes;
use Yours\Plugin\Plugin;
/* 
LFK 2019-12-22_14.07.55
Register metaboxes. 
As far as i know, CMB2 boxes can not be wired good into Blocks. But the classical setup still works fine.
Set metaboxes to sidebar or below the editor
For wiring Metafields with boxes see /Blocks/Template.php
*/

class _Template extends Plugin {

  private static $posttypes = array(
    'team'
  );

  public function __construct() {

    add_action( 'cmb2_init', array($this,'sidebar_box') );
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
         // 'mb_callback_args'   =>  [
         //     '__block_editor_compatible_meta_box' => true,
         //      '__back_compat_meta_box' => true
         // ],
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
    // "show"
    ) );
     $cmb->add_field( array(
    'name' => 'Institution',
    // 'description' => __( 'Text links', 'cmb2' ),
    'id'   => 'event_short_info',
    'type' => 'text',
        'show_in_rest' => true
    // "show"
    ) );
    }

/* older*/
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



   $cmb->add_field( array(
    'name' => 'Short Vita ',
    'description' => __( 'Vita, Text','cmb2' ),
    'id'   => $prefix .'vita',
    // 'type' => 'text',
    'type' => 'wysiwyg',
    ) );

  }
}
