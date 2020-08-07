// Inspector.js;
const {
	SelectControl,
	PanelBody,
	RangeControl,
	ToggleControl,
} = wp.components;

const {
	InspectorControls,
	MediaUpload,
	PanelColorSettings,
} = wp.editor;

const { Component } = wp.element;

export default class Inspector extends Component {
	constructor( props ) {
		super( ...arguments );
	}
	render() {
		const { attributes, setAttributes } = this.props;
		// console.log( this.props );
		const {
			adjustedMobile, adjustedMedium, adjustedLarge,
			mobileHeight,
			align, alignment, headline, headlineColor, backgroundThumb, backgroundImageID,
			backgroundImageURL, textContent, rowGap, imagePos, contentMaxWidth,
		} = this.props.attributes;

		// const mobileHeight = 400;
		const onSelectImage = media => {
			if ( ! media || ! media.id || ! media.url ) {
				return;
			}
			return { _id: media.id, _url: media.url, _thumb: media.sizes.thumbnail.url };
		};
		const onMainMediaSelected = ()=>{
			// console.log( currentWidth );
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
		/* attr needs to be an attribute */
	 function renderRange( label, attr, min, max, step ) {
			const attributeValue = attributes[ attr ];
			return (
				<RangeControl
					label={ __( `${ label }` ) }
					value={ attributeValue }
					onChange={ ( value ) => {
						setAttributes( { [ attr ]: value } );
					}
					}
					min={ min }
					max={ max }
					step={ step }
				/>
			);
		}

		return (
			<InspectorControls>
				{ align == undefined &&
				<PanelBody
					title={ __( 'Small Screens Settings', 'larslo-blocks' ) }
					initialOpen={ true }
				>
					{ renderRange( 'Mobile Height', 'mobileHeight', 300, 600, 20 ) }

				</PanelBody>
				}
				{ align === 'wide' &&
				<PanelBody
					title={ __( 'Bigger Screens Settings', 'larslo-blocks' ) }
					initialOpen={ true }
				></PanelBody>
				}
				{ align === 'full' &&
				<PanelBody
					title={ __( 'large Screens Settings', 'larslo-blocks' ) }
					initialOpen={ true }
				></PanelBody>
				}
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
		);
	}
}
