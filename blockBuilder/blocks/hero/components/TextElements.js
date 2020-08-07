// ImageClever;
import Radium from 'radium';

const { Component, Fragment } = wp.element;
// const { compose, withInstanceId } = wp.compose;
// const { withViewportMatch } = wp.viewport;
// const { withSelect } = wp.data;
const {
	RichText,
} = wp.editor;
// const { withBlockEditContext } = wp.editor;
// withBlockEditContext

import classnames from 'classnames';

class TextElements extends Component {
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
			align,
			headlineColor,
			headline,
			textContent,
		 } = this.props.attributes;

		 const styles = this.getStyles();

		 let internalAlign = align;
		 if ( internalAlign == undefined ) {
			internalAlign = 'small';
		}
		 // console.log( internalAlign, styles, styles[ internalAlign ] );
		return (
			<Fragment>
				<div className="grid-item texts">
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
			</Fragment>
		);
	}
}

export default TextElements;
