// ImageClever;

const { Component } = wp.element;
const { compose, withInstanceId } = wp.compose;
const { withViewportMatch } = wp.viewport;
const { withSelect } = wp.data;
// const { withBlockEditContext } = wp.editor;
// withBlockEditContext

import classnames from 'classnames';

class ImageCleverFrontEnd extends Component {
	constructor( props ) {
		super( ...arguments );
	}

	getStyles() {
		const { align, backgroundImageURL, mobileHeight } = this.props.attributes;

		if ( backgroundImageURL ) {
			return {
				'@media (max-width: 100em)': {
			      display: 'none',
		    },
			};
		}
		return {};
	}

	render() {
		const {
			mobileHeight,
			align, wideControlsEnabled, isCollapsed, isLargeViewport, headline, headlineColor,
			backgroundThumb,
			backgroundImageID, backgroundImageURL,
			rowGap, imagePos,
			contentMaxWidth } = this.props.attributes;

		 const styles = this.getStyles();

		return (
			<figure className={ classnames( backgroundImageID && `wp-image-${ backgroundImageID }-wrap` ) }>
				<style dangerouslySetInnerHTML={ { __html: `
				  @media (max-width: 600px) {

				    .wp-image-${ backgroundImageID }-wrap { 
							height: ${ mobileHeight }px;
							overflow = hidden;
				    }
				  }	
				` } } />
				<img className={ classnames( backgroundImageID && `wp-image-${ backgroundImageID }` ) } src={ backgroundImageURL }></img>
			</figure>
		);
	}
}

export default ImageCleverFrontEnd;
