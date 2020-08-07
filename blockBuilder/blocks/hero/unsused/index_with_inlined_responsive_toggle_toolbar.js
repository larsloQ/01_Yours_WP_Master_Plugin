/*
 adding PanelColorSettings

 here i try to use viewModes (full, wide (see support)) to switch image thing
 */
import classnames from 'classnames';
import Section from './section';
import ImageClever from './ImageClever';
// import getIcon from '../../icons/blocklabIcons'; // this is not working somehow use dashicons instead packages/components/build/dashicon/index.js

const blockNameId = 'larslo/hero'; // attention with renaming css need this as a selector
/* view modes an more */
const supports = {
	align: [ 'wide', 'full' ], // we hide this functionsliyy but hide with css components-toolbar components-toolbar
	anchor: true,
};
const attributes = {
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
	headline: {
		type: 'array',
		source: 'children',
		selector: '.headline',
	},
	headlineColor: {
		type: 'string',
		default: '#000',
	},
	alignment: {
		type: 'string',
	},

};

const { Fragment } = wp.element;

const {
	PanelBody,
	SelectControl,
	Tooltip,
	ToolbarButton,
	IconButton,
} = wp.components;

const {
	InspectorControls,
	MediaUpload,
	RichText,
	PanelColorSettings,
	BlockControls,
	BlockAlignmentToolbar,
} = wp.editor;

const { __, _x } = wp.i18n;

const registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() to register blocks.

registerBlockType( blockNameId, { // this will show up in frontend as wp-block-larslo-section
	title: __( 'Heroo Area', 'larslo-blocks' ),
	description: __( '...coming so0000on...', 'larslo-blocks' ),
	category: 'layout',
	icon: 'welcome-widgets-menus',
	keywords: [
		_x( 'section', 'keyword', 'larslo-blocks' ),
		_x( 'separator', 'keyword', 'larslo-blocks' ),
	],
	supports,
	attributes,
	edit: props => {
		const { attributes, setAttributes } = props;
		const { align, alignment, headline, headlineColor, backgroundThumb, backgroundImageID, backgroundImageURL, textContent, rowGap, imagePos, contentMaxWidth } = attributes;

		const currentWidth = wp.data.select( 'core/editor' ).getEditorSettings();

		// const  = "left";
		const onSelectImage = media => {
			if ( ! media || ! media.id || ! media.url ) {
				return;
			}
			return { _id: media.id, _url: media.url, _thumb: media.sizes.thumbnail.url };
		};
		const onMainMediaSelected = ()=>{
			console.log( currentWidth );
			// console.log( onMainMediaSelected, 'onMainMediaSelected' );
			/* check media and NOTICE*/
			wp.data.dispatch( 'core/notices' ).createNotice(
				'error',
				'ONLY STRING',
				{ actions: [ { label: 'Action', onClick: () => {
					// alert( 'learn' );
				} } ] } );
		};

		/* remove a former image*/
		const onRemoveImage = () => {
			setAttributes(
				{
					backgroundImageURL: '',
					backgroundImageID: null,
					backgroundThumb: null,
				}
			);
		};
		return (
			<Fragment
				dataAlign={ alignment }
				className="Muttherfuccc"
			>
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
								// console.log(hasmedia,"hasmedia",media)
							} }
							type="image"
							value={ backgroundImageID }
							render={ ( { open } ) => (
								<button onClick={ open }>
									{
										backgroundThumb ?
											<div>
												<img alt="background" src={ backgroundThumb }></img>
											</div> :
										 'Set Image'
									}
								</button>

							) }
						/>
						{ backgroundThumb && <button onClick={ onRemoveImage }>remove</button> }
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

					<PanelColorSettings
						title={ __( 'Color for Headline', 'larslo-blocks' ) }
						initialOpen={ true }
						colorSettings={ [
							 {
								value: headlineColor,
								onChange: ( colorValue ) => setAttributes( { headlineColor: colorValue } ),
								label: __( 'Headline Color' ),
							},
						] }
					/>

				</InspectorControls>
				<Tooltip text="More information">
					<BlockControls>

						<ToolbarButton
							containerClassName="my motherfugger"
							title="my motherfugger"
							isActive={ align === undefined }
							onClick={ ()=>{
								const clientId = wp.data.select( 'core/editor' ).getSelectedBlockClientId();
								wp.data.dispatch( 'core/editor' ).updateBlockAttributes( clientId, { align: undefined } );
							} }
							className={ classnames( 'larslo-width-toogle-wide' ) }
							isDisabled={ false }
							icon="smartphone"
						>
						</ToolbarButton>
						<ToolbarButton
							containerClassName="my motherfugger"
							title="my motherfugger"
							isActive={ align === 'wide' }
							onClick={ ()=>{
								const newAlign = align === 'wide' ? undefined : 'wide';
								const clientId = wp.data.select( 'core/editor' ).getSelectedBlockClientId();
								wp.data.dispatch( 'core/editor' ).updateBlockAttributes( clientId, { align: newAlign } );
							} }
							className={ classnames( 'larslo-width-toogle-wide' ) }
							isDisabled={ false }
							icon="tablet"
						>

						</ToolbarButton>
						<ToolbarButton
							containerClassName="my motherfugger"
							title="my motherfugger"
							isActive={ align === 'full' }
							onClick={ ()=>{
								const newAlign = align === 'full' ? undefined : 'full';
								const clientId = wp.data.select( 'core/editor' ).getSelectedBlockClientId();
								wp.data.dispatch( 'core/editor' ).updateBlockAttributes( clientId, { align: newAlign } );
							} }
							className={ classnames( 'larslo-width-toogle-wide' ) }
							isDisabled={ false }
							icon="desktop"
						>
						</ToolbarButton>
						<button
							onClick={ ( alignment ) => {
								// setAttributes( { alignment: 'full' } );
								/* this firest action of type UPDATE_BLOCK_ATTRIBUTES */

								// console.log( alignment );
							}	}
						>hi</button>
						{
							/*
				<BlockAlignmentToolbar
							value={ alignment }
						/>
	 */
						}
					</BlockControls>
					<Section
						imagePos={ imagePos }
						rowGap={ rowGap }
						contentMaxWidth={ contentMaxWidth }
						className={ classnames() }
					>
						<ImageClever { ...attributes } ></ImageClever
						>
						<div className="grid-item">
							<RichText
								style={ {
									color: headlineColor,
								} }
								tagName="h2"
								multiline="h2"
								className="headline"
								placeholder="Headline"
								value={ headline }
								formattingControls={ [] }
								onChange={ ( value ) => setAttributes( { headline: value } )	}
							/>
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
		const { headlineColor, headline, backgroundImageURL, rowGap, textContent, imagePos, contentMaxWidth, mediaId, mediaUrl } = attributes;
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
						{ mediaId &&
						<figure>
							<img className={ classnames( mediaId && `wp-image-${ mediaId }` ) } src={ mediaUrl }></img>
						</figure>
					  }
					</div>
					<div className="cell medium-6">
						<RichText.Content tagName="h2" className="headline" value={ headline }
							style={ {
								color: headlineColor,
							} } />
						<RichText.Content tagName="div" className="steps" value={ textContent } />
					</div>
				</div>
			</section>
		);
	},
} );
