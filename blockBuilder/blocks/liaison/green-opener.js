
import icons from './icons';

const { withSelect } = wp.data;

const el = wp.element.createElement;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks, MediaUpload } = wp.editor;
const {  Button } = wp.components;


const TEMPLATE = [
  [ 'core/heading', { level:1, className:"white",content:'Set Headline' } ],
  [ 'core/paragraph', { className:"white",content:'Write entry text' } ],
];


/* this is not in use at the moment, template is set in PHP plugins/yours/app/PostTypes/<<NAME>>*/


registerBlockType( 'liaison/green-opener', {
  title: 'Green Opener',
  description: "Pick image on the left side. Only the round icons are supposed to be used. Display on page differs from display here. Please keep opening text (paragraph) short and use only 1 Headline (H1)",
  category: 'liaison',
  icon: 'smiley',
  keywords: [
  __( 'Liaison', 'yours' ),
  ],
  attributes: {
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
         const { attributes: { imageID, imageURL, imageAlt }, className, setAttributes, isSelected } = props;
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
            <div className="grid-x grid-padding-x opener_a">
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
              <InnerBlocks
              template={ TEMPLATE }
               allowedBlocks={['core/paragraph','core/heading']}
              />
            </div>
            </div>
            </div>
        ]
  },
  save: ( props ) => {
    const { imageURL, imageAlt, imageID } = props.attributes;
    // console.log(props.attributes);
    const cardImage = (src, alt) => {
      if(!src) return null;

      if(alt) {
          // <figure>
        return (
          <img 
          className="card__image lazyload" 
          src={ src }
          alt={ alt }
          /> 
          );
          // </figure>
      }
      // No alt set, so let's hide it from screen readers
        // <figure>
      return (
          <img 
          className="card__image lazyload" 
          src={ src }
          alt=""
          aria-hidden="true"
          /> 
        );
        // </figure>
    };
    return (
     <div className="grid-container">
     <div className="grid-x grid-padding-x opener_a">
     <div className="cell small-12 medium-5 ">
       { cardImage(imageURL, imageAlt) }
     </div>
     <div className="cell small-12 medium-7
      text">
     <InnerBlocks.Content />
     </div>
     </div>
     </div>
     )
  },
});