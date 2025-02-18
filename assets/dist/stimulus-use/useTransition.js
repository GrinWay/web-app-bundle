import { useTransition as stimulusUseTranslation } from 'stimulus-use';

/**
 * Usage:
 *
 * It works with the help of basic css classes, like: "fade", "slide", "flash", "rotate" described in:
 * "@grinway/web-app-bundle/dist/style/transition.css"
 *
 * Definitely if you add yours and use your style name it will work the same
 */
export function useTransition(
	controller,
	style,
	{
		initShown,
		hiddenClass,
		element,
	} = {}
) {
	initShown ??= true
	hiddenClass ??= 'd-none'
	element ??= controller.element

	return stimulusUseTranslation(controller, {
		element,
		hiddenClass,
		transitioned:     initShown,
		enterActive:     `${style}-enter-active`,
		enterFrom:       `${style}-enter-from`,
		enterTo:         `${style}-enter-to`,
		leaveActive:     `${style}-leave-active`,
		leaveFrom:       `${style}-leave-from`,
		leaveTo:         `${style}-leave-to`,
	})
}
