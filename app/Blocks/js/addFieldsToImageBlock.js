/*
addFieldsToImageBlock
https://wordpress.stackexchange.com/questions/309395/gutenberg-add-a-custom-metabox-to-default-blocks

this is supposed to add an additional field to the inspector of the image block
*/

const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, TextControl } = wp.components;

// Register/add the new attribute.
const addExtraAttribute = props => {
    const attributes = {
        ...props.attributes,
        extra_attribute: {
            type: "string",
            default: "default_value"
        }
    };

    return { ...props, attributes };
};

addFilter(
    "blocks.registerBlockType",
    "yours/add-to-image/extra-attribute",
    addExtraAttribute
);

addFilter(
    "blocks.getSaveContent.extraProps",
    "yours/add-to-image/extra-attribute",
    addExtraData
);


const addTextControl = createHigherOrderComponent(BlockEdit => {
    return props => {
        const { attributes, setAttributes } = props;
        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody>
                        <TextControl
                            value={attributes.extra_attribute}
                            onChange={value => {
                                setAttributes({ extra_attribute: value });
                            }}
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, "withInspectorControl");

addFilter("editor.BlockEdit", "yours/add-to-image/extra-attribute", addTextControl);




// Add extra props. Here we assign an html
// data-attribute with the extra_attribute value.
const addExtraData = (props, block_type, attributes) => {
    return {
        ...props,
        "data-extra": attributes.extra_attribute
    }
};

