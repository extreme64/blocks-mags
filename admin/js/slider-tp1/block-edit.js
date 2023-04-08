/**
 * Module for creating and managing slider structure, 
 * Columns component is used as a main slider element.
 * We utilise InnerBlocks component to hold all of 
 * the slides - template: slidesTemplate( numSlides )
 * 
 * Main method: export { editContent }
 * 
 * Part of modules: main.js
 * 
 * @since 1.1.0
 * 
 * @package Blocks_Mags 
 * @subpackage Blocks_Mags/admin/js/slider-tp1
 */

const { __ } = wp.i18n;
const { InnerBlocks } = wp.blockEditor;
const {
    PanelBody,
} = wp.components;
const { select, dispatch } = wp.data;

import { blockInspectorAssambley } from "./block-inspector.js";
import { slidesTemplate } from "./block-template.js";

/**
 * Block edit 
 * 
 * @param {*} props Props. passed on edit
 * @returns 
 */
const editContent = (props) => {
    const { useEffect } = wp.element;
    const { attributes, setAttributes, clientId } = props;

    /** Allowed blocks that are allowed to be used within the slide: */
    const ALLOWED_BLOCKS = [
        "core/columns",
        "core/image",
        "core/paragraph",
        "core/heading"
    ];

    /** Inner block wrap element styling. 
     * 
     * 'sliderBackgroundColor' - color from block's inspector ColorPicker
    */
    const STYLES = {
        background: attributes.sliderBackgroundColor
    };

    // Function to update slide classes
    const updateSlideClasses = (blocks) => {
        let i = 0;
        blocks.forEach(function (child) {
            if (i === 0) {
                // set first slide to be visible
                dispatch("core/block-editor").updateBlockAttributes(child.clientId, {
                    className: `slide active slide-${i + 1}`,
                });
            } else {
                dispatch("core/block-editor").updateBlockAttributes(child.clientId, {
                    className: `slide slide-${i + 1}`,
                });
            }
            i++;
        });
    };

    // Get content blocks 
    let children = select("core/block-editor").getBlocksByClientId(clientId)[0].innerBlocks;

    // Update slide classes
    updateSlideClasses(children);

    useEffect(() => {
        const blocks = select("core/block-editor").getBlocksByClientId(clientId);
        const parentBlock = blocks[0]
        const innerBlocksLength = parentBlock.innerBlocks.length

        if (innerBlocksLength > attributes.numSlides) {

            const numToRemove = innerBlocksLength - attributes.numSlides;

            for (let i = 0; i < numToRemove; i++) {
                const lastIndex = Number(innerBlocksLength - 1 - i);
                const removedBlock = parentBlock.innerBlocks[lastIndex];
                dispatch("core/block-editor").removeBlock(removedBlock.clientId);
            }

        } else if (innerBlocksLength < attributes.numSlides) {

            const parenBlockId = parentBlock.clientId
            const numToAdd = attributes.numSlides - innerBlocksLength;

            for (let i = 0; i < numToAdd; i++) {
                const columnsBlock = wp.blocks.createBlock("core/columns", {
                    columns: 2,
                    innerBlocks: []
                });
                dispatch("core/block-editor").insertBlock(columnsBlock, Number(attributes.numSlides - 1 + i), parenBlockId);
            }
        }
    }, [attributes.numSlides]);


    return React.createElement(
        "div",
        {
            className: props.className,
        },

        /* Block's inspector UI components */
        blockInspectorAssambley(attributes, setAttributes),


        /* Block edit components */
        React.createElement(
            PanelBody,
            {
                title: __("Slider TP1 - BMags", "blocks-mags"),
                initialOpen: true,
                icon: "slides",
                instructions: "Choose content for slides. Use Heading, Paragraph or Image blocks!"
            },
            React.createElement("div",
                {
                    style: STYLES
                },
                React.createElement(InnerBlocks,
                    {
                        template: slidesTemplate(attributes.numSlides),
                        orientation: "horizontal",
                        allowedBlocks: ALLOWED_BLOCKS,
                    }
                ),
            )
        ),
    );
};

export { editContent }
