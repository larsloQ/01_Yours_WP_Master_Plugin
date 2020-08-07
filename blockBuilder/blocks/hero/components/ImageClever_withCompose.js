// ImageClever;
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

	render() {
		const { alignment, wideControlsEnabled, isCollapsed, isLargeViewport, headline, headlineColor, backgroundThumb, backgroundImageID,
			backgroundImageURL, textContent, rowGap, imagePos, contentMaxWidth } = this.props;
		// console.log( ' UUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU' );
		// console.log( ' UUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU' );
		// console.log( ' UUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU' );
		console.log( ' UUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU' );
		console.log( backgroundImageURL );
		// console.log( this.props );
		return (
			<div className="bg-thing"
				style={ {
					backgroundImage: `url(${ backgroundImageURL })`,
					backgroundSize: 'cover',
					minHeight: '500px',
					backgroundPosition: 'center',
				} }
			>
			</div>
		);
	}
}
/* this simply adds an id (1,2,3) not blockID*/
// export default withInstanceId( ImageClever );
// export default withGlobalEvents( ImageClever ); // not working needs an object
export default compose(
	// withViewportMatch( { isLargeViewport: 'medium' } ),
	withSelect( ( select, ownProps ) => {
		const { getBlockRootClientId, getEditorSettings } = select( 'core/editor' );
		// console.log( 'SSSSSSSSSSSSSSSSSSSSS', select );
		// /console.log( 'OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO', ownProps );

		// console.log( wp.data.select( 'core/editor' ).getSelectedBlockClientId() );
		// const clientId = wp.data.select( 'core/editor' ).getSelectedBlockClientId();
		//
	   // wp.data.dispatch( 'core/editor' ).updateBlockAttributes( clientId, { align: ownProps.alignment } );

		// updateBlockAttributes
		return {
			// wideControlsEnabled: 'hi',
			wideControlsEnabled: select( 'core/editor' ).getEditorSettings().alignWide,
			// isCollapsed: isCollapsed || ! isLargeViewport || (
			// 	! getEditorSettings().hasFixedToolbar &&
			//      getBlockRootClientId( clientId )
			// ),
		};
	} ),
)( ImageClever );

