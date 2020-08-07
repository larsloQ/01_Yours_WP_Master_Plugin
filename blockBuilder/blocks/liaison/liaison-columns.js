const el = wp.element.createElement;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;

//  * LIST ALL BLOCK ATTRIBUTES (IN WEBDEV)
//  * var block = wp.blocks.getBlockType('core/gallery');
// var attrs = block ? block.attributes : {};
// console.log( attrs, block );


const BLOCKS_TEMPLATE = [
	['core/columns', {
		align: 'wide',
		className: 'liasion-columns',
		description: "Please do not change Number of Columns. If you don't want to add a Link, remove the Button-Element"
	},[
		['core/column', {}, [
			['core/image']
		]],
		['core/column', {},[
			[ 'core/heading', { level: '3', className: 'serif',placeholder: 'Set Sup-Headline' } ],
			[ 'core/heading', { level: '2', className: 'white',placeholder: 'Set Headline' } ],
			[ 'core/paragraph', { className: 'white',placeholder: 'Write entry text' } ],
			[ 'core/button', {
				className: 'link',
				content: 'Read More',
				description: 'Read More will not be displayed as long as you do not set URL/LINK. '
			} ]
		]
		]
	]
	]];

 
registerBlockType( 'liaison/columns', {
	title: '2 Columns Template (LIAISON)',
	description: "Please do not change Number of Columns. If you don't want to add a Link, remove the Button-Element",
	category: 'liaison',
	className: 'liasion-columns',
	edit: ( props ) => el( InnerBlocks, {
		template: BLOCKS_TEMPLATE,
		templateLock: 'all'
	}),
	save: ( props ) => el( InnerBlocks.Content, {} )
});