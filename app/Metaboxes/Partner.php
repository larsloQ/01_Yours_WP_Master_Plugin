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



class Partner extends Plugin {

  private static $posttypes = array(
    'partner'
  );
    private $posttype="partner";


  public function __construct() {

    /* actually not in sidebar*/
    add_action( 'cmb2_init', array($this,'sidebar_box') );
    add_action( 'cmb2_init', array($this,'meta_box') );
  }

  /*
  Abbr text
  Is Consortium boolean
  Country
  Type (research,education)
  */

  private static $instructions = "
    <br></br>
    <ul>
    <li><b>Featured Image: </b> have this in Square Dimension with at least 700x700 Pixel.</li>
    <li><b>Abbrevation:</b> Set <b>Abbr.</b> below</li>
    <br></br>
    <li><b>Is Consortium-Partner?</b> If checked you need to fill out</li>
    <ul>
      <li>Project Description</li>
      <li>Contact Details</li>
      <li>Featured Image</li>
    </ul>
    <br></br>
    <li><b>Partner-Type:</b> Set one of these categories to display partner in there. Only the first entry will be used.</li>
    <li><b>Country:</b> Set countries in Sidebar</li>
    <li>Featured Image (which is supposed to be a Logo here) should be evenly sized. i.E. position the logo inside a fixed frame (square dimensions, min. 700x700px) and place the logo inside. Do this in a graphics-editor, not here. </li>
    </ul>

  ";
 
  function sidebar_box(){

    $name = $this->posttype;
    $prefix = $name.'_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Partner Info and Settings!', 'yours' ),
        'object_types'  => self::$posttypes, // Post type
        'context'      => 'side', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => true,
         // 'mb_callback_args'   =>  [
         //     '__block_editor_compatible_meta_box' => true,
         //      '__back_compat_meta_box' => true
         // ],
        'show_in_rest' => false
    ) );

      $cmb->add_field( array(
      // 'name' => 'Abbr.',
       'before_row'     => self::$instructions,
      // 'description' => __( 'Abbrevation of Institution', 'yours' ),
      'id'   => $prefix .'nothing',
      'type' => '',
      'show_in_rest' => false,
      ));
   
   
    }

    function meta_box(){

      $name = $this->posttype;
      $prefix = $name.'_cons_';
      $cmb = new_cmb2_box( array(
          'id'            => $prefix . '',
          'title'         => __( 'Infos for Consortium Partner', 'yours' ),
          'object_types'  => self::$posttypes, // Post type
          'context'      => 'normal', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
          'priority'   => 'high',
          'closed'     => false,
           // 'mb_callback_args'   =>  [
           //     '__block_editor_compatible_meta_box' => true,
           //      '__back_compat_meta_box' => true
           // ],
          // 'show_in_rest' => true
      ) );
        $cmb->add_field( array(
    'name' => 'Abbr.',
     'before_row'     => self::$instructions,
    'description' => __( 'Abbrevation of Institution', 'yours' ),
    'id'   => 'partner_abbr',
    'type' => 'text',
    'show_in_rest' => true,
    ));

    

    $cmb->add_field( array(
    'name' => 'Is Consortium-Partner?',
    'description' => __( 'Check if this is a consortium partner', 'yours' ),
    'id'   => $name .'is_cons',
    'type' => 'checkbox',
    'show_in_rest' => true,
    ));

      $cmb->add_field( array(
      'name' => 'Description',
       // 'before_row'     => self::$instructions,
      // 'description' => __( 'Abbrevation of Institution', 'yours' ),
      'id'   => $prefix .'desc',
      // 'show_in_rest' => true,
      'type'    => 'wysiwyg',
      'options' => array(
          'wpautop' => false, // use wpautop?
          'media_buttons' => false, // show insert/upload button(s)
          // 'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
          'textarea_rows' => get_option('default_post_edit_rows', 15), // rows="..."
          // 'tabindex' => '',
          // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
          // 'editor_class' => '', // add extra class(es) to the editor textarea
          'teeny' => true, // output the minimal editor config used in Press This
          'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
          'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
          'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
      ),
      ));

      $cmb->add_field( array(
      'name' => 'Contact Info Consortium-Partner',
      // 'description' => __( 'Check if this is a consortium partner', 'yours' ),
      'id'   => $prefix .'contact',
      'show_in_rest' => true,
      'type'    => 'wysiwyg',
      'options' => array(
          'wpautop' => false, // use wpautop?
          'media_buttons' => false, // show insert/upload button(s)
          // 'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
          'textarea_rows' => get_option('default_post_edit_rows', 15), // rows="..."
          // 'tabindex' => '',
          // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
          // 'editor_class' => '', // add extra class(es) to the editor textarea
          'teeny' => true, // output the minimal editor config used in Press This
          'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
          'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
          'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
      ),
      ));
   
    }

}
