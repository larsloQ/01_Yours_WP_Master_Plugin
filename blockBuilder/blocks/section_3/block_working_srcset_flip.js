import classnames from 'classnames';
// import BlockType from '../block-type';
import Section from './section';

const { Fragment } = wp.element;
const {
  PanelBody,
  SelectControl,
  BaseControl,
  IconButton,
  Placeholder,
  Dashicon,
  Button
} = wp.components;
const {
  InspectorControls,
  MediaUpload,
  RichText,
} = wp.editor;

const { __, _x } = wp.i18n;

const registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() to register blocks.



// export const name = 'felix-arntz/section';

// export const settings = {
registerBlockType( 'larslo/section', {
  title: __( 'Section Image Flip', 'yours-blocks' ),
  description: __( 'Add a section that separates content, and put any other block into it.', 'yours-blocks' ),
  category: 'layout',
  icon: 'welcome-widgets-menus',
  keywords: [
    _x( 'section', 'keyword', 'yours-blocks' ),
    _x( 'separator', 'keyword', 'yours-blocks' ),
  ],
  supports: {
    align: [ 'wide', 'full' ],
    anchor: true,
  },
  attributes: {
    imagePos: {
      type: 'string',
      default: 'left',
    },
    rowGap: {
      type: 'string',
      default: "grid-margin-x grid-x",
    },
    contentMaxWidth: {
      type: 'string',
      default: '',
    },
    mediaID: {
      type: 'number',
    },
    mediaURL: {
      type: 'string',
    },
    text_content: {
      type: 'array',
      source: 'children',
      selector: '.steps',
    },
  },
  edit: props => {
    const { attributes, setAttributes } = props;
    const { text_content, rowGap, imagePos,contentMaxWidth, mediaID, mediaURL } = attributes;
    // const  = "left";
    const onSelectImage = media => {
      if ( ! media || ! media.id || ! media.url ) {
        setAttributes( { mediaID: undefined, mediaURL: undefined } );
        return;
      }
      setAttributes( { mediaID: media.id, mediaURL: media.url } );
    };

    return (
      <Fragment>
        <InspectorControls>
          <PanelBody title={ __( 'Settings', 'yours-blocks' ) }>
            <SelectControl
              label={ __( 'Image Pos', 'yours-blocks' ) }
              value={ imagePos || 'default' }
              onChange={ value => setAttributes( { imagePos: ( 'default' !== value ) ? value : undefined } ) }
              options={ [
                { value: 'default', label: __( 'Left', 'yours-blocks' ) },
                { value: 'right', label: __( 'Right', 'yours-blocks' ) },
              ] }
            />
            <SelectControl
              label={ __( 'Maximum Content Width', 'yours-blocks' ) }
              value={ contentMaxWidth || '' }
              onChange={ value => setAttributes( { contentMaxWidth: ( 'site' !== value ) ? value : undefined } ) }
              options={ [
                { value: '', label: __( 'Normale Breite', 'yours-blocks' ) },
                { value: 'full', label: __( 'Volle Breite', 'yours-blocks' ) },
                { value: 'fluid', label: __( 'Fließend', 'yours-blocks' ) },
              ] }
            />
            <SelectControl
              label={ __( 'Lücke', 'yours-blocks' ) }
              value={ rowGap || "grid-x grid-margin-x" }
              onChange={ value => setAttributes( { rowGap: value } ) }
              options={ [
                { value: "grid-x grid-margin-x", label: __( 'Abstand', 'yours-blocks' ) },
                { value: "grid-x ", label: __( 'kein Abstand', 'yours-blocks' ) },
              ] }
            />

          </PanelBody>
        </InspectorControls>
        <Section
          imagePos={ imagePos }
          rowGap={rowGap}
          contentMaxWidth={ contentMaxWidth }
          className={ classnames() }
        >
        <div className="image-wrapper grid-item">
          <MediaUpload
                onSelect={ onSelectImage }
                type="image"
                value={ mediaID }
                render={ ( { open } ) => (
              <Button className={ mediaID ? 'image-button' : 'button button-large' } onClick={ open }>
                { ! mediaID ? __( 'Set Image', 'yours-blocks' ) : <img src={ mediaURL } alt={ __( 'Select Image / Lib', 'gutenberg-examples' ) } /> }
              </Button>
            ) }
              />
        </div>
        <div className="grid-item">
          <RichText
            tagName="div"
            multiline="p"
            className="steps"
            placeholder={ __( 'Text', 'yours-blocks' ) }
            value={ text_content }
            onChange={ (value) => setAttributes({text_content:value}) }
        />
        </div>

        </Section>
      </Fragment>
    );
  },
  save: props => {
    const { attributes } = props;
    const { rowGap, text_content, imagePos, contentMaxWidth, mediaID, mediaURL } = attributes;
        // imagePos={ imagePos }
        // contentMaxWidth={ contentMaxWidth }

        /* always set wp-image-ID for image files to have wordpress imagesizes calculated auto */
    return (
      <section
        className={classnames("grid-container", contentMaxWidth ) }
      >
      <div className={classnames("grid-x", rowGap ) }>
         <div className="cell medium-6">
           <figure>
            <img className={classnames(`wp-image-${mediaID}`) } src={mediaURL}></img>
           </figure>
         </div>
         <div className="cell medium-6">
            <RichText.Content tagName="div" className="steps" value={ text_content } />
         </div>
      </div>
    
      </section>
    );
  },
});