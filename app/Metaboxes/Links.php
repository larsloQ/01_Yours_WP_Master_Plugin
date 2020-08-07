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

class Links extends Plugin {

  private $posttype="links";


  public function __construct() {

    // add_action( 'cmb2_init', array($this,'sidebar_box') );
    add_action( 'cmb2_init', array($this,'meta_box') );
  }

  /*
  Abbr text
  Is Consortium boolean
  Country
  Type (research,education)
  */

  private static $instructions = "
  <ul>
  <li>Link-Entries are shown in Toolbox when they have an entry in <b>Show in Toolbox</b><br>
  Every non empty entry will add links to toolbox.</li>
  <li>Description an Link-Fields are required.</li>
  
  <li>Also fill out the categories in sidebar. These apply to the filters on 'Your Material' Filters.</li>
  <br></br>
  <li>Since Media-Entries needs that you upload a File, and Links are no files, we had to split 'Your Material' into Media and Links</li>
  <li>Unplushing Links has no effect. If you want to <b>unpublish / hide a link from 'Your Material' / Toolbox</b> , empty the field <b>Show in Toolbox</b>.</li>
  </ul>
  ";



  function meta_box(){

    $name = $this->posttype;
    $prefix = '';
    $cmb = new_cmb2_box( array(
      'id'            => $name."_meta",
      'title'         => __( 'Links', 'yours' ),
          'object_types'  => $name, // Post type
          'context'      => 'after_title', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
          'priority'   => 'high',
          'closed'     => false,
        ) ) ;
    $cmb->add_field( array(
     'before_row'     => self::$instructions,
     'id'   => $prefix .'letter',
     'show_in_rest' => false,
   ));

    $cmb->add_field( array(
      'name' => 'Show in Toolbox',
      'description' => __( 'Every non-empty entry here will show this in toolbox', 'yours' ),
      'id'   => 'is_in_toolbox',
      'type' => 'text',
      'show_in_rest' => true,
    ));

    $cmb->add_field( array(
      'name' => 'Description',
      'description' => __( 'Will be shown in Toolbox (Your Material)', 'yours' ),
      'id'   => 'description',
      'show_in_rest' => true,
      'type'    => 'textarea',
    ));

    $cmb->add_field( array(
      'name' => 'Link',
      'description' => __( 'A full link/url with http://  (Goes into Download - Column)', 'yours' ),
      'id'   => 'link',
      'show_in_rest' => true,
      'type'    => 'text_url',
      
    ));

  }






}
