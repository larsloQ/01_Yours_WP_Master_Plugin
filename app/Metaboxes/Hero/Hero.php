<?php

namespace Yours\Plugin\Metaboxes\Hero;
use Yours\Plugin\Plugin;

/* 
not only metabox but also shortcodes are defined here...
leave that for now
LFK 2020-01-04_15.17.26
*/

class Hero extends Plugin 
{

  static $config = [
   "prefix" => 'hero_',
   // "ImageFieldsCMB2" => array() // fields defs are in __DIR__."/image_cmb2_fields_sky_pano.php"
  ];

  public function __construct() {
  
     require(__DIR__."/getImageFieldsCMB2.php");
     require(__DIR__."/getTextFieldsCMB2.php");
     add_action( 'cmb2_admin_init', array(__CLASS__, 'add_metabox'));
      add_shortcode( 'hero', array(__CLASS__,"shortcode_hero"));
      add_shortcode( 'opener', array(__CLASS__,"shortcode_hero"));
    }

    function add_metabox() {
     
    // require(__DIR__."/js_field_require_validation.php");
      $prefix = self::$config['prefix'];

      $box = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Hero', 'cmb2' ),
        'object_types'  => array( 'page','post' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'closed'        => false
        //'cmb_styles'    => false, // false to disable the CMB stylesheet
      )
    );
    

      $imageFields = getImageFieldsCMB2($prefix);
      /*adding image fields */
      $box->add_field($imageFields['sky']);
      //panorama field
      $box->add_field($imageFields['pano']);
      // $box->add_field(getTextFieldsCMB2(self::$config['prefix'])['background_color']);
       // editor
      $box->add_field(getTextFieldsCMB2(self::$config['prefix'])['text']);

    }



private function get_markup_for_one ($mediaIDSky, $mediaIDPano) {
   $sky_metadata = wp_get_attachment_metadata($mediaIDSky);
  // $data_sky = $ratio2 > 100 ? "sky" : "land";
  $ratio_sky = ($sky_metadata['height']/$sky_metadata['width']) * 100;
  if (isset($sky_metadata)) {
      $sourceStringSky = '';
      $sky_sourceset = self::hero_get_srcset_for_picture_source(array("sky_400","sky_600","sky_1000"),$sky_metadata,"portrait");
      for ($i=0; $i < count($sky_sourceset['srcset']); $i++) { 
        $sourceStringSky .= " <source 
        media='".$sky_sourceset['media'][$i]."' 
        data-srcset='".$sky_sourceset['srcset'][$i]."' 
        />
        ";
      }
  }
  /* the landscape , this needs to be repeated for other (pano image)*/
  $sourceStringpano = '';
 
    
    $pano_img_id = $mediaIDPano;
    $pano_metadata = wp_get_attachment_metadata($pano_img_id);

    // $data_pano = $ratio2 > 100 ? "sky" : "land";
    $ratio_pano = ($pano_metadata['height']/$pano_metadata['width']) * 100;
    $pano_sourceset = self::hero_get_srcset_for_picture_source(array("medium_480","medium_large","large","large_1200","large_2000"),$pano_metadata,"landscape");
    for ($i=0; $i < count($pano_sourceset['srcset']); $i++) { 
      $sourceStringpano .= " <source 
          media='".$pano_sourceset['media'][$i]."' 
          data-srcset='".$pano_sourceset['srcset'][$i]."' 
        />
      ";
    }
  
          // class='lazyload ' 
  $has_full= $sourceStringpano!==""?"has_full":"";
  $style = "";
    $imageMarkup = "
    <picture alt='decoration' class='hero_picture half $has_full' >
       <!--[if IE 11]><video style='display: none;'><![endif]-->
      $sourceStringSky 
      <!--[if IE 11]></video><![endif]-->
      <img 
      alt='decorative'
      class='lazyload'
      data-src='".$sky_sourceset['default']."' 
      >
      <noscript><img src='".$sky_sourceset['default']."' /></noscript>
    </picture>";
    if ( $sourceStringpano ) {
      $imageMarkup .= "
    <picture alt='decoration' class='hero_picture full ' >
       <!--[if IE 11]><video style='display: none;'><![endif]-->
      $sourceStringpano 
       <!--[if IE 11]></video><![endif]-->
      <img 
      alt='decorative'
      class='lazyload'
      data-src='".$pano_sourceset['default']."' 
      >
      <noscript><img src='".$pano_sourceset['default']."' /></noscript>
    </picture>";
    }
 
    $extraclass="";
    $style="";
    $ratio_land="";
    $overtext = "";


    $markupImage = "
    <div class='img-wrap $extraclass' style='$style' data-ratio-sky='$ratio_sky' data-ratio-land='$ratio_land' >
    $imageMarkup 
    $overtext
    </div>";

    return $markupImage;

}

 /** shortcode
  * hero []
  * opener []
  *
  *
  * @return     string  ( description_of_the_return_value )
  */
 public static function shortcode_hero () { 

  global $post;

  $lines = "";//file_get_contents(__DIR__."/svg/neurologie-am-tauentzien-lines.svg");
  /*
   *hero_sky  (image)
   *hero_pano (image)
   *hero_text (wysiwyg)
   */

  /* the portrait-sky-image , this needs to be repeated for other (pano image)*/
  $sky = get_post_meta( $post->ID, 'hero_sky',true);
  $pano = get_post_meta( $post->ID, 'hero_pano',true);
  if (count($sky) !== count($pano)) {return;}
  if ($sky == "" || count($sky) == 0 ) return; // sky image is mandatory


  $markupImages = "";
  $count = 0;
  foreach ($sky as $key => $value) {
    $sky_img_id = $key;
    $pano_img_id = array_keys($pano)[$count];
    // $markupImages .= '<div class="slide">';
    $markupImages .= self::get_markup_for_one($sky_img_id, $pano_img_id);
    // $markupImages .= '</div>';
    $count++;  
  }
    /*
     *
     * output of the text things !!!
     *
     */
    $text = get_post_meta( $post->ID, 'hero_text',true);
    // var_dump($transparency);
    $color = get_post_meta( $post->ID, 'hero_background_color',true);
    $padding = get_post_meta( $post->ID, 'hero_padding',true);
    // $text_style = $color !== "" ? "background-color:$color": "";
    $text_style = "";
    // var_dump($color,$transparency, $text_style);
    $markupText = "<div class='text-wrap' style='$text_style'><div>". apply_filters('the_content', $text)."</div></div>";
    /* hero closes a section and opens a full width section*/

    /* MARKUP FOR SLIDEHSOW NOT WORKING*/
 /*   $heroMarkup = "</section><section class='grid-container full hero-container'>";
    $heroMarkup .= "<section class='slideshow-wrapper-wrapper' >";
    $heroMarkup .= "<div class='slideshowwrap'>";
    $heroMarkup .= "<div class='carou'>";
    $heroMarkup .= "<div class='hero $has_full'>".$markupImages.$markupText;
    $heroMarkup .= '</div>';
    $heroMarkup .= '</div>';
    $heroMarkup .= '</div>';*/
       $heroMarkup = "</section><section class='grid-container full hero-container'>";
    $heroMarkup .= "<div class='hero $has_full'>".$markupImages.$markupText;
    $heroMarkup .= '</div>';
    /* button down*/
    $heroMarkup .= '<a class="down-more" onclick="window.downMoreScroll()"></a>'; 
    // lines animation
    $heroMarkup .= '<div class="lines">'.$lines.'</div>';
    $heroMarkup .= "</section><section class='grid-container after_hero'>";


    return $heroMarkup;
  }




  /**
   * 
   * !!! this can not be used for every setup !!!
   * this is not trivial, function prepare srcset for modern browsers
   * for usage inside a <picture><source> element
   *
   * @param      <Array>  $image_sizes          different image sizes
   * @param      <type>  $attachment_metadata  wp attachment metadata
   * @param      string  $orientation          The orientation (portrait or landscape)
   *
   * @return     array   ( description_of_the_return_value )
   */
  private static function hero_get_srcset_for_picture_source (Array $image_sizes, $attachment_metadata, $orientation = "portrait") {
    $srcset = [];
    $media = [];//"(orientation: " .  $orientation . ")";
    $dirname = _wp_get_attachment_relative_path( $attachment_metadata['file'] );
    $dirname = trailingslashit( $dirname );
    $upload_dir = wp_get_upload_dir();
    $image_baseurl = trailingslashit( $upload_dir['baseurl'] ) . $dirname;
    
    foreach ($image_sizes as $size) {
      if (!empty($attachment_metadata['sizes'][$size])) {
        $it = $attachment_metadata['sizes'][$size];
        $srcset[] = $image_baseurl . $it['file'] . " " . $it['width']. "w";
        // $media[] = "(orientation: " .  $orientation . ") and (max-width: " . $it['width'] . "px)";
        /* this is tricky media query responsive image */
        $media[] = "(max-width: " . ($it['width']+ 10) . "px)";
      }
    } 
    $default = $upload_dir['baseurl'] ."/". $attachment_metadata['file'];
    /* add default*/
    $srcset[] =  $default;
    $media[] = "(orientation: " .  $orientation . ")";
    /* this can not be used for every setup
     on neuro steiner, there are images uploaded in a size of 3000x2000 pixel which get loaded on full screen
     following switch tries to prevent this
     */
    if ( $orientation==="portrait" && !empty($attachment_metadata['sizes']["sky_1000"]) ) {
      $default = $image_baseurl . $attachment_metadata['sizes']["sky_1000"]['file'] ;
    }
    return [
      "media"=> $media,
      "srcset"=> $srcset,
      "default" => $default
    ];
}


} // class



