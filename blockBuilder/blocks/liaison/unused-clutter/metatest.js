/* 

*this is a plugin NOT a block !!!!!


*/
// import PluginIcon from './plugin-icon';
const { registerPlugin } =  window.wp.plugins;
const { PluginSidebar } = window.wp.editPost;
const { TextControl } = window.wp.components;
const { withDispatch, withSelect } = window.wp.data;
const { compose } = window.wp.compose;

let MetaBlockField = compose(
  withDispatch((dispatch, props) => {
    return {
      setMetaFieldValue: (value) => {
        dispatch('core/editor').editPost({meta: {[props.fieldName]: value}});
      }
    };
  }),
  withSelect((select, props) => {
    return {
      metaFieldValue: select('core/editor')
        .getEditedPostAttribute('meta')
        [props.fieldName]
    };
  })
)(({ metaFieldValue, setMetaFieldValue }) => {
  return (
    <TextControl
      label="Alternate Display Title"
      value={ metaFieldValue }
      onChange={(content) => setMetaFieldValue(content)}
    />
  );
});

registerPlugin('plugin-sidebar', {
  render() {
    return (
      <PluginSidebar
        name="plugin-sidebar"
        icon="smiley"
        title="Library Plugin Sidebar"
      >
        <div className="plugin-sidebar-content">
          <MetaBlockField fieldName="library_plugin_alternate_title"/>
        </div>
      </PluginSidebar>
    );
  }
});