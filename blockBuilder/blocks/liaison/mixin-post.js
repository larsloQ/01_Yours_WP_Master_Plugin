/**
 * Block dependencies
 */
import icon from './icon';
// import './style.scss';

/**
 * Internal block libraries
 */
const el = wp.element.createElement;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Spinner } = wp.components;
const { withSelect } = wp.data;
const { InspectorControls,  InnerBlocks } = wp.editor;
const { TextControl, PanelBody, SelectControl, ToggleControl } = wp.components;




registerBlockType(
    'liaison/mixin',
    {
        title: __( 'Mixin-Blogpost', 'yours'),
        description: __( 'Choose a POST on the right. When POST is not in List (only first 40 Posts are shown) change the Date of post to newer, than it will appear.', 'yours'),
        icon: "smiley",   
        category: 'liaison',
        attributes: { 
            selectedPostId : {
                type: "string", // number is not working !!!! thanks gutenberg ... this cost me more than 1 hour
                 // source: 'attribute'
            },
            extra_line : {
                type: "string",
            },
            flipped : {
                type: "boolean",
            }
        },      
        edit: withSelect( select => {
                // https://rudrastyh.com/gutenberg/get-posts-in-dynamic-select-control.html#getEntityRecords
                const query = {
                    per_page: 39,
                    // exclude: postId,
                    // parent_exclude: postId,
                    orderby: 'date', // menu_order  leads to a JS ERROR
                    order: 'desc',
                    status: 'publish',
                    // search : 'search query',
                    // status: 'publish,future,draft,pending,private',
                    _embed: false // meta 
                }
                var posts = select( 'core' ).getEntityRecords( 'postType', 'post', query )
                return {
                    "posts":posts
                };
            } )
            ( ( props ) => {
                // const title = wp.data.select( 'core/editor' ).getCurrentPost().title;
                const { attributes: { selectedPostId, extra_line, flipped }, posts, className, setAttributes, isSelected } = props;
                var options = [];
                var flippedClass= flipped ? "flipped" : "";
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
                        <ToggleControl
                            label={ __( 'Flip Sides' ) }
                            checked={ flipped }
                            onChange={
                                ( value ) => {
                                    setAttributes( { flipped:value } )
                            }  }
                        />
                    </InspectorControls>,
                    <div >
                    { selectedPostId &&   posts.map( post => {
                                 
                                if (post.id == selectedPostId ) {
                                    return (
                                        <div className={`grid-container wide  ${flippedClass}`} >
                                            <div className="grid-x  grid-padding-x ">
                                              <div className="cell medium-6 small-12 half">
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
                                              <div className="cell medium-6 small-12 half">
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
            // console.log(props);
             return el( InnerBlocks.Content, {} );
            // return null;
            // return props.attributes.selectedPostId;
        },
} );
