<?php
namespace Yours\Plugin\Shortcodes;
use Yours\Plugin\Plugin;

class Shortcode_Loader extends Plugin {

  /**
   * @var array Shortcode class name to register
   * @since 0.3.0
   */
  protected $shortcodes;

  public function __construct() {

    $this->shortcodes = array(
      Glossary::class,
      Partner::class,
      CaseStudies::class,
      Team::class,
      Links::class,
      RelatedProjects::class,
      Mail::class,
    );

    foreach( $this->shortcodes as $shortcodeClass ) {
      if( class_exists( $shortcodeClass ) ) new $shortcodeClass();
    }

  }

}
