<?php 
namespace Yours\Plugin\Metaboxes;
use Yours\Plugin\Plugin;
/* 

*/

class Mail extends Plugin {

  private static $posttypes = array(
    'mail'
  );
  private $posttype="mail";


  public function __construct() {
    add_action( 'cmb2_init', array($this,'sidebar_box') );
  }



  private static $instructions = "
    <p>Use this if you want to have spam-safe emails.</p>
    <p>to show it somewhere on a page use shortcode <pre>[mail id=\"ENTER ID\"]</pre>
    You need to replace <b>ENTER ID</b> by the ID of the Mail, which you find in <a href='edit.php?post_type=mail'>All Mails</a></p>
    <p>
    You can change the displayed text<br>
    You can choose a subject line, for when the user clicks on it<br>
    You can choose a the default mail text for when the user clicks on it</p>
    <p><b>Be aware:</b><br>
    When a user has no E-Mail Client on its device and clicks on such a Mailto-Link, nothing will happen.
    So its always a good idea to display the E-Mail on the page (i.e. keep field <b>Displayed Text</b> empty)
    </p>
  ";
 
  function sidebar_box(){

    $name = $this->posttype;
    $prefix = $name.'_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . '',
        'title'         => __( 'Mail Info', 'yours' ),
        'object_types'  => self::$posttypes, // Post type
        'context'      => 'after_title', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
        'priority'   => 'high',
        'closed'     => false,
        'show_in_rest' => false
    ) );
    $cmb->add_field( array(
    // 'name' => 'Beginnig Letter',
     'before_row'     => self::$instructions,
      // 'description' => __( 'Beginnig Letter', 'yours' ),
      'id'   => $prefix .'inst',
      'type' => '',
      'show_in_rest' => false,
    ));
    $cmb->add_field( array(
      'name' => 'Displayed Text',
      'id'   => 'mail_display_text',
      'description' => __( 'When left empty, this defaults to name[at]domain.tld (from the title). When you enter something here, that means that the e-mail will be displayed as a link, which might be an usability issue (see above)', 'yours' ),
      'type' => 'text',
    ));
      $cmb->add_field( array(
      'name' => 'Show as Link ?',
       'description' => __( 'Checked this if "Displayed Text" is empty but you want to have the mail as a link. Be aware that when "Displayed Text" is not empty, the email will be shown always as a link!', 'yours' ),
      'id'   => 'mail_show_link',
      'type' => 'checkbox',
    ));
    $cmb->add_field( array(
      'name' => 'Subject Line',
      'id'   => 'mail_subject_line',
      'description' => __( 'When the user clicks the link, this text will be set as the <b>Subject Line</b> of the mail. No <b>html</b> allowed!', 'yours' ),
      'type' => 'text',
    ));
    $cmb->add_field( array(
      'name' => 'Default Mail Text',
      'id'   => 'mail_default_text',
      'description' => __( 'When the user clicks the link, this text will be set as the <b>default text</b> of the mail. No <b>html</b> allowed!', 'yours' ),
      'type' => 'textarea',
    ));
     $cmb->add_field( array(
      'name' => 'Show Icon (before Text) ?',
      'id'   => 'mail_show_icon',
      'type' => 'checkbox',
    ));

    $cmb->add_field( array(
      'name' => 'Show E-Mail as a green button',
      'id'   => 'mail_show_as_button',
      'type' => 'checkbox',
    ));

    $cmb->add_field( [
      'name'    => 'Icon Color',
      'id'      => 'mail_icon_color',
      'type'    => 'colorpicker',
      'default' => '#278f18',
      'attributes' => array(
          'data-colorpicker' => json_encode( array(
              // Iris Options set here as values in the 'data-colorpicker' array
              'palettes' => array( '#278f18', '#63d156'),
          ) ),
      ),

    ] );

    
   
    }

   

}
