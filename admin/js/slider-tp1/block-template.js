/**
 * Module for creating an individual slide with a template, 
 * also governs array that has all slides, Each slide is made 
 * with consuming of aforementioned template.
 * 
 * Main method: slidesTemplate()
 * 
 * Part of modules: block-edit.js
 * 
 * Copyright - Proprietary
*/

const { __ } = wp.i18n;

/**
 * Template for the inital slide layout
 */
 const slideColumnsTemplate2 =  [ 'core/columns',
    { 
        columns: null
    }
];

/**
 * Forms slider elements ( slides ) 
 * 
 * @param number Number of slides 
 * @returns array - All slides
 */
const slidesTemplate = (numOfSlides, children) => {
    let slides = [];
    for (let i = 0; i < numOfSlides; i++) {
        slides.push(slideColumnsTemplate2);
    }
    return slides;
};

export { slidesTemplate }