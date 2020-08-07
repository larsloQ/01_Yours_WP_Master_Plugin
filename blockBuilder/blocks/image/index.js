/*
 adding PanelColorSettings
 */
import classnames from 'classnames';

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

/******************************************************************************/
// end bootstrappin
/******************************************************************************/

import Section from './section';
import AMedia from './AMedia';

const blockNameId = 'larslo/image';

registerBlockType( blockNameId, { // this will show up in frontend as wp-block-larslo-section
	title: __( 'Larslo Image', 'larslo-blocks' ),
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

	},
	edit: props => {
		return (
			<Fragment>

				<AMedia
					onSelectMedia={ ( media )=>{
						console.log( media, 'onSelectMedia' );
					} }
				></AMedia>

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
