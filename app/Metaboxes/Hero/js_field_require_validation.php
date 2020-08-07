<?php
// js_field_require.php

/*
 * Description: Uses js to validate CMB2 fields that have the 'data-validation' attribute set to 'required'
 * Version: 0.1.0
 * 
 * LFK 2019-02-08_10.15.33 !!!!!
 * !!!!!
 * added the conditionals from  https://github.com/jcchavezs/cmb2-conditionals 
 * @see data-conditional-id
 * !!!!!
 * 
  returns a <script> tag (written in php so that it can be included without url )
 */
/* 

see https://github.com/CMB2/CMB2-Snippet-Library/blob/master/javascript/cmb2-js-validation-required.php
all fields with [data-validation] are validated
add this in field definition 
'attributes' => array(
    'data-validation' => 'required',
  ),
*/
/**
 * Documentation in the wiki:
 * @link https://github.com/WebDevStudios/CMB2/wiki/Plugin-code-to-add-JS-validation-of-%22required%22-fields
 */
add_action( 'cmb2_after_form', 'cmb2_after_form_do_js_validation', 10, 2 );
function cmb2_after_form_do_js_validation( $post_id, $cmb ) {
  static $added = false;
  // Only add this to the page once (not for every metabox)
  if ( $added ) {
    return;
  }
  $added = true;
  ?>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
    $form = $( document.getElementById( 'post' ) );
    $htmlbody = $( 'html, body' );
    $toValidate = $( '[data-validation]' );
    $conditionaltoValidate = $( '[data-conditional-id]' );
    console.log($toValidate,$conditionaltoValidate,"js_field_require");



    if ( ! $toValidate.length ) {
      return;
    }
    function checkValidation( evt ) {
      var labels = [];
      var $first_error_row = null;
      var $row = null;
      function add_required( $row ) {
        // console.log($row,"add_required")
        $row.css({ 'background-color': 'rgb(255, 170, 170)' });
        $first_error_row = $first_error_row ? $first_error_row : $row;
        labels.push( $row.find( '.cmb-th label' ).text() );
      }
      function remove_required( $row ) {
        $row.css({ background: '' });
      }
      $toValidate.each( function() {
        var $this = $(this);
        var val = $this.val();
        $row = $this.parents( '.cmb-row' );
        if ( $this.is( '[type="button"]' ) || $this.is( '.cmb2-upload-file-id' ) ) {
          return true;
        }
        if ( 'required' === $this.data( 'validation' ) ) {
          if ( $row.is( '.cmb-type-file-list' ) ) {
            var has_LIs = $row.find( 'ul.cmb-attach-list li' ).length > 0;
            if ( ! has_LIs ) {
              add_required( $row );
            } else {
              remove_required( $row );
            }
          } else {
            if ( ! val ) {
              add_required( $row );
            } else {
              remove_required( $row );
            }
          }
        }
      });
      /* 
        LFK 2019-02-08_10.22.30 check also conditionals()
        works only with checkboxes
      */
       if ( $first_error_row ) {
        
       }
   
      if ( $first_error_row ) {
        evt.preventDefault();
        alert( '<?php _e( 'Eingaben unvollständig, bitte rote Bereich ausfüllen:', 'cmb2' ); ?> ' + labels.join( ', ' ) );
        $htmlbody.animate({
          scrollTop: ( $first_error_row.offset().top - 200 )
        }, 1000);
      } else {
        // Feel free to comment this out or remove
        // alert( 'submission is good!' );
      }
    }
    $form.on( 'submit', checkValidation );
  });
  </script>
  <?php
}
