<?php
namespace Yours\Plugin\Shortcodes;
use Yours\Plugin\Plugin;

class RelatedProjects extends Plugin
{

  public function __construct() {

    // Usage: [hello name="Daniel"]
    if ( ! shortcode_exists( 'relatedProjects' ) ) {
        add_shortcode( 'relatedProjects', array( $this, 'shortcode' ) );
    }
 if ( ! shortcode_exists( 'related' ) ) {
        add_shortcode( 'related', array( $this, 'shortcode' ) );
    }
  }

  /**
   * 
   *
   * @param $atts array Shortcode Attributes
   * @return string Output of shortcode
   * @since 0.1.0
   */
  public function shortcode($atts) {

    $args = [];
    if (function_exists("helper_shortcode_attr_to_query_options")) {
      $args = helper_shortcode_attr_to_query_options($atts);
    }

    $args['posts_per_page']=-1;
    $args['post_type'] = array('relatedprojects');
   
    $loop = new \WP_Query( $args );
   
    /* walk through posts and add them into tax order*/

    $out = '';
    $out .='<table class="relatedprojects">';
        $out .='<thead>';
            $out .='<tr>';
                $out .='<th>';
                    $out .= "Name / Link";
                $out .='</th>';
                $out .='<th>';
                    $out .= "Description";
                $out .='</th>';
            $out .='</tr>';
        $out .='</thead>';
        $out .='<tbody>';
        $count = 1;
              foreach ($loop->posts as $p) {
                $link =  get_post_meta( $p->ID, "relatedprojects_link", true);
                    $out .='<tr>';
                     
                        $out .='<td>';
                        $out .= '<a href="'.$link.'" target="_blank" rel="noopener noreferrer">'. $p->post_title . '</a>';
                        $out .='</td>';
                        $out .='<td>';
                        $out .= apply_filters('the_content',$p->post_content);
                        $out .='</td>';
                   $out .='<tr>';
            }
        $out .='</tbody>';
    $out .='</table>';
    
    return $out;// . $cons;

  }

}



        
