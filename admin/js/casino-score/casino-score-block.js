
/**
 * Custom block Casino Score. Shows ratings withs stars and overall score. Can have CTA btn.
 * 
 * @since     1.1.3
 */

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

import { editContent } from "./block-edit.js";

registerBlockType("blocks-mags/casino-score", {
	title: __("Casino Score - BMags", "blocks-mags"),
	icon: "superhero-alt",
	category: "common",
	supports: {
		align: ["center", "wide", "full"],
	},
	attributes: {
		starStyle: {
			type: "string",
			default: '3',
		},
		showCTA: {
			type: "boolean",
			default: true,
		},
		textCTA: {
			type: "string",
			default: "PLAY NOW",
		},
		styleCTA: {
			type: "string",
			default: "ds2",
		},
	},

	edit: editContent,

	save() {
		return null;
	},
});
