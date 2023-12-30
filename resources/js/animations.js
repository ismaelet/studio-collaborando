const enterAnimationSelector = '[data-enter-animation]'

/**
 * Enter animation
 */
export function enterAnimationSetup() {
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll(enterAnimationSelector).forEach((element) => {
			// Extract modifiers from the data attribute
			const modifiers = {}
			const rawModifiers = element.dataset.enterAnimation.split(',')

			rawModifiers.forEach((pair) => {
				const [key, value] = pair.split(':')

				modifiers[key.trim()] = value.trim()
			})

			// Setup the animation
			element.dataset.enterAnimation = ''
			element.dataset.entered = 'false'

			// Setup the animation type
			switch (true) {
				default:
					element.dataset.enterAnimationType = 'fade-in'
					break
			}

			// Setup the animation direction
			switch (modifiers.direction) {
				case 'top':
					element.dataset.enterAnimationDirection = 'top'
					break
				case 'bottom':
					element.dataset.enterAnimationDirection = 'bottom'
					break
				case 'left':
					element.dataset.enterAnimationDirection = 'left'
					break
				case 'right':
					element.dataset.enterAnimationDirection = 'right'
					break
			}

			// animation delay, speed and intensity
			// 	const speed = settings ? settings[1] : null
			// 	const intensity = settings ? settings[2] : null
			if (modifiers.delay) {
				element.style.setProperty('--_enter-animation-delay', `${modifiers.delay}ms`)
			}

			// 	if (speed) {
			// 		element.style.setProperty('--_enter-animation-speed', `${speed}ms`)
			// 	}

			// 	if (intensity) {
			// 		element.style.setProperty('--_enter-animation-intensity', `${intensity}rem`)
			// 	}
		})
	})
}

/**
 * Exit animation
 */
// export function exitAnimationSetup() {
// 	const modifiers = binding.modifiers

// 	element.dataset.exited = 'false'
// 	element.classList.add('exit-animation')

// 	// animation type
// 	switch (true) {
// 		case modifiers.fadeOut:
// 			element.dataset.exitAnimationType = 'fade-out'
// 			break
// 	}

// 	// animation direction
// 	switch (true) {
// 		case modifiers.top:
// 			element.dataset.exitAnimationDirection = 'top'
// 			break
// 		case modifiers.bottom:
// 			element.dataset.exitAnimationDirection = 'bottom'
// 			break
// 		case modifiers.left:
// 			element.dataset.exitAnimationDirection = 'left'
// 			break
// 		case modifiers.right:
// 			element.dataset.exitAnimationDirection = 'right'
// 			break
// 	}

// 	// animation delay, speed and intensity
// 	if (binding.value) {
// 		const settings = ('' + binding.value).indexOf(',') ? ('' + binding.value).split(',') : null
// 		const delay = settings ? settings[0] : binding.value
// 		const speed = settings ? settings[1] : null
// 		const intensity = settings ? settings[2] : null

// 		if (delay) {
// 			element.style.setProperty('--exit-animation-delay', `${delay}ms`)
// 		}

// 		if (speed) {
// 			element.style.setProperty('--exit-animation-speed', `${speed}ms`)
// 		}

// 		if (intensity) {
// 			element.style.setProperty('--exit-animation-intensity', `${intensity}rem`)
// 		}
// 	}
// }
