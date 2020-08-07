const el = wp.element.createElement;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;
const { InspectorControls } = wp.editor;
const { TextControl, PanelBody } = wp.components;
const { PostFeaturedImage } = wp.editor;
const { withSelect } = wp.data;


 /*https://stackoverflow.com/questions/51674293/use-page-title-in-gutenberg-custom-banner-block/51792096#comment92130728_51792096*/
const GetTitle = props => <div>{props.title}</div>;
const selectTitle = withSelect(select => ({
  title: select("core/editor").getEditedPostAttribute( 'title' )
}));
const PostTitle = selectTitle(GetTitle);

registerBlockType( 'liaison/teamtemplate', {
    title: 'Liaison Columns (like on Team)',
    description: __( 'Choose 2 POSTs or Pages on the right. When POST is not in List (only first 40 Posts are shown) change the Date of post to newer, than it will appear.', 'yours'),
    category: 'liaison',
    attributes: { 
			institution : {
				'type'    :'string',
				'source'  :'meta',
				'meta'    :'team_member_institution',
				// 'default' : ""
			},
      imgdesc : {
            type: "string",
        },
		},

    // supports : {
    //   align: [ 'wide', 'full' ], // we hide this functionsliyy but hide with css components-toolbar components-toolbar
    //   anchor: true,
    // },
    edit: ( props ) => {
       const title = wp.data.select( 'core/editor' ).getCurrentPost().title;
       const { attributes: { institution, imgdesc }, className, setAttributes } = props;
       setAttributes({title});
       return [
          <InspectorControls>
                    <PanelBody>
                        <TextControl
                            label={ __( 'Institution / extra Headline', 'yours' ) }
                            value={ institution }
                            onChange={ text => {
                                setAttributes( { institution:text } )
                        } }
                        />
                    </PanelBody>
          </InspectorControls>,
        <div className="wp-fakeblock wide">
          <div className="half">
            { institution && 
              <h2 class="serif">
                {institution}
              </h2>
            }
            { !institution && 
               <p>klick to set insitution in sidebar on the right</p>
            }
             <h1 className=""><PostTitle /></h1>
            <InnerBlocks
              allowedBlocks={['core/paragraph']}
            />
          </div>
          <div className="half">
              <PostFeaturedImage />
                <TextControl
                    label="Add a image description"
                    value={ imgdesc }
                    onChange={ ( value ) => {
                        setAttributes( { imgdesc:value } )
                    } }
                />
          </div>
        </div>
       ]
    },
    save: ( props ) => {
      // return null;
      return el( InnerBlocks.Content, {} );
    },
});