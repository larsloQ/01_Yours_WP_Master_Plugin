/* from her https://rudrastyh.com/gutenberg/plugin-sidebars.html#components */
( function( plugins, editPost, element, components, data, compose ) {
 
  const el = element.createElement;
 
  const { Fragment } = element;
  const { registerPlugin } = plugins;
  const { PluginSidebar, PluginSidebarMoreMenuItem } = editPost;
  const { PanelBody, TextControl, TextareaControl, CheckboxControl } = components;
  const { withSelect, withDispatch } = data;
 
 
var MetaTextControl = compose.compose(
  withDispatch( function( dispatch, props ) {
    return {
      setMetaValue: function( metaValue ) {
        dispatch( 'core/editor' ).editPost(
          { meta: { [ props.metaKey ]: metaValue } }
        );
      }
    }
  } ),
  withSelect( function( select, props ) {
    return {
      metaValue: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ],
    }
  } ) )( function( props ) {
    return el( TextControl, {
      label: props.title,
      value: props.metaValue,
      onChange: function( content ) {
        props.setMetaValue( content );
      },
    });
  }
);
  const MetaTextareaControl = ...
  const MetaCheckboxControl = ...
 
  registerPlugin( 'misha-seo', {
  render: function() {
    return el( Fragment, {},
      el( PluginSidebarMoreMenuItem,
        {
          target: 'misha-seo',
          icon: mishaIcon,
        },
        'SEO'
      ),
      el( PluginSidebar,
        {
          name: 'misha-seo',
          icon: mishaIcon,
          title: 'SEO',
        },
        el( PanelBody, {},
          // Field 1
          el( MetaTextControl,
            {
              metaKey: 'misha_plugin_seo_title',
              title : 'Title',
            }
          ),
          // Field 2
          el( MetaTextareaControl,
            {
              metaKey: 'misha_plugin_seo_description',
              title : 'Description',
            }
          ),
          // Field 3
          el( MetaCheckboxControl,
            {
              metaKey: 'misha_plugin_seo_robots',
              title : 'Hide from search engines',
            }
          ),
        )
      )
    );
  }
} );
} )(
  window.wp.plugins,
  window.wp.editPost,
  window.wp.element,
  window.wp.components,
  window.wp.data,
  window.wp.compose
);