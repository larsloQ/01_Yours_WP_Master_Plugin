<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;
// use Carbon_Fields\Container;
// use Carbon_Fields\Field;
use PostTypes\PostType;

/* adding taxos to media / attachment 
Document Type
Country
Language
Thematic Field
*/
    /* 
      we can not add admin columns to media / attachment CPT (since it weird parent/child thing) 
      for doing so we use a plugin called media-library-assistant
      but we define all tax/cats here/.
    */
class Attachment extends Plugin {


  /* Country tax is already added by an other CPT. */
  private $posttype="attachment";
  private $taxslugs =['doctype','language', 'thema','country'];


  public function __construct() {
    add_action( 'init', array($this,'add_tax') );
  }

 
  public function add_tax() {
   
    $taxslugs = $this->taxslugs;
    $pt = $this->posttype;
    foreach ($taxslugs as $tax) {
      register_taxonomy_for_object_type($tax,$pt);
    }
  }





}
