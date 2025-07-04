// tailwind.config.js
export default {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
    theme: {
      extend: {
        animation: {
            'spin-slow': 'spin 4s linear infinite',
        },
        fontFamily: {
          main: ['"Great Vibes"', 'cursive'],
          general: ['Lora', 'serif'],
        }
      },
    },
    plugins: [],
  }
  