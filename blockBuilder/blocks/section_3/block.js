/* background image block*/
import classnames from 'classnames';
import Section from './section';

// import { withState } from '@wordpress/compose';

// import _ from 'lodash'; when importing lodash there will be an error this.Activation or similar

// import { ToggleControl } from '@wordpress/components';
// import { ToggleControl } from '../components/toggle-control';  // not compiling correctly, components need to be imported from wordpress directory

import './store-master-toggle.js';

const blockName = 'larslo/section_3';

// Elarslo/section33S6
// import { Resizable, ResizableBox } from 'react-resizable';
// import ReactCrop from 'react-image-crop';

const { Fragment } = wp.element;
const {
	PanelBody,
	SelectControl,
	// BaseControl,
	IconButton,
	// Placeholder,
	// Dashicon,
	Button,
	Tooltip,
	ToggleControl,
} = wp.components;
const {
	InspectorControls,
	MediaUpload,
	RichText,
} = wp.editor;

const { __, _x } = wp.i18n;

const registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() to register blocks.

// wp.hooks.addFilter(
//     'blocks.getSaveElement',
//     'larslo-section33',
//     (element,blockType,attributes) => {
//       console.log(element,blockType,attributes,more,"getSaveElement\n")
//     }
// );

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

		imagePos: {
			type: 'string',
			default: 'left',
		},
		rowGap: {
			type: 'string',
			default: 'grid-margin-x grid-x',
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
		backgroundImageID: {
			type: 'number',
		},
		backgroundImageURL: {
			type: 'string',
			default: '',
		},
		backgroundThumb: {
			type: 'string',
			default: '',
		},
		text_content: {
			type: 'array',
			source: 'children',
			selector: '.steps',
		},
	},
	edit: props => {
		const { attributes, setAttributes } = props;
		const { backgroundThumb, backgroundImageID, backgroundImageURL, text_content, rowGap, imagePos, contentMaxWidth, mediaID, mediaURL } = attributes;

		// const  = "left";
		const onSelectImage = media => {
			if ( ! media || ! media.id || ! media.url ) {
				return;
			}
			return { _id: media.id, _url: media.url, _thumb: media.sizes.thumbnail.url };
		};

		const onMainMediaSelected = ()=>{
			console.log( onMainMediaSelected, 'onMainMediaSelected' );
			/* check media and NOTICE*/
			wp.data.dispatch( 'core/notices' ).createNotice(
				'error',
				<p>An error <em>occurred</em>: <code> waht a cooode </code>.</p>
				,
				{ actions: [ { label: 'Action', onClick: () => {
					alert( 'learn' );
				} } ] } );
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody
						title={ __( 'Settings', 'yours-blocks' ) }
						initialOpen={ true }
					>
						<strong>Select a background image:</strong>

						<MediaUpload
							onSelect={ ( media )=> {
								const hasmedia = onSelectImage( media );
								if ( hasmedia ) {
									setAttributes(
										{
											backgroundImageURL: hasmedia._url,
											backgroundImageID: hasmedia._id,
											backgroundThumb: hasmedia._thumb,
										}
									);
									onMainMediaSelected();
								}
								// console.log(hasmedia,"hasmedia",media)
							} }
							type="image"
							value={ backgroundImageID }
							render={ ( { open } ) => (
								<button onClick={ open }>
									{
										backgroundThumb ? <img src={ backgroundThumb }></img> : 'Set Image'
									}
								</button>
							) }
						/>

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
							value={ rowGap || 'grid-x grid-margin-x' }
							onChange={ value => setAttributes( { rowGap: value } ) }
							options={ [
								{ value: 'grid-x grid-margin-x', label: __( 'Abstand', 'yours-blocks' ) },
								{ value: 'grid-x ', label: __( 'kein Abstand', 'yours-blocks' ) },
							] }
						/>
					</PanelBody>
				</InspectorControls>

				<Tooltip text="More information">

/* for editor spot */
					<Section
						imagePos={ imagePos }
						rowGap={ rowGap }
						contentMaxWidth={ contentMaxWidth }
						className={ classnames() }
					>

						<div className="master-toggle">
							<Button>S</Button>
						</div>

						<div className="bg-thing"
							style={ {
								backgroundImage: `url(${ backgroundImageURL })`,
								backgroundSize: 'cover',
								minHeight: '500px',
								backgroundPosition: 'center',
							} }
						>

							<div className="image-wrapper grid-item" >
            COOOOOOO
							</div>
						</div>
						<div className="grid-item">

							<RichText
								tagName="div"
								multiline="p"
								className="steps"
								placeholder={ __( 'Text', 'yours-blocks' ) }
								value={ text_content }
								onChange={ ( value ) => setAttributes( { text_content: value } ) }
							/>
						</div>

					</Section>
				</Tooltip>
			</Fragment>
		);
	},
	save: props => {
		const { attributes, setAttributes } = props;
		const { backgroundImageURL, master_settings_open, rowGap, text_content, imagePos, contentMaxWidth, mediaID, mediaURL } = attributes;
		// console.log(attributes, setAttributes);

		/* always set wp-image-ID for image files to have wordpress imagesizes calculated auto */
		return (
			<section
				className={ classnames( 'grid-container', contentMaxWidth ) }
			>
				<div
					className="bg-thing"
					style={ {
						backgroundImage: `url(${ backgroundImageURL })`,
						backgroundSize: 'cover',
						backgroundPosition: 'center',
					} }
				></div>
				<div className={ classnames( 'grid-x', rowGap ) }>
					<div className="cell medium-6">
						<figure>
							<img className={ classnames( `wp-image-${ mediaID }` ) } src={ mediaURL }></img>
						</figure>
					</div>
					<div className="cell medium-6">
						<RichText.Content tagName="div" className="steps" value={ text_content } />
					</div>
				</div>

			</section>
		);
	},
} );
