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

class Glossary extends Plugin {

  private static $posttypes = array(
    'glossary'
  );
    private $posttype="glossary";


  public function __construct() {

    add_action( 'cmb2_init', array($this,'sidebar_box') );
    // add_action( 'cmb2_init', array($this,'meta_box') );
  }

  /*
  Abbr text
  Is Consortium boolean
  Country
  Type (research,education)
  */

  private static $instructions = "
    <p>Please assign only <b>one</b> category <b>Glossary-Split</b> to set the position of the entry.</p>
  ";
 
  function sidebar_box(){

    $name = $this->posttype;
    $prefix = $name.'_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Glossary Info', 'yours' ),
        'object_types'  => self::$posttypes, // Post type
        'context'      => 'after_title', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => true,
         // 'mb_callback_args'   =>  [
         //     '__block_editor_compatible_meta_box' => true,
         //      '__back_compat_meta_box' => true
         // ],
        'show_in_rest' => true
    ) );
    $cmb->add_field( array(
    // 'name' => 'Beginnig Letter',
     'before_row'     => self::$instructions,
    // 'description' => __( 'Beginnig Letter', 'yours' ),
    'id'   => $prefix .'letter',
    // 'type' => 'text',
    'show_in_rest' => false,
    ));

    
   
    }

   

}
