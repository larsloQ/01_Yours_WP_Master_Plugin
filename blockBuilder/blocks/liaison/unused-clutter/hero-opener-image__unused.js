/* this is from here 
https://calderaforms.com/2019/01/convert-shortcode-gutenberg-block/
*/
const {registerBlockType} = wp.blocks; //Blocks API
const {createElement} = wp.element; //React.createElement
const {ServerSideRender} = wp.components; //WordPress form inputs and server-side renderer


registerBlockType( 'liaison/hero-opener', {
  title:  'Opener / Hero Image', // Block title.
  category:   'liaison', //category
  className: "wp-fakeblock wide",
  supports: { alignWide:"true"},
  align : "wide",
  
  //display the post title
  edit(props){
    //Display block preview and UI
    return createElement('div', {
      className:"wp-fakeblock wide"
    }, [
      //Preview a block with a PHP render callback, see plugins/yours/Blocks/Serverside
      createElement( ServerSideRender, {
        block: 'liaison/hero-opener',
        attributes: []
      } ),
    ] )
  },
  save(){
    return null;
  }
});
