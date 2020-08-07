<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;

class PostTypes_Loader extends Plugin {

  /**
   * @var array Shortcode class name to register
   * @since 0.4.0
   */
  protected $posttypes;

  public function __construct() {

    $this->posttypes = array(
      // Clients::class,
      Team::class,
      Glossary::class,
      RelatedProjects::class,
      CaseStudy::class,
      Attachment::class,
      Partner::class,
      Post::class,
      Links::class,
      Mail::class,
    );

    foreach( $this->posttypes as $postTypesClass ) {
      if( class_exists( $postTypesClass ) ) new $postTypesClass();
    }

  }

}
