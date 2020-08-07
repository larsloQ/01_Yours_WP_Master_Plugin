<?php
namespace Yours\Plugin\Helpers;
use Yours\Plugin\Plugin;

class Helpers  {
  private static $initialized = false;

 private static function initialize()
    {
        if (self::$initialized)
            return;
        self::$initialized = true;
    }

  /**
   * media id is wp attachment id (image id)
  */ 
  public static function media_id_to_srcset($media_id)
    {
       var_dump($media_id);
    }



    /* this is incomple, for now using wp functions */
    public static function get_picture_markup($mediaID,$max_media_size="medium_large"){
      $mediaSrcset = wp_get_attachment_image_srcset( $mediaID, $max_media_size);
    /*  $sourceString .= " <source 
          media='".$pano_sourceset['media'][$i]."' 
          data-srcset='".$pano_sourceset['srcset'][$i]."' 
        />
      ";*/
/*      $pictureMarkup = "
         <picture alt='decoration' class='hero_picture full ' >
           <!--[if IE 11]><video style='display: none;'><![endif]-->
          $sourceStringpano 
           <!--[if IE 11]></video><![endif]-->
          <img 
          alt='decorative'
          class='lazyload'
          data-src='".$mediaSrcset."' 
          >
          <noscript><img src='".self::get_default_img($mediaID)"' /></noscript>
        </picture>";*/
    }


    public static function srcset_markup_for_featured_media($post,String $media_size="medium_large"){
      $imgMarkup = get_the_post_thumbnail($post,'medium_large');
       /* replacing wp default image markup */
       $imgMarkup = preg_replace('/height=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/width=[\"\'][0-9]+[\"\']/i', '', $imgMarkup);
       $imgMarkup = preg_replace('/class=[\"\'][a-zA-Z0-9-_ ]+[\"\']/i', 'class="lazyload"', $imgMarkup);
       $imgMarkup = str_replace("srcset", "data-srcset", $imgMarkup);
       return $imgMarkup;
    }


    public static function get_default_img($mediaID)
    {
      $metadata = wp_get_attachment_metadata($mediaID);
      $dirname = _wp_get_attachment_relative_path( $metadata['file'] );
      $dirname = trailingslashit( $dirname );
      $upload_dir = wp_get_upload_dir();
      $image_baseurl = trailingslashit( $upload_dir['baseurl'] ) . $dirname;
      return $image_baseurl;
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
  private static function get_srcset_for_picture_source (Array $image_sizes, $attachment_metadata, $max_media_size="medium_large", $orientation = "portrait") {
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
     on xxx , there are images uploaded in a size of 3000x2000 pixel which get loaded on full screen
     following switch tries to prevent this
     */
    if ( $orientation==="portrait" && !empty($attachment_metadata['sizes'][$media_size_default]) ) {
      $default = $image_baseurl . $attachment_metadata['sizes'][$media_size_default]['file'] ;
    }
    return [
      "media"=> $media,
      "srcset"=> $srcset,
      "default" => $default
    ];
  }


  }


