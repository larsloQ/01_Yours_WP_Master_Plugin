// toolbar.js;
import classnames from 'classnames';

const {
	ToolbarButton,
	IconButton,
} = wp.components;

const {
	BlockControls,
} = wp.editor;

const { Component } = wp.element;

export default class LarsloResponsiveToogleBlockControls extends Component {
	constructor( props ) {
		super( ...arguments );
	}
	render() {
		const { adjustedMobile, adjustedMedium, adjustedLarge, alignment, align } = this.props.attributes;
		const classNameAll = 'larslo-toolbar-button-toggle';
		return (
			<BlockControls>
				<ToolbarButton
					containerClassName="mobil"
					title="Mobile Screens"
					isActive={ align === undefined }
					onClick={ ()=>{
						const clientId = wp.data.select( 'core/editor' ).getSelectedBlockClientId();
						wp.data.dispatch( 'core/editor' ).updateBlockAttributes( clientId, { align: undefined } );
					} }
					className={ classnames( classNameAll, adjustedMobile ? 'fine' : 'notyet' ) }
					isDisabled={ false }
					icon="smartphone"
				/>

				<ToolbarButton
					containerClassName="medium"
					title="Big Screens"
					isActive={ align === 'wide' }
					onClick={ ()=>{
						const newAlign = align === 'wide' ? undefined : 'wide';
						const clientId = wp.data.select( 'core/editor' ).getSelectedBlockClientId();
						wp.data.dispatch( 'core/editor' ).updateBlockAttributes( clientId, { align: newAlign } );
					} }
					className={ classnames( classNameAll, adjustedMedium ? 'fine' : 'notyet' ) }
					isDisabled={ false }
					icon="tablet"
				/>

				<ToolbarButton
					containerClassName="large"
					title="Large Screens"
					isActive={ align === 'full' }
					onClick={ ()=>{
						const newAlign = align === 'full' ? undefined : 'full';
						const clientId = wp.data.select( 'core/editor' ).getSelectedBlockClientId();
						wp.data.dispatch( 'core/editor' ).updateBlockAttributes( clientId, { align: newAlign } );
					} }
					className={ classnames( classNameAll, adjustedLarge ? 'fine' : 'notyet' ) }

					isDisabled={ false }
					icon="desktop"
				/>

			</BlockControls>
		);
	}
}
