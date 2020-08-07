<?php 
namespace Yours\Plugin\Metaboxes\Hero;

/*
  background taxonomy_radio_inline
  padding (t,r,b,l)
  
*/
function getTextFieldsCMB2 ($prefix="_"){

  $colors = [
  "#FFF",
  '#464646', // _settings.scss grau3
  '#FA6602', //$orange:
  "#AC3209", //red
  ];

  return array(
    "background_color" => array(
        'name'    => 'Hintergrund Farbe',
        'id'      => $prefix.'background_color',
        'type'    => 'colorpicker',
        'default' => '#ffffff',
        'description' => __( 'Auf kleinen Bildschirmen oder wenn ein Panorama-Bild verwendet wird, erscheint der Text über dem Bild. Hier braucht es eine Hintergrundfarbe. Bitte nur die Vorschläge verwenden', 'cmb2' ),
        'options' => array(
         'alpha' => true, // Make this a rgba color picker.
        ),
        'attributes' => array(
         'data-colorpicker' => json_encode( array(
           'palettes' => $colors,
         ) ),
       ),
    ),
    // "transparency" => array(
    //     'name'          => 'Hintergrund Transparenz',
    //     'id'          => $prefix .'transparency',
    //     'type'        => 'text_money',
    //     'before_field' => ' ', // Replaces default '$'
    //     'description' => __( 'Werte von 0 bis 100, je höher desto transparenter', 'cmb2' ),
    // ),
    "padding" => array(
        'name'          => 'Extra Innenabstand',
        'id'          => $prefix .'padding',
        'type'        => 'checkbox',
        'description' => __( 'Anwählen und Hero-Bereich anlegen. <br>
          Mittels dem Shortcode [hero] den Block in den Haupteditor einfügen ', 'cmb2' ),
    ),
    "text" => array(
        'name'    => __( 'Text', 'cmb2' ),
        'id'      => $prefix .'text',
        'type'    => 'wysiwyg',
        // 'description' => __( 'Dieser Text erscheint neben / über dem Bild <br>
        //   Hier bitte eine <b>H1</b>-Überschrift verwenden.', 'cmb2' ),
        'description' => __( 'This text appears above the image in a turquoise circle.<br>
          Use a <b>H1</b>-Headline here and a very-short <b>paragraph</b>.', 'cmb2' ),
        'options' => array(
          'wpautop' => false, // use wpautop?
          'media_buttons' => false, // show insert/upload button(s)
          'textarea_name' => '', // set the textarea name to something different, square brackets [] can be used here
          'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
          'tabindex' => '',
          // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
          // 'editor_class' => 'extra', // add extra class(es) to the editor textarea
          'teeny' => false, // output the minimal editor config used in Press This
          'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
          'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
          'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
        'after_field' => '<input name="only_for_conditional" type="hidden" data-conditional-id="'. $prefix . 'has_hero'.'" >',
       //  'attributes' => array(
       //   'data-conditional-id' => $prefix . 'has_hero',
       //   'required' => true,
       // ),
      )
  );
}

