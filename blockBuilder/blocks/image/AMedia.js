/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;

const {
	IconButton, ResizableBox, Toolbar,
} = wp.components;

const {
	InspectorControls,
	BlockControls,
	MediaPlaceholder,
	MediaUpload,
} = wp.editor;

/**
 * Constants
 */
const ALLOWED_MEDIA_TYPES = [ 'image' ];

class AMedia extends Component {
	renderToolbarEditButton() {
		const { mediaId, onSelectMedia } = this.props;
		return (
			<BlockControls>
				<Toolbar>
					<MediaUpload
						onSelect={ onSelectMedia }
						allowedTypes={ ALLOWED_MEDIA_TYPES }
						value={ mediaId }
						render={ ( { open } ) => (
							<IconButton
								className="components-toolbar__control"
								label={ __( 'Edit media' ) }
								icon="edit"
								onClick={ open }
							/>
						) }
					/>
				</Toolbar>
			</BlockControls>
		);
	}

	renderImage() {
		const { mediaAlt, mediaUrl, className } = this.props;
		return (
			<Fragment>
				{ this.renderToolbarEditButton() }
				<figure className={ className }>
					<img src={ mediaUrl } alt={ mediaAlt } />
				</figure>
			</Fragment>
		);
	}

	renderPlaceholder() {
		const { onSelectMedia, className } = this.props;
		return (
			<MediaPlaceholder
				icon="format-image"
				labels={ {
					title: __( 'Media area' ),
				} }
				className={ className }
				onSelect={ onSelectMedia }
				accept="image/*"
				allowedTypes={ ALLOWED_MEDIA_TYPES }
			/>
		);
	}

	render() {
		const {
			mediaPosition,
			mediaUrl,
			mediaType,
			mediaWidth,
			commitWidthChange,
			onWidthChange,
		} = this.props;

		if ( mediaType && mediaUrl ) {
			const onResize = ( event, direction, elt ) => {
				onWidthChange( parseInt( elt.style.width ) );
			};
			const onResizeStop = ( event, direction, elt ) => {
				commitWidthChange( parseInt( elt.style.width ) );
			};
			const enablePositions = {
				right: mediaPosition === 'left',
				left: mediaPosition === 'right',
			};

			mediaElement = this.renderImage();

			return (
				<Fragment>
					<InspectorControls>
						<PanelBody
							title={ __( 'SIDEBAR FOR A CHILD' ) }
							initialOpen={ true }
						></PanelBody>
					</InspectorControls>

					<ResizableBox
						className="editor-media-container__resizer"
						size={ { width: mediaWidth + '%' } }
						minWidth="10%"
						maxWidth="100%"
						enable={ enablePositions }
						onResize={ onResize }
						onResizeStop={ onResizeStop }
						axis="x"
					>
						{ mediaElement }
					</ResizableBox>
				</Fragment>
			);
		}
		return this.renderPlaceholder();
	}
}

export default AMedia;
