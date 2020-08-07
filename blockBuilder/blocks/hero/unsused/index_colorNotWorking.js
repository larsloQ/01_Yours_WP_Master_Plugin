/*
 adding PanelColorSettings
 */
import classnames from 'classnames';

import Section from './section';

const blockNameId = 'larslo/hero';

const { Fragment } = wp.element;

const {
	PanelBody,
	SelectControl,
	Tooltip,
} = wp.components;

const {
	InspectorControls,
	MediaUpload,
	RichText,
	PanelColorSettings,
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
		headline: {
			type: 'array',
			source: 'children',
			selector: '.headline',
		},
		headlineColor: {
			type: 'string',
			default: '#000',
		},
		headlineselected: {
			type: 'boolean',
			default: false,
		},
	},
	edit: props => {
		const { attributes, setAttributes } = props;
		const { headlineselected, headline, headlineColor, backgroundThumb, backgroundImageID, backgroundImageURL, textContent, rowGap, imagePos, contentMaxWidth } = attributes;

		// const  = "left";
		const onSelectImage = media => {
			if ( ! media || ! media.id || ! media.url ) {
				return;
			}
			return { _id: media.id, _url: media.url, _thumb: media.sizes.thumbnail.url };
		};
		const onMainMediaSelected = ()=>{
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
					{ headlineselected &&
					<PanelColorSettings
						title={ __( 'Color for Headline', 'larslo-blocks' ) }
						initialOpen={ true }
						colorSettings={ [ {
							value: headlineColor,
							onChange: ( value ) => {
								// console.log( value );
								// console.log( headlineColor );
								setAttributes( { headlineColor: value } );
							},
							label: __( 'Headlinecolor Color' ),
						} ] }
					/>
					}
				</InspectorControls>
				<Tooltip text="More information">
					<Section
						imagePos={ imagePos }
						rowGap={ rowGap }
						contentMaxWidth={ contentMaxWidth }
						className={ classnames() }
					>
						<div className="bg-thing"
							style={ {
								backgroundImage: `url(${ backgroundImageURL })`,
								backgroundSize: 'cover',
								minHeight: '500px',
								backgroundPosition: 'center',
							} }
						></div>
						<div className="grid-item">
							<div
								onFocus={ () => {
								// display color settings
									// headlineselected = true;
									setAttributes( { headlineselected: true } );
									console.log( 'FOUCHS' );
								} }
								onBlur={	() => {
									// headlineselected = false;
									setAttributes( { headlineselected: false } );
									console.log( 'blur' );
								}
								}
							>
								<RichText
									style={ {
										color: { headlineColor },
									} }
									tagName="h2"
									className="headline"
									multiline="h2"
									placeholder="Headline"
									keepPlaceholderOnFocus={ false }
									value={ headline }
									formattingControls={ [] }
									onChange={ ( value ) => setAttributes( { headline: value } ) }
								/>
							</div>
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
		const { headline, backgroundImageURL, master_settings_open, rowGap, textContent, imagePos, contentMaxWidth, mediaId, mediaUrl } = attributes;
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
						<RichText.Content tagName="h2" value={ headline } />
						<RichText.Content tagName="div" className="steps" value={ textContent } />
					</div>
				</div>
			</section>
		);
	},
} );
