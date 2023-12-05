/** @type {import('tailwindcss').Config} */
export default {
	content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
	theme: {
		fontFamily: {
			sans: ['Open Sans', 'Arial', 'sans-serif'],
			heading: ['Poppins', 'Arial', 'sans-serif'],
			serif: ['Libre Caslon Display', 'Georgia', 'Cambria', 'Times New Roman', 'serif'],
		},
		colors: {
			primary: 'hsl(var(--color-primary-400-hsl) / <alpha-value>)',
			'primary-200': 'hsl(var(--color-primary-200-hsl) / <alpha-value>)',
			'primary-300': 'hsl(var(--color-primary-300-hsl) / <alpha-value>)',
			'primary-400': 'hsl(var(--color-primary-400-hsl) / <alpha-value>)',
			'primary-500': 'hsl(var(--color-primary-500-hsl) / <alpha-value>)',
			'primary-700': 'hsl(var(--color-primary-700-hsl) / <alpha-value>)',

			secondary: 'hsl(var(--color-secondary-400-hsl) / <alpha-value>)',
			'secondary-400': 'hsl(var(--color-secondary-400-hsl) / <alpha-value>)',

			'neutral-200': 'hsl(var(--color-neutral-200-hsl) / <alpha-value>)',
			'neutral-400': 'hsl(var(--color-neutral-400-hsl) / <alpha-value>)',
			'neutral-700': 'hsl(var(--color-neutral-700-hsl) / <alpha-value>)',

			background: 'hsl(var(--color-background-400-hsl) / <alpha-value>)',
			'background-400': 'hsl(var(--color-background-400-hsl) / <alpha-value>)',

			'surface-100': 'hsl(var(--color-surface-100-hsl) / <alpha-value>)',
		},
		borderRadius: {
			none: '0',
			sm: '0.5rem',
			DEFAULT: '1rem',
			lg: '2rem',
			full: '9999px',
		},
		extend: {
			borderWidth: {
				DEFAULT: 'var(--border-width)',
			},
			height: {
				'screen-min': '100svh',
			},
			fontSize: {
				title: [
					'min(4rem,13vw)',
					{
						lineHeight: 1,
						letterSpacing: '0.3',
						fontWeight: '400',
					},
				],
				subtitle: [
					'min(1.25rem,5.5vw)',
					{
						// lineHeight: 1,
						// letterSpacing: '0.3',
						// fontWeight: '400',
					},
				],
			},
		},
	},
	plugins: [],
}
