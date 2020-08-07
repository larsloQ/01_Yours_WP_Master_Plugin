import classnames from 'classnames';
// import BlockType from '../block-type';
import Section from './section';
import { withState } from '@wordpress/compose';

import { ToggleControl } from '@wordpress/components';
// import { ToggleControl } from '../components/toggle-control';


// import FormToggle from "../components/form-toggle"
  // ToggleControl
const { Fragment } = wp.element;
const {
  PanelBody,
  SelectControl,
  BaseControl,
  IconButton,
  Placeholder,
  Dashicon,
  Button,
  Tooltip

} = wp.components;
const {
  InspectorControls,
  MediaUpload,
  RichText,
} = wp.editor;

const { __, _x } = wp.i18n;

const registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() to register blocks.





// 

// export const name = 'felix-arntz/section';

// export const settings = {
registerBlockType( 'larslo/section33', { // this will show up in frontend as wp-block-larslo-section
  title: __( 'Section Image Flip 3', 'yours-blocks' ),
  description: __( '...coming soon...', 'yours-blocks' ),
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
    master_settings_open : {
      type: "boolean",
      default: false
    },
    toggle_bg1: {
      type: "boolean",
      default: false
    },
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
    const { master_settings_open,toggle_bg1, text_content, rowGap, imagePos,contentMaxWidth, mediaID, mediaURL } = attributes;
    
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
          <PanelBody title={ __( 'Settings', 'yours-blocks' ) } opened={master_settings_open}>
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
             <ToggleControl
            label=""
            help={ toggle_bg1 ? 'Has fixed background.' : 'No fixed background.' } 
            checked={ toggle_bg1 }
            onChange={ () => setAttributes({ toggle_bg1: !toggle_bg1 }) }
            onFocus={() => console.log('hooover')}
          />

          </PanelBody>
        </InspectorControls>
        <Tooltip text="More information">
        <Section
          imagePos={ imagePos }
          rowGap={rowGap}
          contentMaxWidth={ contentMaxWidth }
          className={ classnames() }
        > 
        <Tooltip text="More information" className="master-toogle">
            <div className="restrict-40">
              <ToggleControl
                label=""
                help=""
                checked={ master_settings_open }
                onChange={ () => setAttributes({ master_settings_open: !master_settings_open }) }
                onFocus={() => console.log('hooover')}
              />
            </div>
           </Tooltip>
       

         
          <Button >Click Me!</Button>;
          <div className="image-wrapper grid-item">


         
        

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
         </Tooltip>
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