/**
 *  Editor save function for Casino Score block.
 * 
 * @since     1.1.3
 */

const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;
const {
    PanelBody,
    Panel,
    PanelRow,
    TextControl,
    CheckboxControl,
    TreeSelect,
    SelectControl
} = wp.components;
const { useState, useEffect } = wp.element;

/**
 *
 * @param {*} props
 * @returns
 */
const editContent = (props) => {

    const intDomain = 'block';

    const { attributes, setAttributes, clientId } = props;
    const [starInnerHtml, setStarInnerHtml] = useState()
    const [starClasses, setStarClasses] = useState()
    const [ctaClasses, setCtaClasses] = useState()

    const title = wp.data.select("core/editor").getEditedPostAttribute("title");
    let casino_custom = wp.data
        .select("core/editor")
        .getEditedPostAttribute("casino_custom");

    if (casino_custom === undefined) {
        console.log("No casino_custom data");
    }

    useEffect(() => {

        switch (attributes.styleCTA) {
            case 'dark':
            case 'ds1':
                setCtaClasses('hover-color-orange-button')
                break
            case 'light':
            case 'ls1':
                setCtaClasses('hover-color-light-button')
                break
            default:
                setCtaClasses('hover-color-orange-button')
                break
        }

    }, [attributes.styleCTA]);


    useEffect(() => {

        switch (attributes.starStyle) {
            case '1':
                setStarInnerHtml("")
                setStarClasses("fas fa-star star style--1")
                break
            case '2':
                setStarInnerHtml("")
                setStarClasses("fas fa-star star style--2")
                break
            case '3':
                setStarInnerHtml("⭐")
                setStarClasses("star style--3")
                break
            default:
                setStarInnerHtml("---")
                setStarClasses("star style--3")
                break
        }

    }, [attributes.starStyle]);


    return React.createElement(
        "div",
        {
            className: props.className,
        },

        React.createElement(
            InspectorControls,
            null,
            React.createElement(
                Panel,
                { header: __("Rating Settings", intDomain) },
                React.createElement(
                    PanelBody,
                    { title: __("Stars Style", intDomain), initialOpen: true },

                    React.createElement(SelectControl, {
                        value: attributes.starStyle,
                        onChange: (val) => {
                            setAttributes({ starStyle: val });
                        },
                        options: [
                            {
                                disabled: true,
                                label: "Select a Style",
                                value: "-1",
                            },
                            {
                                label: "Light Font Awesome",
                                value: "1",
                            },
                            {
                                label: "Dark Font Awesome",
                                value: "2",
                            },
                            {
                                label: "Emoji",
                                value: "3"
                            },
                        ],
                    })
                )
            ),
            React.createElement(
                Panel,
                { header: __("CTA Button", intDomain) },
                React.createElement(
                    PanelBody,
                    { title: "Button Settings", initialOpen: false },
                    React.createElement(
                        PanelRow,
                        null,
                        React.createElement(CheckboxControl, {
                            label: "CTA Button",
                            help: "Show CTA button?",
                            checked: attributes.showCTA,
                            onChange: (val) => {
                                setAttributes({ showCTA: val });
                            },
                        })
                    ),
                    React.createElement(
                        PanelRow,
                        null,
                        React.createElement(TextControl, {
                            label: "Button Text",
                            value: attributes.textCTA,
                            onChange: (val) => {
                                setAttributes({ textCTA: val });
                            },
                        })
                    ),
                    React.createElement(TreeSelect, {
                        help: "Select CTA button style.",
                        label: "Pick style.",
                        noOptionLabel: "Default",
                        value: attributes.styleCTA,
                        onChange: (val) => {
                            console.dir(val);
                            setAttributes({ styleCTA: val });
                        },
                        tree: [
                            {
                                children: [
                                    {
                                        key: "ds1",
                                        id: "ds1",
                                        name: "Dark Style 1",
                                    },
                                ],
                                key: "dark",
                                id: "dark",
                                name: "Dark",
                            },
                            {
                                children: [
                                    {
                                        key: "ls1",
                                        id: "ls1",
                                        name: "Light Style 1",
                                    },
                                ],
                                key: "light",
                                id: "light",
                                name: "Light",
                            },
                        ],
                    })
                )
            )
        ),
        React.createElement(
            "div",
            null,
            React.createElement(
                PanelBody,
                {
                    title: __("Casino Scores", intDomain),
                    initialOpen: true,
                },
                React.createElement(
                    "div",
                    { class: "wp-block-pza-casino-score__block-inner" },
                    React.createElement(
                        "p",
                        { class: "wp-block-pza-casino-score__title" },
                        title
                    ),
                    React.createElement(
                        "p",
                        { class: "wp-block-pza-casino-score__scors" },
                        React.createElement(
                            "ul",
                            {
                                class: "wp-block-pza-casino-score__scors-list",
                            },
                            React.createElement(
                                "li",
                                null,
                                `Trust: 	${casino_custom.trust}`,
                                React.createElement(
                                    "i",
                                    { class: `${starClasses}` },
                                    starInnerHtml
                                )
                            ),
                            React.createElement(
                                "li",
                                null,
                                `Games: 	${casino_custom.games}`,
                                React.createElement(
                                    "i",
                                    { class: `${starClasses}` },
                                    starInnerHtml
                                )
                            ),
                            React.createElement(
                                "li",
                                null,
                                `Bonus: 	${casino_custom.bonus}`,
                                React.createElement(
                                    "i",
                                    { class: `${starClasses}` },
                                    starInnerHtml
                                )
                            ),
                            React.createElement(
                                "li",
                                null,
                                `Customer: 	${casino_custom.customer}`,
                                React.createElement(
                                    "i",
                                    { class: `${starClasses}` },
                                    starInnerHtml
                                )
                            )
                        )
                    ),
                    React.createElement(
                        "span",
                        { class: "wp-block-pza-casino-score__overall" },
                        `Overall: ${casino_custom.overall}`
                    )
                ),
                attributes.showCTA &&
                React.createElement(
                    "button",
                    {
                        class:
                            "wp-block-pza-casino-score__cta-btn " + ctaClasses,
                    },
                    attributes.textCTA
                ),

                React.createElement("serverSideRender", {
                    className: "class-test",
                    block: "blocks-mags/casino-score",
                })
            )
        )
    );
};

export { editContent }