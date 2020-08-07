const el = wp.element.createElement;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;

const BLOCKS_TEMPLATE = [
['core/heading', { placeholder: 'Recipe Title' }],
	['core/columns', {},[
		['core/column', {}, [
			['core/image']
		]],
		['core/column', {},[
			['core/paragraph', { 
				source : "meta" , 
				meta : "my_block_meta", 
				placeholder: 'Enter short recipe description...' }],
			['core/paragraph', { placeholder: 'Enter ingredients...' }],
			['core/button', { text: 'Make this Recipe' }]
			]
		]
	]
]];
 
registerBlockType( 'myplugin/template', {
    title: 'My Template Block',
    category: 'widgets',
    attributes: {
			'my_attribute' : {
				'type'    :'string',
				'source'  :'meta',
				'meta'    :'my_block_meta',
				'default' : ""
			}
		},
    edit: ( props ) => {
        return el( InnerBlocks, {
            template: BLOCKS_TEMPLATE,
            templateLock: false
        });
    },
    save: ( props ) => {
        return el( InnerBlocks.Content, {} );
    },
});