/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",],
	theme: {
		fontFamily: {
			'sans': ['Open Sans', 'Arial', 'sans-serif'],
			'titles': ['Poppins', 'Arial', 'sans-serif'],
			'serif': ['Libre Caslon Display', 'Georgia', 'Cambria', 'Times New Roman', 'serif'],
		},
		colors: {
			'primary': 'hsl(var(--color-primary-400-hsl) / <alpha-value>)',
			'primary-400': 'hsl(var(--color-primary-400-hsl) / <alpha-value>)',

			'background': 'hsl(var(--color-background-400-hsl) / <alpha-value>)',
			'background-400': 'hsl(var(--color-background-400-hsl) / <alpha-value>)',

			'text': 'var(--color-text-400)',
			'text-400': 'var(--color-text-400)',
			'text-700': 'var(--color-text-700)',
		},
		extend: {},
	},
	plugins: [],
}

