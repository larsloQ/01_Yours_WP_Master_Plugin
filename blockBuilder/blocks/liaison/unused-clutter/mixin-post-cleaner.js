/**
 * Block dependencies
 */
import icon from './icon';
import edit from './edit-mixin'
// import './style.scss';

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Spinner } = wp.components;
const { withSelect } = wp.data;
const { withState } = wp.compose;
const { InspectorControls } = wp.editor;
const { TextControl, PanelBody, SelectControl } = wp.components;

const MySelectControl = withState( {
    size: '50%',
} )( ( { size, setState } ) => (
    <SelectControl
        label="Size"
        value={ size }
        options={ [
            { label: 'Big', value: '100%' },
            { label: 'Medium', value: '50%' },
            { label: 'Small', value: '25%' },
        ] }
        onChange={ ( size ) => { setState( { size } ) } }
    />
) );


registerBlockType(
    'liaison/mixinclean',
    {
        title: __( 'Mixin-Blogpost-Cleaner Larslo', 'yours'),
        description: __( '', 'yours'),
        icon: {
            background: 'rgba(254, 243, 224, 0.52)',
            src: icon,
        },   
        attributes: { 
            insitution : {
                'type'    :'string',
                'source'  :'meta',
                'meta'    :'team_member_institution',
                'default' : ""
            }
        },      
        category: 'widgets',
        edit, 
        save() {
            // Rendering in PHP
            return null;
        },
} );
