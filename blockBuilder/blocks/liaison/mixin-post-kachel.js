
import icon from './icon';
// import './style.scss';

/**
 * Internal block libraries
 */
const el = wp.element.createElement;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Spinner,TextareaControl } = wp.components;
const { withSelect } = wp.data;
const { InspectorControls } = wp.editor;
const { TextControl, PanelBody, SelectControl, ToggleControl } = wp.components;


const RenderKachel = (props) => {
            const post = props.post;
            return(
                
                    <>
                        { post.featured_media != 0 && 
                            <img src={post._embedded['wp:featuredmedia'][0].source_url} 
                                alt={post._embedded['wp:featuredmedia'][0].alt_text}
                            />
                        }
                        { post.featured_media == 0 && 
                            <p><i>
                            {__("The post you selected does not contain a 'featured image'. If you want an image here set featured image in the selected Post.","yours")}
                            </i>
                            </p>
                        }
                        <h2 className="serif">{ post.title.rendered }</h2>
                        <TextControl
                                label="Add a extra line / can be empty"
                                value={ props.value }
                                onChange={ ( value ) => {
                                    props.onChange(value)
                                  
                                } }
                        />
                    </>
            );
}

registerBlockType(
    'liaison/mixin-kachel',
    {
        title: __( 'Mixin-2 Blogposts as Tiles ', 'yours'),
        description: __( 'Choose 2 POSTs or Pages on the right. When POST is not in List (only first 40 Posts are shown) change the Date of post to newer, than it will appear.', 'yours'),
        icon: "smiley",   
        category: 'liaison',
        attributes: { 
            selectedPostId_1 : {
                type: "string", // number is not working !!!! thanks gutenberg ... this cost me more than 1 hour
                 // source: 'attribute'
            },
             selectedPostId_2 : {
                type: "string", // number is not working !!!! thanks gutenberg ... this cost me more than 1 hour
                 // source: 'attribute'
            },
            extra_line_1 : {
                type: "string",
            },
            extra_line_2 : {
                type: "string",
            },
            flipped : {
                type: "boolean",
            },
            content_1:{
                type: "string",
            },
            content_2:{
                type: "string",
            },
        },      
        
        edit: withSelect( select => {
            const { getEntityRecords } = select( 'core' );
            // const { isResolving } = select( 'core/data' );
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
             return {
                posts: getEntityRecords( 'postType', 'post', query ),
                pages: getEntityRecords( 'postType', 'page', query ),
                // isRequesting: isResolving( 'core', 'getEntityRecords', [  'postType', 'page', query ] ),
            };
            } )
            ( ( props ) => {
                const { attributes: { content_1, content_2,  selectedPostId_1, selectedPostId_2, extra_line_1, extra_line_2, flipped }
                    , posts, pages,  className, setAttributes } = props;
                var options = [];


                var allposts = [];
                // console.log(posts,pages, isRequesting)
                if( posts && posts.length ) {
                    allposts = allposts.concat(posts);
                }
                 if( pages && pages.length ) {
                    allposts = allposts.concat(pages);
                }
                var flippedClass= flipped ? "flipped" : "";
                if( allposts && allposts.length ) {
                    options.push( { value: 0, label: 'Select something' } );
                    allposts.forEach((post) => { // simple foreach loop
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
                            label= 'Select first post (only 20 of the last posts/pages shown)'
                            options= {options}
                            value= {selectedPostId_1}
                            onChange= { value => {
                                setAttributes( { selectedPostId_1:value } )
                            }}
                        />  
                        <SelectControl
                            label= 'Select second post'
                            options= {options}
                            value= {selectedPostId_2}
                            onChange= { value => {
                                setAttributes( { selectedPostId_2:value } )
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
                    <div className={`grid-container wide  ${flippedClass}`} >
                        <div className="grid-x  grid-padding-x ">
                             { selectedPostId_1 && selectedPostId_2 &&  allposts.map( post => {
                                    if (post.id == selectedPostId_1 ) {
                                     return (
                                        <div className="cell medium-6 small-12 half">
                                           <RenderKachel
                                            post={post}
                                            value={extra_line_1 ?  extra_line_1 : ""}
                                            onChange={(value)=> {
                                                setAttributes( { extra_line_1:value } );
                                                console.log(index,value);
                                            }}
                                        />
                                       
                                      
                                        </div>
                                    ) // return

                                    } // enf if 
                                    if (post.id == selectedPostId_2 ) {
                                     return (
                                       <div className="cell medium-6 small-12 half">
                                            <RenderKachel
                                            post={post}
                                            value={extra_line_2 ?  extra_line_2 : ""}
                                            onChange={(value)=> {
                                                setAttributes( { extra_line_2:value } )
                                            }}
                                        /> 
                                      
                                        </div>
                                    ) // return
                                    } // enf if 

                            })} 
                            </div>
                        </div>
                    {
                        (!selectedPostId_1 || !selectedPostId_2) && 
                        <p>{ __( 'Please selected 2 Posts on the right in sidebar.', 'yours' ) }</p>
                    }
                    </div>
                ];
            } ) // end withAPIData
        , // end edit
        save(props) {
            // all serverside
            // console.log(props);
             // return el( InnerBlocks.Content, {} );
            // return null;
            // return props.attributes.selectedPostId;
        },
} );

