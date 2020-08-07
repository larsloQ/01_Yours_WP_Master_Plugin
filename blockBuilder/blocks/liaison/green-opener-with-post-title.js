
import icons from './icons';

const { withSelect } = wp.data;

const el = wp.element.createElement;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks, MediaUpload } = wp.editor;
const {  Button } = wp.components;


/*https://stackoverflow.com/questions/51674293/use-page-title-in-gutenberg-custom-banner-block/51792096#comment92130728_51792096*/
const GetTitle = props => <div>{props.title}</div>;
const selectTitle = withSelect(select => ({
  title: select("core/editor").getEditedPostAttribute( 'title' )
}));
const PostTitle = selectTitle(GetTitle);

/* this is not in use at the moment, template is set in PHP plugins/yours/app/PostTypes/<<NAME>>*/


registerBlockType( 'liaison/green-opener', {
  title: 'Green Opener Title Working',
  description: "Pick image on the left side. Only the round icons are supposed to be used. ",
  category: 'liaison',
  icon: 'smiley',
  keywords: [
  __( 'Liaison', 'yours' ),
  ],
  attributes: {
    title: {
      type: 'string',
    },

    imageID: {
      type: 'number',
    },
    imageAlt: {
      attribute: 'alt',
      selector: '.card__image'
    },
    imageURL: {
      attribute: 'src',
      selector: '.card__image'
    }
  },

    // supports : {
    //   align: [ 'wide', 'full' ], // we hide this functionsliyy but hide with css components-toolbar components-toolbar
    //   anchor: true,
    // },
    edit: ( props ) => {
         const title = wp.data.select( 'core/editor' ).getCurrentPost().title;
         const { attributes: { imageID, imageURL, imageAlt },
         className, setAttributes, isSelected } = props;
         setAttributes({title});
         const onSelectImage = img => {
          setAttributes( {
            imageID: img.id,
            imageURL: img.url,
            imageAlt: img.alt,
          } );
        };
        const onRemoveImage = () => {
          setAttributes({
            imageID: null,
            imageURL: null,
            imageAlt: null,
          });
        }
        const getImageButton = (openEvent) => {
          // console.log("getImageButton", openEvent,props.attributes)
          if(props.attributes.imageURL) {
            return (
              <img 
              src={ props.attributes.imageURL }
              onClick={ openEvent }
              className="image"
              />
              );
          }
          else {
            return (
              <div className="button-container">
              <Button 
              onClick={ openEvent }
              className="button button-large"
              >
              Pick an image
              </Button>
              </div>
              );
          }
        };
        return [

            <div className="grid-container">
            <div className="grid-x align-middle grid-padding-x opener_a">
            <div className="cell small-12 medium-4 ">
            <MediaUpload
            onSelect={ onSelectImage }
            type="image"
            value={ imageID }
            render={ ({ open }) => getImageButton(open) }
            >
            </MediaUpload>
            { isSelected ? (
              <Button
              className="remove-image"
              onClick={ onRemoveImage }
              >
              { icons.remove }
              </Button>
              ) : null }
            </div>
            <div className="cell small-12 medium-8 text">
            <h1 className="white"><PostTitle /></h1>
            <InnerBlocks
            allowedBlocks={['core/paragraph']}
            />
            </div>
            </div>
            </div>
        ]
  },
  save: ( props ) => {
    const { title, imageURL, imageAlt, imageID } = props.attributes;
    // console.log(props.attributes);
    const cardImage = (src, alt) => {
      if(!src) return null;

      if(alt) {
        return (
          <figure>
          <img 
          className="card__image lazyload" 
          src={ src }
          alt={ alt }
          /> 
          </figure>
          );
      }
      
      // No alt set, so let's hide it from screen readers
      return (
        <figure>
          <img 
          className="card__image lazyload" 
          src={ src }
          alt=""
          aria-hidden="true"
          /> 
        </figure>
        );
    };
    return (
     <div className="grid-container">
     <div className="grid-x align-middle grid-padding-x opener_a">
     <div className="cell small-12 medium-4 ">
       { cardImage(imageURL, imageAlt) }
     </div>
     <div className="cell small-12 medium-8 text">
     <h1 className="white">{title}</h1>
     <InnerBlocks.Content />
     </div>
     </div>
     </div>
     )
  },
});