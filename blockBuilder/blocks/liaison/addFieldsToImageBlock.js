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
const addExtraAttribute = (props) => {
    const attributes = { ...props.attributes}

    if (props.name === "core/image") {
        attributes['hover_text'] = {
            type: "string",
            default: "",
        };
        attributes['hover_link'] = {
            type: "string",
            default: "",
        };
    };
    // console.log(props.name, attributes)
    return { ...props, attributes };
};

addFilter(
    "blocks.registerBlockType",
    "yours/add-to-image/extra-attribute",
    addExtraAttribute
);



const addTextControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { attributes, setAttributes } = props;
        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    { props.name === "core/image" &&

                    <PanelBody title="Add image hover link" initialOpen={false}>
                        <label>"Text over"</label>
                        <TextControl
                            value={attributes.hover_text}
                            onChange={(value) => {
                                setAttributes({ hover_text: value });
                            }}
                        />
                        <label>"Link (with url)"</label>
                        <TextControl
                            value={attributes.hover_link}
                            onChange={(value) => {
                                setAttributes({ hover_link: value });
                            }}
                        />
                    </PanelBody>
                    }
                </InspectorControls>
            </Fragment>
        );
    };
}, "withInspectorControl");

addFilter(
    "editor.BlockEdit",
    "yours/add-to-image/extra-attribute",
    addTextControl
);



// Add extra props. Here we assign an html
// data-attribute with the hover_text value.
const addExtraData = (props, block_type, attributes) => {
    if (block_type.name == "core/image") {
        lodash.assign(props, {
            "data-hovertext": attributes.hover_text,
            "data-hoverlink": attributes.hover_link,
        });
        // console.log(props)
    }
        // console.log(block_type)
    return props;
};
addFilter(
    "blocks.getSaveContent.extraProps",
    "yours/add-to-image/extra-attribute",
    addExtraData
);

