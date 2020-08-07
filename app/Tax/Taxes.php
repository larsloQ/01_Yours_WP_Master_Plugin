<?php
namespace Yours\Plugin\Tax;
use Yours\Plugin\Plugin;

use WPBP\CPT_COLUMNS\CPT_columns as CPT_columns;
use WP_CUSTOM_BULK_ACTIONS\Seravo_Custom_Bulk_Action as Seravo_Custom_Bulk_Action;


/* Central Registration of Taxonomies */

class Taxes extends Plugin {
  private $taxos = [
    'doctype',
    'language',
    'thema',
    'country',
    'casestudy-type',
    'glossary-splits',
    'partner-type',
    'macro-region',
    "for-maps-only"
    // 'team-cat'
  ];
  private $names = [
    'Document Type',
    'Language',
    'Thematic Field',
    'Country',
    'Casestudy Type',
    'Glossary Splits',
    'Parner Type',
    'Macro-Region',
    'For Maps Only'
    // 'Team Cat',
  ];

  private $desc = [
    'partner-type' => "The item will be display only in one of these categories",
    'macro-region' => "The item will be display only in one of these categories",
  ];
  private $exclusive = [
    'partner-type',
    'macro-region'
  ];

  public function __construct() {
    add_action( 'init', array($this,'register_taxes') );
        add_action( 'cmb2_init', array($this,'add_taxonomy_metabox') );

  }



  public function register_taxes() {
    $taxos = $this->taxos;
    $names = $this->names;
    $count = 0;
    foreach ($taxos as $tax) {
      register_extended_taxonomy( $tax, null, array(
        /* default options https://developer.wordpress.org/reference/functions/register_taxonomy/*/
         'hierarchical' => true,
         'show_ui' => true,
         'show_admin_column'=>true,
         'slug'             => $tax,
         'show_in_rest'     => true,
         'show_in_menu' => true,
         'show_in_nav_menus' => false,
         'show_in_quick_edit' => true,
         'show_admin_column' => true,
         'exclusive' => in_array($tax,$this->exclusive),
         "description" => in_array($tax,$this->desc) ? $this->desc[$tax] : "",
         // 'meta_box'         => 'simple', // radio,simple,dropdown
          /* only for partner type */
         'admin_cols' => array(
          'color' => array(
            'title' => 'Color',
            'meta_key' => 'partner_type_color',
            // 'required' => true,
            'function'    => function($id ) {
              $colval = get_term_meta( $id, 'partner_type_color', $single = true );
              echo "<div style='width:30px;height:30px;background-color:".$colval."'></div>";
            }
          )), 
       ),
         array(
           // Override the base names used for labels:
           'singular' => __( $names[$count], "yours" ),
           'plural'   => __( $names[$count], "yours" ),
         )
      );
      $count++; 
    }
  }


   /* add a cmb2 meta box to term/ taxonomy partner-type
  its the color box
   */
  function add_taxonomy_metabox(){
    $args = [
    'id'           => 'type_color',
    'object_types' => [ 'term' ],
    'taxonomies'   => [ 'partner-type' ]
  ];

    $cmb_fields = new_cmb2_box( $args );
    $cmb_fields->add_field( [
      'name'    => 'Color',
      'id'      => 'partner_type_color',
      'type'    => 'colorpicker',
      'default' => '',
      'attributes' => array(
          'data-colorpicker' => json_encode( array(
              // Iris Options set here as values in the 'data-colorpicker' array
              'palettes' => array( '#3dd0cc', '#ff834c', '#4fa2c0', '#0bc991', ),
          ) ),
      ),

    ] );

  }

}
