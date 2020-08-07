<?php
namespace Yours\Plugin\PostTypes;
use Yours\Plugin\Plugin;

class Post extends Plugin {

  

  public function __construct() {

    add_action( 'admin_init', function(){
        /* this is required to have menu_order in posts*/
        add_post_type_support( 'post', 'page-attributes' );
    });
  }

}
