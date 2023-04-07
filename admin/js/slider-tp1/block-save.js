/**
 * Module for saving slider block content, 
 * 
 * Main method: export { saveContent }
 * 
 * Part of modules: main.js
 * 
 * Copyright - Proprietary
*/


 const { __ } = wp.i18n;
 const { InnerBlocks } = wp.blockEditor;


/**
 * Block save 
 * 
 * @param {*} props Props. passed on save 
 * @returns 
 */
const saveContent = ( props ) => {

    const { attributes } = props;

    return InnerBlocks.Content && React.createElement(
        "section",
        {
            className: "slider-tp1",
            "style": `background-color: ${attributes.sliderBackgroundColor}`
        },
        React.createElement(
            "div",
            { className: "slider--inner-wrap" },
            React.createElement(InnerBlocks.Content, null)
        ),
        React.createElement(
            "nav",
            { class: "slider-buttons" },
            sliderNavigation(attributes.numSlides)
        )
    );
}


/**
 * Form slider navigation UI
 * 
 * @param {*} numOfSlides  Number of slides, for this slider block
 * @returns 
 */
 const sliderNavigation = (numOfSlides) => {
	let navigation = [];
	for (let i = 0; i < numOfSlides; i++) {
        let isActiveString = ''
        
        isActiveString = (i == 0) ? " active" : ""
		navigation.push(
			React.createElement(
				"button",
				{
					class: "button slider-buttons--" + (i + 1) + isActiveString + " generic-button btn--light",
					"data-ui-slide-id": (i + 1),
                    title: __(`Select slide: ${i+1}`, "pza-gutenberg")
				},
				""
			)
		);
	}
	return navigation;

};

export { saveContent } 