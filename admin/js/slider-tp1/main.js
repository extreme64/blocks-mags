/**
 * Main file for the "Slider Tp1" custom block.
 * Here we regester the block from .js side 
 * 
 * Part of modules: /
 * 
 * Copyright - Proprietary
*/

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

import { editContent } from "./block-edit.js";
import { saveContent } from "./block-save.js"; 


registerBlockType( "blocks-mags/class-slider-tp1", {
	title: __("Slider TP1 - BMags", "blocks-mags"),
	icon: "slides",
	category: "common",
	supports: {
		align: ["center", "wide", "full"],
	},
	attributes: {
		align: {
			type: "string",
			default: "center",
		},
		termId: {
			type: "number",
			default: 0,
		},
		numSlides: {
			type: "number",
			default: 3,
		},
		sliderBackgroundColor: {
			type: "string",
			default: "#faeef2",
		},
	},

	edit: editContent,
	save: saveContent

});

