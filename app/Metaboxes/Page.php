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

class Page extends Plugin {

  private static $posttypes = array(
    'page'
  );
    private $posttype="page";


  public function __construct() {

    /* actually not in sidebar*/
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
    <p>All Consortium Partners need:</p>
    <ul>
    <li>a logo (use <i>Featured Image</i> for this). <b>Featured Image: </b> have this in Square Dimension with at least 500x500 Pixel.</li>
    <li>Fill out Project Description</li>
    <li>Fill out Contact Details</li>
    </ul>
  ";
 
  function sidebar_box(){

    $name = $this->posttype;
    $prefix = $name.'_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Case-Studies Readme', 'yours' ),
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
    'name' => 'Abbr.',
     'before_row'     => self::$instructions,
    'description' => __( 'Abbrevation of Institution', 'yours' ),
    'id'   => $prefix .'abbr',
    'type' => 'text',
    'show_in_rest' => true,
    ));

    $cmb->add_field( array(
    'name' => 'Is Consortium-Partner?',
    'description' => __( 'Check if this is a consortium partner', 'yours' ),
    'id'   => $prefix .'is_cons',
    'type' => 'checkbox',
    'show_in_rest' => true,
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
      'description' => __( 'You have to be very precise here. Space is rare. Please use only h2 and p', 'yours' ),
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
          'tinymce' => false, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
          'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
      ),
      ));
   
    }

}
