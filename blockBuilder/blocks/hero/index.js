/*
 adding PanelColorSettings

 here i try to use viewModes (full, wide (see support)) to switch image thing
 */
import classnames from 'classnames';
import Section from './components/section';
import ImageClever from './components/ImageClever';
import ImageCleverFrontEnd from './components/ImageCleverFrontEnd';
import LarsloResponsiveToogleBlockControls from './components/LarsloResponsiveToogleBlockControls';
import Inspector from './components/Inspector';
import TextElements from './components/TextElements';
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
	adjustedMobile: {
		type: 'boolean',
	},
	adjustedMedium: {
		type: 'boolean',
	},
	adjustedLarge: {
		type: 'boolean',
	},
	mobileHeight: {
		type: 'number',
		default: 400,
	},
};

const { Fragment } = wp.element;

const {
	Tooltip,
} = wp.components;

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
	// deprecated: props => {
	// 	isEligible = () => {
	// 		return true;
	// 	};
	// },
	edit: props => {
		const { attributes, setAttributes } = props;
		const { align, alignment, headline, headlineColor,
			backgroundThumb, backgroundImageID,
			backgroundImageURL, textContent, rowGap, imagePos, contentMaxWidth } = attributes;
		// console.log( props );
		const currentWidth = wp.data.select( 'core/editor' ).getEditorSettings();
		// console.log( attributes );
		return (
			<Fragment>
				<Inspector { ...props }></Inspector>
				<LarsloResponsiveToogleBlockControls { ...props }> </LarsloResponsiveToogleBlockControls>

				<Tooltip text="More information">
					<Section
						imagePos={ imagePos }
						rowGap={ rowGap }
						contentMaxWidth={ contentMaxWidth }
						className={ classnames() }
						align={ align }
					>
						<ImageClever { ...props } ></ImageClever>
						<TextElements { ...props }></TextElements>
					</Section>
				</Tooltip>
			</Fragment>
		);
	},
	save: props => {
		 // Rendering in PHP, see hero_serverside_render.php
		return null;
	},
	// save: props => {
	// 	const { attributes, setAttributes } = props;
	// 	const {
	// 		backgroundImageID, backgroundImageURL,
	// 		headlineColor, headline,
	// 		rowGap, textContent, imagePos, contentMaxWidth, mediaId, mediaUrl,
	// 	} = attributes;

	// 	/* always set wp-image-ID for image files to have wordpress imagesizes calculated auto */
	// 	return (
	// 		<section
	// 			className={ classnames( 'grid-container', contentMaxWidth ) }
	// 		>
	// 			<div
	// 				className="bg-thing"
	// 				style={ {
	// 					backgroundImage: `url(${ backgroundImageURL })`,
	// 					backgroundSize: 'cover',
	// 					backgroundPosition: 'center',
	// 				} }
	// 			></div>
	// 			<div className={ classnames( 'grid-x', rowGap ) }>
	// 				<div className="cell medium-6">
	// 					{ backgroundImageID &&
	// 						<ImageCleverFrontEnd { ...props } ></ImageCleverFrontEnd>
	// 				  }
	// 				</div>
	// 				<div className="cell medium-6">
	// 					<RichText.Content tagName="h2" className="headline" value={ headline }
	// 						style={ {
	// 							color: headlineColor,
	// 						} } />
	// 					<RichText.Content tagName="div" className="steps" value={ textContent } />
	// 				</div>
	// 			</div>
	// 		</section>
	// 	);
	// },
} );
