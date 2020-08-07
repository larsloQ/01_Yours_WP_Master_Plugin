<?php
namespace Yours\Plugin\Shortcodes;
use Yours\Plugin\Plugin;

class CaseStudies extends Plugin
{

  public function __construct() {

    // Usage: [hello name="Daniel"]
    if ( ! shortcode_exists( 'casestudies' ) ) {
        add_shortcode( 'casestudies', array( $this, 'shortcode' ) );
    }
 if ( ! shortcode_exists( 'casestudy' ) ) {
        add_shortcode( 'casestudy', array( $this, 'shortcode' ) );
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
    // $terms = get_terms( 'partner-type', array(
    //     'hide_empty' => false,
    //       'orderby' => 'name',
    //       'order' => 'ASC' 
    // ) );
    // var_dump($terms);
    // foreach ($terms as $term) {
    //    $meta = get_term_meta($term->term_id);
    //    $colorcode ="";
    //    if($meta['partner_type_color'] && $meta['partner_type_color'][0]) {
    //        $term->color = $meta['partner_type_color'][0];
    //    }    
    // }

    

    // $args = helper_shortcode_attr_to_query_options(['id'=>"all"]); 
    // $args = array();
    $args['posts_per_page']=-1;
    $args['status']='publish';
    $args['post_type'] = array('casestudy');
    $args['meta_query'] = array(
      'relation' => 'OR',
      array(
          'key' => 'casestudy_number', 
          'compare' => 'NOT EXISTS'
      ),
      array(
          'key' => 'casestudy_number', 
          'compare' => 'EXISTS'
      ),
    );
    $args['orderby'] = 'casestudy_number';
    // $args['meta_key'] = 'casestudy_number';
    $args['order'] = 'ASC';

   
    $loop = new \WP_Query( $args );
    

    /* need to run through and order empty values*/
    $orderedPosts = $loop->posts;

    /* walk through posts and add them into tax order*/
    foreach ($orderedPosts as $p) {
        $num = get_post_meta($p->ID,"casestudy_number",true);
        $num = intval($num)>0 ? intval($num) : PHP_INT_MAX;
        $p->order = $num;
    }
    uasort ( $orderedPosts , function($a,$b) {
      if ($a->order == $b->order) {
        return 0;
      }
      return ($a->order < $b->order) ? -1 : 1;
    } );



    $out = '';
    $out .=  '<section class="grid-container glossary casestudies" >';
    $out .=  '<div class="accordion grid-x "   data-allow-all-closed="true">';
    $out .=  '<div class="small-12 cell accordion-item is-active" data-accordion-item>';
        $out .=  '<a class="accordion-title">';
        $out .=  "<h3 style='color:#464646'>".__("Please find all case studies here","yours")."</h3>";
        $out .=  '</a>';
        $out .=  '<div class="accordion-content" data-tab-content>';
                $out .='<table class="casestudies">';
                    $out .='<thead>';
                        $out .='<tr>';
                            $out .='<th>';
                                $out .= "Number";
                            $out .='</th>';
                            $out .='<th>';
                                $out .= "Name";
                            $out .='</th>';
                            $out .='<th>';
                                $out .= "Partner";
                            $out .='</th>';
                            $out .='<th>';
                                $out .= "Type";
                            $out .='</th>';
                            $out .='<th>';
                                $out .= "Activity";
                            $out .='</th>';
                        $out .='</tr>';
                    $out .='</thead>';
                    $out .='<tbody>';
                    $count = 1;
                          foreach ($orderedPosts as $p) {
                            $type =  get_the_terms( $p->ID, "casestudy-type");
                            $number =  get_post_meta( $p->ID, "casestudy_number", true);
                            $list = implode(", ",array_map(function($i){return $i->name;}, $type));
                                $out .='<tr>';
                                    $out .='<td>';
                                    $out .= $number;
                                    $out .='</td>';
                                    $out .='<td>';
                                    $out .= '<a href="'.get_the_permalink( $p->ID).'">'. $p->post_title . '</a>';
                                    $out .='</td>';
                                    $out .='<td>';
                                    $out .= get_post_meta($p->ID,"casestudy_abbr",true);
                                    $out .='</td>';
                                    $out .='<td>';
                                    $out .= $list;
                                    $out .='</td>';
                                    $out .='<td>';
                                    $out .= get_post_meta($p->ID,"casestudy_case_activity",true);
                                    $out .='</td>';
                               $out .='</tr>';
                               $count++;
                           // $postterms =  wp_get_post_terms( $p->ID, "partner-type" );
                           // $countryterms =  wp_get_post_terms( $p->ID, "partner-country" );

                           // $meta = get_post_meta($p->ID);
                           // $is_cons = $meta['partner_is_cons'][0];
                          //  if ($is_cons == 'on') {
                          //       $mediaURL = get_the_post_thumbnail_url($p->ID,"medium_large");
                          //       $p->logo = $mediaURL;
                          //       $p->meta = $meta;
                          //       $consortium_posts[] = $p;

                          //  }
                          //  // we take only one / first
                          // foreach ($terms as $index => $term) {
                          //   if ($postterms[0]->term_id == $term->term_id) {
                          //       $orderedposts[$term->name][] = [
                          //           'post'=>$p,
                          //           'meta'=>$meta,
                          //           'country'=>$countryterms[0]->name,
                          //           'color'=>$term->color
                          //       ];
                          //   }
                          // }
                        }
                      $out .='</tbody>';
                    $out .='</table>';
            $out .=  '</div>'; // end acc content
            $out .=  '</div>'; // end acc item
            $out .=  '</div>'; // end acc
    $out .=  '</section>';              
    
    return $out;// . $cons;

  }

}



        
