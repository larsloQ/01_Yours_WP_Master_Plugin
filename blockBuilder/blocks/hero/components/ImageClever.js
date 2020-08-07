// ImageClever;
import Radium from 'radium';

const { Component } = wp.element;
const { compose, withInstanceId } = wp.compose;
const { withViewportMatch } = wp.viewport;
const { withSelect } = wp.data;
// const { withBlockEditContext } = wp.editor;
// withBlockEditContext

import classnames from 'classnames';

class ImageClever extends Component {
	constructor( props ) {
		super( ...arguments );
	}

	getStyles() {
		const { align, backgroundImageURL, mobileHeight } = this.props.attributes;

		if ( backgroundImageURL ) {
			return {
				small: {
					height: mobileHeight ? `${ mobileHeight }px` : '400px',
				},
				wide: {
					minHeight: '500px',
				},
				full: {
					minHeight: '500px',
				},
			};
		}
		return {};
	}

	render() {
		const {
			mobileHeight,
			align, wideControlsEnabled, isCollapsed, isLargeViewport, headline, headlineColor,
			 backgroundThumb, backgroundImageID,
			backgroundImageURL, textContent, rowGap, imagePos,
			contentMaxWidth } = this.props.attributes;

		 const styles = this.getStyles();

		 let internalAlign = align;
		 if ( internalAlign == undefined ) {
			internalAlign = 'small';
		}
		 console.log( internalAlign, styles, styles[ internalAlign ] );
		return (
			<div className="grid-item image">
				<div className="bg-thing"
					style={ {
						...styles[ internalAlign ],
						backgroundImage: `url(${ backgroundImageURL })`,
						backgroundSize: 'cover',
						backgroundPosition: 'center',
					} }
				>
				</div>
				<style jsx>{ `
      .bg-thing {
        border: 3px solid red;
      }
    ` }</style>
			</div>
		);
	}
}

export default ImageClever;
