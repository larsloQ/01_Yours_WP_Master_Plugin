<?php 
namespace Yours\Plugin\Metaboxes\Hero;


function getImageFieldsCMB2 ($prefix="_"){
    return array(
      "pano" => array( 
        'name'         => __( 'Panorama Image (Landscape)', 'cmb2' ),

        'id'           => $prefix.'pano',
        'type'         => 'file_list',
        // "description" => __('Add a PANORAMA image. Max width 2000px'),
        "description" => __('REQUIRED: Please use an image in the Dimensions 1600x694 Pixel here',"yours"),
        'after' => '',
        'query_args' => array( 'type' => 'image' ), // Only images attachment
        'preview_size' => array( 160, 90 ), // Default: array( 50, 50 )
        "limit" =>1 ,
        'options' => array(
                  'url' => false, // Hide the text input for the url
        ),
        // 'attributes' => array(
        //   'data-conditional-id' => $prefix . 'also_full',
        //    'required' => true, // this is the default required from https://github.com/jcchavezs/cmb2-conditionals and it is not working as a real require
        //   // 'data-validation' => 'required', // this is from js_field_require_validation.php 

        // ),
      ),
      "sky" => array( 
        'name'         => __( 'Portrait Image (Sky)', 'cmb2' ),
        "description" => __('REQUIRED: Please take an Image in the Dimensions 1280x840 Pixel  here',"yours"),
        'id'           => $prefix.'sky',
        'type'         => 'file_list',
        'after' => '',
        'query_args' => array( 'type' => 'image' ), // Only images attachment
        'preview_size' => array( 200,200 ), // Default: array( 50, 50 )
        "limit" =>1 ,
        'options' => array(
                  'url' => false, // Hide the text input for the url
        ),
        // 'attributes' => array(
        //    'data-conditional-id' => $prefix . 'has_hero',
        //    'required' => true,
        // ),
      ),
    );
}

