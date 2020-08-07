// unregister_blocks.js

/* see 
https://developer.wordpress.org/block-editor/developers/filters/block-filters/
*/

wp.hooks.addFilter(
  'blocks.getSaveElement',
  'yours/modify-get-save-content-extra-props',
  modifyGetSaveContentExtraProps
);


function modifyGetSaveContentExtraProps( element, blockType, attributes  ) {
  // Check if that is not a table block.
  if (blockType.name === 'core/freeform' || blockType.name === 'core/list') {
    if (attributes.content && attributes.content.indexOf("wp-block-classic")<0) { // only do this once
        return  window.wp.element.createElement(
                'div',
                 {className:"wp-block-classic wp-block-freeform"},
                element
        );
    }
  }
  // if (blockType.name === 'core-embed/youtube' || blockType.name === 'core-embed/vimeo') {
  //    return  window.wp.element.createElement(
  //               'div',
  //                {className:"wp-embed-aspect-16-9"},
  //               element
  //       );
  // }
  return element;
}

/*
  with this hook you can add extra attributes to certain blocks
*/
// wp.hooks.addFilter('blocks.registerBlockType', 'yours/blockreg/namespacing', function(block,blockName) {
//    if (blockName==="core-embed/youtube" || blockName==="core-embed/vimeo") {

//     // if(block.hasOwnProperty('attributes')){
//     //     block.attributes.videoformat = {
//     //         type: 'string',
//     //         default: '16-9'
//     //     };
//     // }
//    }
//     return block;
// });

/* 
add something to sidebar for a existing block 
which is a important technique.
more here https://www.liip.ch/en/blog/how-to-extend-existing-gutenberg-blocks-in-wordpress
*/
var el = wp.element.createElement;
var withInspectorControls = wp.compose.createHigherOrderComponent( function( BlockEdit ) {
  
      return function( props ) {
        if (props.name === "core-embed/youtube" || props.name ==="core-embed/vimeo") {

          // console.log(BlockEdit,props);
          return el(
              wp.element.Fragment,
              {},
              el(
                  BlockEdit,
                  props
              ),
              el(
                  wp.editor.InspectorControls,
                  {},
                  el(
                      wp.components.PanelBody,
                      { title:'Video Settings',
                          initialOpen: true,
                      },
                        el(
                          wp.components.ToggleControl,
                          {
                            label : "16-9 (if checked the video will be in widescreen, most videos are widescreen nowadays. you can not change this if the video itself has these dimensions)",
                            checked: props.attributes.className && props.attributes.className.indexOf("16-9") > -1,
                            onChange: function(val) { 
                              var asstring = props.attributes.className ? props.attributes.className : "";
                              if (val) { asstring = "wp-embed-aspect-16-9"; }
                              props.setAttributes( { className: asstring } );
                            }
                          },
                        )
                  )
              )
          );
        } 
         // dont forget otherwise trouble with all 
        return el(
                BlockEdit,
                props
        );
    }
}, 'withInspectorControls' );
 
wp.hooks.addFilter( 'editor.BlockEdit', 'yours/blockedit/namespacing', withInspectorControls );

