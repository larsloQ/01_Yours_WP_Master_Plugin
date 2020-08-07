<?php
namespace Yours\Plugin\Shortcodes;
use Yours\Plugin\Plugin;
use Yours\Plugin\Helpers\Helpers as Helpers;

class Partner extends Plugin
{

  public function __construct() {

    // Usage: [hello name="Daniel"]
    if ( ! shortcode_exists( 'partner' ) ) {
        add_shortcode( 'partner', array( $this, 'shortcode' ) );
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
    $terms = get_terms( 'partner-type', array(
        'hide_empty' => false,
          'orderby' => 'name', 
          'order' => 'ASC' 
    ) );
    foreach ($terms as $term) {
       $meta = get_term_meta($term->term_id);
       $colorcode ="";
       if($meta['partner_type_color'] && $meta['partner_type_color'][0]) {
           $term->color = $meta['partner_type_color'][0];
       }    
    }

    

    // $args = helper_shortcode_attr_to_query_options(['id'=>"all"]); 
    // $args = array();
    $args['posts_per_page']=-1;
    $args['post_type'] = array('partner');
    // $args['orderby'] = 'title';
    // $args['order'] = 'ASC';
    $loop = new \WP_Query( $args );
    
    /* walk through posts and add them into tax order*/
    $orderedposts = array();
    foreach ($loop->posts as $p) {
       $postterms =  wp_get_post_terms( $p->ID, "partner-type" );
       $countryterms =  wp_get_post_terms( $p->ID, "country" );

       $meta = get_post_meta($p->ID);
       // $is_cons = $meta['partner_is_cons'][0];
       $imgMarkup = get_the_post_thumbnail($p,'medium_large');
       /* replacing wp default image markup */
       $imgMarkup = preg_replace('/height=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/width=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/class=[\"\'][a-zA-Z0-9-_ ]+[\"\']/i', 'class="lazyload"', $imgMarkup);
       $imgMarkup = str_replace("srcset", "data-srcset", $imgMarkup);

      $p->logo = $imgMarkup;
      $p->meta = $meta;

       // }
       // we take only one / first
      foreach ($terms as $index => $term) {
        if ($postterms[0]->term_id == $term->term_id) {
            $orderedposts[$term->name][] = [
                'post'=>$p,
                'meta'=>$meta,
                'country'=>$countryterms[0]->name,
                'color'=>$term->color,
                'color_name'=>$term->slug,
                'img' => $imgMarkup,
                'is_cons' => get_post_meta($p->ID,"partner_is_cons",true)
                // 'abbr' => get_post_meta($p->ID,"partner_cons_partner_abbr",true)
            ];
        }
      }
    }



    
    $out = '';
    $out .=  '<section class="grid-container partner-listing" id="partnerlisting" >';
    $out .=  ' <div class="accordion grid-x"  data-multi-expand="true" data-deep-link="true" data-update-history="true"  data-allow-all-closed="true">';


    $cons = "";
    $cons .=  '<section class="grid-container team-listing partner" >';
    $cons .=  ' <div class="grid-x grid-padding-x" >';


    foreach ($orderedposts as $key => $value) {
          $out .=  '<div class="small-12 cell accordion-item '.$value[0]['color_name'].'" data-accordion-item>';
                $out .=  '<a class="accordion-title '.$value[0]['color_name'].'">';
                $out .=  "<div style='background-color:".$value[0]['color']."' class='color-dot'></div>";
                $out .=  "<span>".$key."</span>";
                $out .=  '</a>';
                $out .=  '<div class="accordion-content '.$value[0]['color_name'].'" data-tab-content>';
                  $out .=  '<div class="head">';
                    $out .=  "<div class='abbr'>Abbr.</div>";
                    $out .=  "<div class='name'>Participant Organisation Name</div>";
                    $out .=  "<div class='country'>Country</div>";
                  $out .=  '</div>';
                  foreach ($value as $p) {
                    $is_cons_class = $p['is_cons'] ? "is_cons" : "";
                    $out .=  '<div class="'.$is_cons_class.'">';
                      $out .=  "<div class='abbr'>". $p['meta']['partner_abbr'][0] ."</div>";
                      $out .=  "<div class='name'><h4>".$p['post']->post_title."</h4></div>";
                      $out .=  "<div class='country'>". $p['country'] ."</div>";
                      // if ($p['is_cons']) {
                      //   $out .= $this->internal_acc($p);
                      // }
                      $abr = is_array($p['meta']['partner_abbr']) ? $p['meta']['partner_abbr'][0] : "";
                      $cons .= $this->listing_logo_item($p['post'],$abr);
                    $out .=  '</div>';
                  }
                $out .=  '</div>';
          $out .=  '</div>';
    }
    $out .=  '</div>';
    $out .=  '</section>';

    $cons .=  '</div>';
    $cons .=  '</section>';
    /* 
    * now do partners listing 
    */



   return $out . $cons;
  }



  /* with image */
  function listing_logo_item($post, $abr) {


      $imgMarkup = get_the_post_thumbnail($post,'medium');
       /* replacing wp default image markup */
       $imgMarkup = preg_replace('/height=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/width=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/class=[\"\'][a-zA-Z0-9-_ ]+[\"\']/i', 'class="lazyload"', $imgMarkup);
       $imgMarkup = str_replace("srcset", "data-srcset", $imgMarkup);
       $sizes = 'sizes="(max-width: 100vw) 300px, 300px"';
       $imgMarkup = preg_replace('/sizes="(.+?)"/i', $sizes, $imgMarkup);

      $out = "";
      $out .=  '<div class="small-6 medium-3 cell ">';
       $out .=  ' <figure>'.$imgMarkup.'</figure>';
       $out .=  "<h3 class='serif'>".$abr."</h3>";
       $out .=  "<h3>".$post->post_title."</h3>";
       $out .=  '<a class="vp" href="'.get_the_permalink($post->ID).'" class="vm"><span>'.__("View more","yours").'</span></a>';
      $out .=  '</div>';
  
    return $out;
  }

  function internal_acc($p) {
    $cons = '';

    // $cons .=  '<section class="grid-container partner-cons" >';
    // $cons .=  ' <div class="grid-x">';
        // var_dump($p->meta);
          $cons .=  '<div class="grid-x grid-padding-x inner ">';
            $cons .=  '<div class="small-6 medium-4 cell">';
              $cons .=  $p['img'];
            $cons .=  '</div>';
           

            $cons .=  '<div class="cell small-6 medium-4 ">';
              $cons .=  '<div>';
                  $cons .=  '<b>';
                  $cons .=  __("Project description:","yours");
                  $cons .=  '</b>';
                  $cons .=  $p['meta']['partner_cons_desc'][0];
              $cons .=  '</div>';
              $cons .=  '<div>';
                  $cons .=  '<b>';
                  $cons .=  __("Contact details:","yours");
                  $cons .=  '</b>';
                  $cons .=  $p['meta']['partner_cons_contact'][0];
              $cons .=  '</div>';
              $cons .=  '<a class="vp" href="'.get_the_permalink($p['post']->ID).'" onclick="this.parentNode." class="lazyload vm">View more</a>';
            $cons .=  '</div>';
          $cons .=  '</div>';



    // $cons .=  '</div>';
    // $cons .=  '</section>';

    return $cons;

  } 

}



        
