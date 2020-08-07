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


class CaseStudy extends Plugin {

  private static $posttypes = array(
    'casestudy','contribute','partner','team'
  );
    private $posttype="casestudy";


  public function __construct() {
    // require_once __DIR__ . '/cmb2-attached-posts/cmb2-attached-posts-field.php';
    // require_once __DIR__ . '/cmb2-attached-posts/WDS_CMB2_Attached_Posts_Field_127.php';

    /* actually not in sidebar*/
    add_action( 'cmb2_admin_init', array($this,'sidebar_info_box') );
    // add_action( 'cmb2_admin_init', array($this,'sidebar_info_box') );
    add_action( 'cmb2_admin_init', array($this,'sidebar_box') );

  }






  /*
  Abbr text
  Is Consortium boolean
  Country
  Type (research,education)
  */

   private static $instructions = "
    <ul>
    <li><b>Featured Image: </b> have this in Square Dimension with at least 700x700 Pixel.</li>
    <li>Set <b>Partner</b> in Sidebar</li>
    <li>Set <b>Case Activity</b> in Sidebar</li>
    <li>For consistency, use the 2 default Blocks.</li>
    <li>Use at least the first default block</li>
    <li>You can extend the page after the first block, with more content based on its need.</li>
    </ul>
  ";
 
  function sidebar_info_box(){
    $name = $this->posttype;
    $prefix = $name.'_info';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Info Case-Studies', 'yours' ),
        'object_types'  => $name,//self::$posttypes, // Post type
        'context'      => 'side', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => false,
        'show_in_rest' => false,
    ) );
    $cmb->add_field( array(
    'name' => '',
    'before_row'     => self::$instructions,
    'id'   => $prefix .'info',
    'show_in_rest' => false,
    ));
   
  }
  function sidebar_box(){

    $name = $this->posttype;
    $prefix = $name.'_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Case-Studies (Extra) ', 'yours' ),
        'object_types'  => self::$posttypes, // Post type
        'context'      => 'side', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => false,
        'show_in_rest' => true
    ) );

    $cmb->add_field( array(
      'name' => 'Partner',
      'description' => __( 'Abbrevation of Institution ', 'yours' ),
      'id'   => $prefix .'abbr',
      'type' => 'text',
      'show_in_rest' => true,
    ));
    $cmb->add_field( array(
      'name' => 'Number in Map',
      'description' => __( 'Number in Map', 'yours' ),
      'id'   => $prefix .'number',
      'type' => 'text',
      // 'default_cb' => __('not in map',"yours"),
      'show_in_rest' => true,
    ));
    $cmb->add_field( array(
      'name' => 'Case Activity',
      'description' => __( 'a very short description', 'yours' ),
      'id'   => $prefix .'case_activity',
      'type' => 'textarea',
      'show_in_rest' => true,
    ));


   
    }

    

}
