const onEnterViewSelector = '[data-on-enter-view]'

export function onEnterViewSetup() {
	document.addEventListener('DOMContentLoaded', function () {
		// Create the observer
		const observer = new IntersectionObserver(observerCallback, {
			root: null,
			threshold: 0.5,
			rootMargin: '0px',
		})

		// Create the callback to be used
		function observerCallback(entries) {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					const target = entry.target

					target.dataset.entered = 'true'

					observer.unobserve(target)
				}
			})
		}

		// Add the observer to each element
		document.querySelectorAll(onEnterViewSelector).forEach((element) => {
			observer.observe(element)
		})
	})
}
