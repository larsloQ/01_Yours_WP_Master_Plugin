<?php
namespace Yours\Plugin\Shortcodes;
use Yours\Plugin\Plugin;

class Mail extends Plugin
{

  public function __construct() {

    // Usage: [hello name="Daniel"]
    if ( ! shortcode_exists( 'mail' ) ) {
        add_shortcode( 'mail', array( $this, 'shortcode' ) );
    }

  }





  /**
   this setup needs a JS file "email-spam-safe" (in theme) which will use this markup and produces the email as shown on page
   */
  public function shortcode($args) {
   
    if ( !isset($args['id']) || intval($args["id"])<=0 ) {
      return;
    }
    $id = intval($args['id']);
    $post = get_post($id);
    $meta = get_post_meta($id);

    $mailadr = $post->post_title;
    $mail_show_icon = $meta['mail_show_icon'][0] == "on" ? true:false;
    $mail_display_text = $meta['mail_display_text'][0];
    $mail_subject_line = $meta['mail_subject_line'][0];
    $mail_default_text = $meta['mail_default_text'][0]; // in email client
    $mail_show_as_button = $meta['mail_show_as_button'][0];
    $mail_icon_color = $meta['mail_icon_color'][0];



    $keeptext = ""; // will be a class for JS
    $show_as_link = "";
    $attr_title = ""; // when making mail as link, add title to link for usability
    if (strlen($mail_display_text)<3) {
      $mail_display_text = str_replace("@", " [ at ] ", $mailadr);
    } else {
      $attr_title = 'title="This link is supposed to be opened in your e-mail client"';
      $keeptext = "keeptext";
      $show_as_link = "asmail_to";
    }
    $add_subject = "";
    if (strlen($mail_subject_line)>2) {
      $add_subject = " data-subject='$mail_subject_line' ";
    }
    $add_body = "";
    if (strlen($mail_default_text)>2) {
      $add_body = " data-body='$mail_default_text' ";
    }

    $asButton = "";
    if ($mail_show_as_button == 'on') {
      $asButton = "button meilbutton";
    }


    $out = "<div class='meil-wrap'>";
    $out .= "<div class='meil $keeptext  $show_as_link  $asButton' ";
    $out .= "data-h='".json_encode(explode('@', $mailadr)) . "'";
    $out .= $add_subject;
    $out .= $add_body;
    $out .= $attr_title;
    $out .=  ">";

    if ($mail_show_icon) {
      $color = $mail_show_as_button == 'on' ? "#FFF" : $mail_icon_color;
      $out .= $this->get_icon($color);
    }
    $out .= '<span>'.$mail_display_text.'</span>';
    $out .= "</div>";
    $out .= "</div>";
    return $out;

  }


  function get_icon($color="#63d156") {
    // $icon = '<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="'.$color.'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
    // <path d="M2 26 L30 26 30 6 2 6 Z M2 6 L16 16 30 6" />
    // </svg>';
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28.753" viewBox="0 0 28 28.753"><defs><style>.a{fill:'.$color.';}.b{fill:none;}</style></defs><path class="a" d="M23.6,4H4.4A2.5,2.5,0,0,0,2.012,6.594L2,22.159a2.51,2.51,0,0,0,2.4,2.594H23.6A2.51,2.51,0,0,0,26,22.159V6.594A2.51,2.51,0,0,0,23.6,4Zm0,5.188L14,15.674,4.4,9.188V6.594L14,13.08l9.6-6.486Z"/><path class="b" d="M0,0H28V28.754H0Z"/></svg>';
    return $icon;

  }

}



        
