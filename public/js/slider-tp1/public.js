/**
 * Public custom block - Slider Tp1
 * 
 * @since 1.0.1
 */

const eventCallback = (eb) => {
	let clickedElement = eb.target;
	

	/* Choose only slides from the slider that
	 * this clicked button is from */
	const sliderInFocus = clickedElement.closest(".slider-tp1");

	let sliderInFocusSlides = sliderInFocus.querySelectorAll(".slide");
	let sliderInFocusButtons = sliderInFocus.querySelectorAll(
		".slider-buttons > .button"
	);

	let selectedButtonId = clickedElement.getAttribute("data-ui-slide-id");
	let selectedSlide = sliderInFocus.querySelector(
		`.slider-tp1 .slide-${selectedButtonId}`
	);

	let activeSlide, activeSlideId;
	activeSlide = sliderInFocus.querySelector(".button.active");
	activeSlideId = activeSlide.dataset.uiSlideId;


	if( ! clickedElement.classList.contains('active')) {
		
		
		removeClasses(sliderInFocusSlides, [
			"animate-fadeFromLeft",
			"animate-fadeFromRight",
			"active",
		]);
		removeClasses(sliderInFocusButtons, ["active"]);
		clickedElement.classList.add("active");
		
		/* 	Choose animation based of what slide is selected,
		*	slide on the left ( previous ) or right one ( next ) */
		if (selectedButtonId < activeSlideId) {
			selectedSlide.classList.add("animate-fadeFromLeft", "active");
		} else {
			selectedSlide.classList.add("animate-fadeFromRight", "active");
		}
	}
}

document.addEventListener("DOMContentLoaded", () => {
	let allSliderButtons = document.querySelectorAll(
		".slider-tp1 .slider-buttons > .button"
	);

	allSliderButtons.forEach((elButton, i) => {
		elButton.addEventListener("click", eventCallback.bind(elButton), false);
		elButton.addEventListener("focus", eventCallback.bind(elButton), false);
	});
});

const removeClasses = (elements, classes) => {
	elements.forEach((el, i) => el.classList.remove(...classes));
};
