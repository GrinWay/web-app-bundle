import { Controller } from '@hotwired/stimulus'
import { useTransition } from './stimulus-use/useTransition.js'

/**
 *
 */
class Transition extends Controller {

    #isUseTransitionInitialized = false
    #elementReadyToGetProcessed = true

    /**
     * Target getter
     */
    get _element() {
        return this.hasElementTarget ? this.elementTarget : this.element
    }

    connect() {
        // even when connect priority has element target
        this.elementTargetConnected(this._element)
    }

    elementTargetConnected(element) {
        if (this.#initUseTransition(element)) {
            this.#process(element)
        }
    }

    #initUseTransition(element) {
        if (true === this.#isUseTransitionInitialized) {
            return true
        }

        if (!element) {
            return false
        }

        useTransition(this, this.styleValue, {
            initShown: this.initShownValue,
            element,
            hiddenClass: this.hiddenClassValue,
        })

        this.#isUseTransitionInitialized = true

        return true
    }

    async #process(element) {
        if (true !== this.#elementReadyToGetProcessed) {
            return
        }
        this.#elementReadyToGetProcessed = false

        requestAnimationFrame(() => {
            if (false === this.initShownValue) {
                setTimeout(this.show.bind(this), 100)
            }

            if (true === this.willLeaveValue) {
                setTimeout(() => this.hide(element), this.disappearInMsValue)
            } else {
                // put to stack
                setTimeout(() => this.#elementReadyToGetProcessed = true, 0)
            }
        })
    }

    async hide(element) {
        await this.leave()
        if (element && true === this.removeAfterLeaveValue) {
            element?.remove()
        }
        this.#elementReadyToGetProcessed = true
    }

    show(event) {
        this.enter()
    }
}

Transition.values = {
    initShown: {
        type: Boolean,
        default: false,
    },
    willLeave: {
        type: Boolean,
        default: true,
    },
    removeAfterLeave: {
        type: Boolean,
        default: true,
    },
    style: {
        type: String,
        default: 'fade',
    },
    disappearInMs: {
        type: Number,
        default: 3000,
    },
    hiddenClass: {
        type: String,
        default: 'd-none',
    },
}

Transition.targets = [
    'element',
]

export { Transition as default }
