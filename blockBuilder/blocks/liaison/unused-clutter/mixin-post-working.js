/**
 * Block dependencies
 */
import icon from './icon';
// import './style.scss';

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Spinner } = wp.components;
const { withSelect } = wp.data;
const { withState } = wp.compose;
const { InspectorControls, PostFeaturedImage, InnerBlocks } = wp.editor;
const { TextControl, PanelBody, SelectControl } = wp.components;




registerBlockType(
    'liaison/mixin',
    {
        title: __( 'Mixin-Blogpost', 'yours'),
        description: __( '', 'yours'),
        icon: {
            background: 'rgba(254, 243, 224, 0.52)',
            src: icon,
        },   
        attributes: { 
            selectedPostId : {
                type: "string", // number is not working !!!! thanks gutenberg ... this cost me more than 1 hour
                 // source: 'attribute'
            },
            extra_line : {
                type: "string",
            }
        },      
        category: 'widgets',
        edit: withSelect( select => {
                return {
                    posts: select( 'core' ).getEntityRecords( 'postType', 'post', { per_page: 40,  _embed: true }  )
                };
            } )
            ( ( props ) => {
                // const title = wp.data.select( 'core/editor' ).getCurrentPost().title;
                const { attributes: { selectedPostId, extra_line }, posts, className, setAttributes, isSelected } = props;
                var options = [];
                // console.log(posts,props);
                if( posts ) {
                    options.push( { value: 0, label: 'Select something' } );
                    posts.forEach((post) => { // simple foreach loop
                        options.push({value:post.id, label:post.title.rendered});
                    });
                } else {
                    options.push( { value: 0, label: 'Loading...' } )
                }

                if ( ! posts ) {
                    return (
                        <p className={className} >
                            <Spinner />
                            { __( 'Loading Posts', 'yours' ) }
                        </p>
                    );
                }
                
                return [
                    <InspectorControls>
                    <PanelBody>
                        <SelectControl
                            label= 'Select a post'
                            options= {options}
                            value= {selectedPostId}
                            onChange= { value => {
                                setAttributes( { selectedPostId:value } )
                            }}
                        />
                        </PanelBody>
                    </InspectorControls>,
                    <div>
                    { selectedPostId &&   posts.map( post => {
                                if (post.id == selectedPostId ) {
                                    return (
                                        <div className="wp-fakeblock wide">
                                              <div className="half">
                                                <TextControl
                                                        label="Add a extra line / can be empty"
                                                        value={ extra_line }
                                                        onChange={ ( value ) => {
                                                            setAttributes( { extra_line:value } )
                                                        } }
                                                    />
                                                <h2>{ post.title.rendered }</h2>
                                                <InnerBlocks
                                                  allowedBlocks={['core/paragraph']}
                                                />
                                              </div>
                                              <div className="half">
                                                  {post.featured_media != 0 && 
                                                    <img src={post._embedded['wp:featuredmedia'][0].source_url} 
                                                        alt={post._embedded['wp:featuredmedia'][0].alt_text}
                                                    />
                                                  }
                                                  {post.featured_media == 0 && 
                                                    <p>{__("The post you selected does not contain a 'featured image'. If you want an image here set featured image in the selected Post.","yours")}</p>
                                                  }
                                              </div>
                                            </div>
                                    );
                                }
                            }) 
                    } 
                    {
                        !selectedPostId && 
                        <p>{ __( 'No Post selected. Please select one in sidebar.', 'yours' ) }</p>
                    }
                    </div>
                ];
            } ) // end withAPIData
        , // end edit
        save(props) {
            // return null;
            // return props.attributes.selectedPostId;
        },
} );
