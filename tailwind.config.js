/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}"],
  theme: {
    extend: {
      padding: {
        'button': '0.5rem 1.5rem'
      }
    },
    fontFamily: {
      'glacial' : ['Glacial Indifference', 'sans-serif']
    },
    colors: {
      'primary-black': '#1A1C22',
      'accent' : '#580ef6',
      'accent-light': '#6751f0',
      'white': '#ffffff',
      'transparent': 'transparent',
      'black': '#000000',
      'off-white': '#FEFEFE',
      'light-gray': '#ededed',
      'red': '#db7272',
      'green': '#39a355',
      'hover-gray': '#7d7d7d',

    },
    strokeWidth: {
      '08': '0.8px'
    },
    letterSpacing: {
      wider: '0.1em',
      widest: '0.35em'
    }
  },
  plugins: [],
}

