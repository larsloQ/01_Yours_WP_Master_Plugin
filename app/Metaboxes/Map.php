<?php 
namespace Yours\Plugin\Metaboxes;
use Yours\Plugin\Plugin;
/* 
LFK 2019-12-22_14.07.55
Register metaboxes. 
As far as i know, CMB2 boxes can not be wired good into Blocks. But the classical setup still works fine.
Set metaboxes to sidebar or below the editor
For wiring Metafields with boxes see /Blocks/Template.php
*/

class Map extends Plugin {

  private $posttype= ["post","page","casestudy","contribute","partner","team"];


  public function __construct() {

    // add_action( 'cmb2_init', array($this,'sidebar_box') );
    add_action( 'cmb2_init', array($this,'meta_box') );
    add_action('init', array($this,"register_block_meta"));
  }

  /*
  */


  private static $instructions = "
    <p>With this box you can set a position and info about where this entity is located.</p>
    <b>Changes in this Box are not reflected immediately in the Map-Block.</b><br>
    To update, click <b>'Save'</b> and <b>reload page</b></p>.
  ";
/* 
register fields for gutenberg
also set show_in_rest = true on field reg
check it like so 
wp.data.select( 'core/editor' ).getCurrentPost().meta;
*/
function register_block_meta() {
    register_post_meta( '', 'location', array(
        // 'show_in_rest' => true,
        // 'single' => true,
        'show_in_rest' => array(
             'schema' => array(
                 'type'       => 'object',
                 'properties' => array(
                     'latitude' => array(
                         'type' => 'string',
                     ),
                     'longitude'  => array(
                         'type' => 'string',
                     ),
                 ),
             ),
         ),
    ) );
    register_post_meta( '', 'geojson', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string'
    ) );
    register_post_meta( '', 'map_active', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string'
    ) );
    
}




  function meta_box(){

    $mapField = new MapsField\MapsField();

    $name = "map_pin";
    $prefix = '';
    $cmb = new_cmb2_box( array(
      'id'            => $name."_meta",
      'title'         => __( 'Maps', 'yours' ),
          'object_types'  => $this->posttype, // Post type
          'context'      => 'normal', //  'normal', 'advanced', or 'side'  * 'form_top', 'before_permalink', 'after_title', 'after_editor'
          'priority'   => 'high',
          'closed'     => false,
         //   array( 
         //    '__block_editor_compatible_meta_box' => false,
         //    '__back_compat_meta_box'             => true,
         // ),
         //    '__block_editor_compatible_meta_box' => false,
    ) ) ;

    $cmb->add_field( array(
      'name' => 'Activate Map',
      'desc' => 'Tick on to activate map. When active a position is set',
       'id' => $prefix . 'map_active',
       'type' => 'checkbox',
           // 'show_in_rest' => true, 
          // 'single' => true,
        // [
        //    'show_in_rest' => true,
        //   'single' => true,
        //   'type' => 'string',
        // ]
       // "default"=>"on"
    ) );
     $cmb->add_field( array(
    // 'name' => 'Beginnig Letter',
     'before_row'     => self::$instructions,
      // 'description' => __( 'Beginnig Letter', 'yours' ),
      'id'   => $prefix .'inst',
      'type' => '',
      'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => '',
        ),
      // 'show_in_rest' => false,
    ));

    //   $cmb->add_field( array(
    //   'name' => 'Notes',
    //   'description' => __( 'please add some notes here, i.e. location not found, and other irregularities', 'yours' ),
    //   'id'   => 'notes',
    //   'show_in_rest' => true,
    //   'type'    => 'textarea',
    //   'attributes'    => array(
    //         'data-conditional-id'     => 'map_active',
    //         // 'data-conditional-value'  => 'on',
    //     ),
    // ));

    $cmb->add_field( array(
      'name' => 'Address',
      'description' => __( '', 'yours' ),
      'id'   => 'address',
      'show_in_rest' => true,
      'type'    => 'textarea',
      'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => 'on',
        ),
    ));
    $cmb->add_field( array(
      'name' => 'Location',
      'desc' => 'Drag the marker to set the exact location. This Map is only for setting 1 Location. Its NOT the map showed on page',
        'id' => $prefix . 'location',
        'type' => 'pw_map',
       'show_in_rest' => true,
        'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => '',
        ),
    // 'split_values' => true, // Save latitude and longitude as two separate fields
    ) );

    $cmb->add_field( array(
      'name'           => 'Macro Region',
      // 'desc'           => 'Select Macr',
      'id'             => 'macro_region',
      'taxonomy'       => 'macro-region', // Enter Taxonomy Slug
      'type'           => 'taxonomy_radio',
      // Optional :
      'show_in_rest' => true,
      'text'           => array(
        'no_terms_text' => 'Sorry, no terms could be found.' // Change default text. Default: "No terms"
      ),
        // 'attributes'    => array(
        //     'data-conditional-id'     => 'map_active',
        //     // 'data-conditional-value'  => '',
        // ),
      'remove_default' => 'true', // Removes the default metabox provided by WP core.
      // Optionally override the args sent to the WordPress get_terms function.
      // 'query_args' => array(
      //   // 'orderby' => 'slug',
      //   // 'hide_empty' => true,
      // ),
    ) );

    $cmb->add_field( array(
      'name' => 'No Link in Map',
      'description' => __( 'When ticked on we do NOT show a link in map. This is because we have many Case-Studies which only exists in maps and not as a page on liaison2020.eu', 'yours' ),
      'id'   => $prefix .'nolink',
      'type' => 'checkbox',
      // 'default_cb' => __('not in map',"yours"),
      'show_in_rest' => true,
      'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => '',
        ),
    ));

    $cmb->add_field( array(
      'name' => 'external Link/URL to Website',
      'description' => __( 'with http(s)://', 'yours' ),
      'id'   => $prefix .'url',
      'type' => 'text_url',
        // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
      // 'default_cb' => __('not in map',"yours"),
      'show_in_rest' => true,
      'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => '',
        ),
    ));

    $cmb->add_field( array(
      'name' => 'Map Marker Text',
      'description' => __( 'The text/content shown when someone clicks on the pin in the map, usually a short description', 'yours' ),
      'id'   => 'pin_desc',
      'show_in_rest' => true,
      'type'    => 'wysiwyg',
       // 'attributes'    => array(     ),
      'options' => array(
          'wpautop' => false, // use wpautop?
          'media_buttons' => false, // show insert/upload button(s)
          'textarea_name' => '', // set the textarea name to something different, square brackets [] can be used here
          'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
          'tabindex' => '',
          // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
          // 'editor_class' => 'extra', // add extra class(es) to the editor textarea
          'teeny' => true, // output the minimal editor config used in Press This
          'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
          'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
          'quicktags' => false, // load Quicktags, can be used to pass settings directly to Quicktags using an array()
            'data-conditional-id'     => 'map_active', 
            // 'data-conditional-value'  => 'on',
        ),
    ));


    $cmb->add_field( array(
      'name' => 'Contact Person',
      'description' => __( '', 'yours' ),
      'id'   => 'contact_person',
      'show_in_rest' => true,
      'type'    => 'textarea',
      'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => 'on',
        ),
    ));

    $cmb->add_field( array(
      'name' => 'Contact Person E-Mai;',
      'description' => __( '', 'yours' ),
      'id'   => 'contact_mail',
      'show_in_rest' => true,
      'type'    => 'text_email',
      'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => 'on',
        ),
    ));

    $cmb->add_field( array(
      'name' => 'GeoJson',
      'description' => __( 'Paste some geojson here. You can get them from ', 'yours' ),
      'id'   => 'geojson',
      'show_in_rest' => true,
      'type'    => 'textarea',
      'attributes'    => array(
            'data-conditional-id'     => 'map_active',
            // 'data-conditional-value'  => 'on',
        ),
    ));

     // $cmb->add_field( array(
     //  'name'    => 'Icon Color',
     //  'description' => __( 'Change the default color of Pin', 'yours' ),
     //  'id'      => 'icon_color',
     //  'type'    => 'colorpicker',
     //  'default' => '#278f18',
     //  'attributes' => array(
     //      'data-colorpicker' => json_encode( array(
     //          // Iris Options set here as values in the 'data-colorpicker' array
     //          'palettes' => array( '#278f18', '#63d156'),
     //      ) ),
     //        'data-conditional-id'     => 'map_active',
     //        // 'data-conditional-value'  => 'on',
     //  ),
     //  ));

  }






}
