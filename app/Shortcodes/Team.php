<?php
namespace Yours\Plugin\Shortcodes;
use Yours\Plugin\Plugin;

class Team extends Plugin
{

  public function __construct() {

    if ( ! shortcode_exists( 'team' ) ) {
        add_shortcode( 'team', array( $this, 'shortcode' ) );
    }
     if ( ! shortcode_exists( 'ambassador' ) ) {
        add_shortcode( 'ambassador', array( $this, 'shortcode' ) );
    }

  }

  /**
   * 
   *
   * @param $atts array Shortcode Attributes
   * @return string Output of shortcode
   * @since 0.1.0
   */
  public function shortcode() {
  
  
    $args['posts_per_page']=-1;
    $args['post_type'] = array('team');
   
    $loop = new \WP_Query( $args );
  
    $out = '';
    $out .=  '<section class="grid-container team-listing" >';
    $out .=  ' <div class="grid-x grid-padding-x" >';

    foreach ($loop->posts as $post) {
      $inst = get_post_meta( $post->ID, "team_member_institution", true );

      $imgMarkup = get_the_post_thumbnail($post,'medium');
       /* replacing wp default image markup */
       $imgMarkup = preg_replace('/height=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/width=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/class=[\"\'][a-zA-Z0-9-_ ]+[\"\']/i', 'class="lazyload"', $imgMarkup);
       $imgMarkup = str_replace("srcset", "data-srcset", $imgMarkup);
       $sizes = 'sizes="(max-width: 100vw) 300px, 300px"';
       $imgMarkup = preg_replace('/sizes="(.+?)"/i', $sizes, $imgMarkup);


      $out .=  '<div class="small-6 medium-3 cell ">';
       $out .=  ' <figure>'.$imgMarkup.'</figure>';
       $out .=  "<h3 class='serif'>".$inst."</h3>";
       $out .=  "<h3>".$post->post_title."</h3>";
       $out .=  '<a class="vp" href="'.get_the_permalink($post->ID).'" class="vm"><span>'.__("View more","yours").'</span></a>';
      $out .=  '</div>';
    }
    $out .=  '</div>';
    $out .=  '</section>';

    return $out;

  }

}



        
