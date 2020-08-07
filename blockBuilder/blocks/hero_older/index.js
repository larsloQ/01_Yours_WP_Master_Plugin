/* background image block*/
import classnames from 'classnames';

import Section from './section';

// import  {
// 	InspectorControls,
// 	MediaUpload,
// 	RichText,
// } from  "@wordpress/editor";




// import { withState } from '@wordpress/compose';

// import _ from 'lodash'; when importing lodash there will be an error this.Activation or similar

// import { ToggleControl } from '@wordpress/components';
// import { ToggleControl } from '../components/toggle-control';  // not compiling correctly, components need to be imported from wordpress directory

// import './store-master-toggle.js';

const blockNameId = 'larslo/hero';



// Elarslo/section33S6
// import { Resizable, ResizableBox } from 'react-resizable';
// import ReactCrop from 'react-image-crop';

const { Fragment } = wp.element;

const {
	PanelBody,
	SelectControl,
	Button,
	Tooltip,
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
registerBlockType( blockNameId, { // this will show up in frontend as wp-block-larslo-section
	title: __( 'Heroo Area', 'larslo-blocks' ),
	description: __( '...coming so0000on...', 'larslo-blocks' ),
	category: 'layout',
	icon: 'welcome-widgets-menus',
	keywords: [
		_x( 'section', 'keyword', 'larslo-blocks' ),
		_x( 'separator', 'keyword', 'larslo-blocks' ),
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
		mediaId: {
			type: 'number',
		},
		mediaUrl: {
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
		textContent: {
			type: 'array',
			source: 'children',
			selector: '.steps',
		},
	},
	edit: props => {
		const { attributes, setAttributes } = props;
		const { backgroundThumb, backgroundImageID, backgroundImageURL, textContent, rowGap, imagePos, contentMaxWidth } = attributes;

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
				'ONLY STRING'
			 ,
			 { actions: [ { label: 'Action', onClick: () => {
					alert( 'learn' );
				} } ] } );
		};
		return (
			<Fragment>
				<InspectorControls>
					<PanelBody
						title={ __( 'Settings', 'larslo-blocks' ) }
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
								console.log(hasmedia,"hasmedia",media)
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
							label={ __( 'Image Pos', 'larslo-blocks' ) }
							value={ imagePos || 'default' }
							onChange={ value => setAttributes( { imagePos: ( 'default' !== value ) ? value : undefined } ) }
							options={ [
								{ value: 'default', label: __( 'Left', 'larslo-blocks' ) },
								{ value: 'right', label: __( 'Right', 'larslo-blocks' ) },
							] }
						/>
						<SelectControl
							label={ __( 'Maximum Content Width', 'larslo-blocks' ) }
							value={ contentMaxWidth || '' }
							onChange={ value => setAttributes( { contentMaxWidth: ( 'site' !== value ) ? value : undefined } ) }
							options={ [
								{ value: '', label: __( 'Normale Breite', 'larslo-blocks' ) },
								{ value: 'full', label: __( 'Volle Breite', 'larslo-blocks' ) },
								{ value: 'fluid', label: __( 'Fließend', 'larslo-blocks' ) },
							] }
						/>
						<SelectControl
							label={ __( 'Lücke', 'larslo-blocks' ) }
							value={ rowGap || 'grid-x grid-margin-x' }
							onChange={ value => setAttributes( { rowGap: value } ) }
							options={ [
								{ value: 'grid-x grid-margin-x', label: __( 'Abstand', 'larslo-blocks' ) },
								{ value: 'grid-x ', label: __( 'kein Abstand', 'larslo-blocks' ) },
							] }
						/>
					</PanelBody>
				</InspectorControls>

				<Tooltip text="More information">

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
						></div>/*comment*/
						<div className="grid-item">
							<RichText
								tagName="div"
								multiline="p"
								className="steps"
								placeholder={ __( 'Text', 'larslo-blocks' ) }
								value={ textContent }
								onChange={ ( value ) => setAttributes( { textContent: value } ) }
							/>
						</div>

					</Section>
				 </Tooltip>
			</Fragment>
		);
	},
	save: props => {
		const { attributes, setAttributes } = props;
		const { backgroundImageURL, master_settings_open, rowGap, textContent, imagePos, contentMaxWidth, mediaId, mediaUrl } = attributes;
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
							<img className={ classnames( `wp-image-${ mediaId }` ) } src={ mediaUrl }></img>
						</figure>
					</div>
					<div className="cell medium-6">
						<RichText.Content tagName="div" className="steps" value={ textContent } />
					</div>
				</div>
			</section>
		);
	},
} );
