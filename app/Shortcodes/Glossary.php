<?php
namespace Yours\Plugin\Shortcodes;
use Yours\Plugin\Plugin;

class Glossary extends Plugin
{

  public function __construct() {

    // Usage: [hello name="Daniel"]
    if ( ! shortcode_exists( 'glossary' ) ) {
        add_shortcode( 'glossary', array( $this, 'shortcode' ) );
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
    $terms = get_terms( 'glossary-splits', array(
        'hide_empty' => false,
          'orderby' => 'name',
          'order' => 'ASC' 
    ) );
    
 
    // $args = helper_shortcode_attr_to_query_options(['id'=>"all"]); 
    $args = array();
    $args['posts_per_page']=-1;
    $args['post_type'] = array('glossary');
    $args['orderby'] = 'title';
    $args['order'] = 'ASC';
    $loop = new \WP_Query( $args );
    

    $orderedposts =array();
    foreach ($loop->posts as $p) {
      // var_dump(get_term( $term, $taxonomy = '', $output = OBJECT, $filter = 'raw' )
      $firstterm = wp_get_post_terms( $p->ID, 'glossary-splits');
      if (is_array($firstterm) && !empty($firstterm)) {
        $orderedposts[$firstterm[0]->name][]=$p;
      }
    }
    ksort($orderedposts);

    if (!empty($orderedposts['References'])) {
      $ref = $orderedposts['References'];
      unset($orderedposts['References']);
      $orderedposts['References'] = $ref;
    }


    $out = '';
      $out .=  '<section class="grid-container glossary" >';
      $out .=  ' <div class="accordion grid-x "  data-multi-expand="true" data-deep-link="true" data-update-history="true"  data-allow-all-closed="true">';
    foreach ($orderedposts as $key => $value) {
          $out .=  '<div class="small-12 cell accordion-item" data-accordion-item>';
                $out .=  '<a class="accordion-title">';
                $out .=  "<h3>".$key."</h3>";
                $out .=  '</a>';
                $out .=  '<div class="accordion-content" data-tab-content>';
                  foreach ($value as $post) {
                    $out .=  "<div class='gloss'><h4>".$post->post_title."</h4>";
                    $out .=  "<p>".$post->post_content."</p></div>";
                  }
                $out .=  '</div>';
          $out .=  '</div>';
    }
    $out .=  '</div>';
    $out .=  '</section>';
    return $out;
    
  }

}



        
