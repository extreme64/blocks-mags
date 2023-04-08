/**
 * Module for creating an block inspector layout, 
 * 
 * NumberControl - for number of slides that slider has ( !!! __experimentalNumberControl ),
 * ColorPicker - for choosing slider's background color
 * Modal - used with slides number changes
 * 
 * Main method: blockInspectorAssambley()
 * 
 * Part of modules: block-edit.js
 * 
 * @since 1.1.1
 * 
 * @package Blocks_Mags 
 * @subpackage Blocks_Mags/admin/js/slider-tp1
 */

const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;
const {
    PanelBody,
    Button,
    ColorPicker,
    Modal,
    TextControl,
    Icon,
    __experimentalNumberControl,
} = wp.components;

/* FIXME Document all */

/**
 * Modal window setup
 */
const componentModalInitialState = {
    modalShow: false
}

/**
 * Actions reducer for block component.
 */
const componentReducer = (initialState, action) => {
    let newState = initialState;
    switch (action) {
        case 'slide_num_change':
            newState = { modalShow: true }
            break;
        case 'close_modal':
            newState = { modalShow: false }
            break;
        // default:
        // 	throw new Error();
    }
    return newState;
};

/* Block's inspector UI components */
const blockInspectorAssambley = (attributes, setAttributes) => {

    const { sliderBackgroundColor } = attributes;

    return React.createElement(
        InspectorControls,
        null,
        React.createElement("p",
            {
                style: { "padding": "5px 20px", "font-weight": "600" }
            },
            "Add slides. Choose blocks for content (e.g. heading, paragraph or image)."
        ),
        React.createElement(
            PanelBody,
            {
                title: __("Settings", "pza-gutenberg"),
                initialOpen: true,
                icon: React.createElement(Icon, { icon: "admin-settings" }),
            },

            React.createElement("p", {},
                React.createElement(Icon, { icon: "images-alt" }),
                " Pick number of slides: ",

                numberOfSlidesSelector(attributes, setAttributes),
            ),

            React.createElement("p", {},
                React.createElement(Icon, { icon: "color-picker" }),
                " Choose background: ",

                React.createElement(ColorPicker, {
                    color: sliderBackgroundColor,
                    onChangeComplete: (color) => setAttributes({ sliderBackgroundColor: color.hex }),
                    disableAlpha: true
                })
            )
        )
    )
};

/**
 * Component used to pick number of slides for the Slider 
 * (a.k.a number of columns, one column is one slide)
 * 
 * @param {*} attributes  Passed attributes
 * @returns Element
 */
const numberOfSlidesSelector = (attributes) => {

    const { useState, useRef, useEffect, useReducer } = wp.element;

    // Dispatch actions
    const [state, dispatchAct] = useReducer(
        componentReducer,
        componentModalInitialState
    );

    /**
     * Values for number of slides functionality
     */
    const [sliderConfig, setSliderConfig] = useState(useRef(0))

    useEffect(() => {
        sliderConfig.current = attributes.numSlides;

    }, [attributes.numSlides]);

    const propsSliderModal = {
        className: "slider-modal-1",
        title: `Number of slides change`,
        shouldCloseOnEsc: false,
        shouldCloseOnClickOutside: false,
        onRequestClose: () => {
            dispatchAct("close_modal")
        }
    }
    const propsButtonModalOk = {
        isDefault: true,
        onClick: () => {
            dispatchAct("close_modal")
        }
    }
    const propsButtonModalCancel = {
        isDefault: true,
        onClick: () => {
            // Set component's value to previous one ( current )
            attributes.numSlides = sliderConfig.current = Number(sliderConfig.candidate)
            dispatchAct("close_modal")
        }
    }

    return React.createElement(
        "div",
        null,
        React.createElement(TextControl, {
            value: sliderConfig.current,
            onChange: (val) => {

                let newNuberOfSlides = parseInt(val, 10)

                if (attributes.numSlides > newNuberOfSlides) {
                    // Prep. component values
                    setSliderConfig({ current: attributes.numSlides, candidate: newNuberOfSlides })
                    // If we are reducing slides,
                    // guard the content in them.
                    // Dispatch action to open modal.
                    dispatchAct("slide_num_change")
                } else {
                    // Adding more slides, that's ok/content safe, just set value
                    attributes.numSlides = Number(val)
                    setSliderConfig({ current: newNuberOfSlides })
                }
            },
        }),
        /**
         * Modal components for number of slides.
         * 
         * Use buttons to stop or accept new 
         * picked value for the number of slides.
         */
        React.createElement(
            "div",
            null,
            state.modalShow && React.createElement(Modal,
                propsSliderModal,
                React.createElement("p", null,
                    `You are about to remove slides.
					Are you OK with losing content in those?`
                ),
                React.createElement(Button,
                    propsButtonModalOk,
                    "Return back"
                ),
                React.createElement(Button,
                    propsButtonModalCancel,
                    "OK. Change!"
                )
            )
        )


    )
};

export { blockInspectorAssambley, numberOfSlidesSelector }