module.exports = {
    theme: {
        boxShadow: {
            sm: ' 0 1px 4px 0 rgba(0, 0, 0, 0.16)',
            default: ' 0 3px 42px 0 rgba(114, 114, 114, 0.42)',
            md: ' 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06)',
            lg: ' 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05)',
            xl: ' 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04)',
            '2xl': '0 25px 50px -12px rgba(0, 0, 0, .25)',
            '3xl': '0 35px 60px -15px rgba(0, 0, 0, .3)',
            'inner': 'inset 0 2px 4px 0 rgba(0,0,0,0.06)',
            'outline': '0 0 0 3px rgba(66,153,225,0.5)',
            'focus': '0 0 0 3px rgba(66,153,225,0.5)',
            'none': 'none'
        },
        borderRadius: {
            'none': '0',
            'sm': '.125rem',
            default: '8px',
            'lg': '.5rem',
            'full': '9999px',
            'large': '12px',
        },
        extend: {
            colors: {
                red: {
                    '100': '#FEEEED',
                    '500': '#f04238',
                    '700': '#820400',
                },
                gray: {
                    '100': '#fafbfc',
                    '200': '#f2f2f2',
                    '300': '#d9d9d9',
                    '500': '#9A9A9A',
                    '600': '#636363',
                    '700': '#818181',
                    '900': '#353535',
                },
                blue: {
                    '100': '#e3f0ff',
                    '700': '#0e5ab0'
                },
                green: {
                    '600': '#4aab50',
                },
                default: 'var(--text-default-color)',
                accent: 'var(--text-accent-color)',
                secondary: 'var(--text-secondary-color)',
                'accent-light': 'var(--text-accent-light-color)',
                'accent-lighter': 'var(--text-accent-lighter-color)',
                muted: 'var(--text-muted-color)',
                'muted-light': 'var(--text-muted-light-color)',
                'error': 'var(--text-error-color)'

            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            }
        }
    },
    variants: {},
    plugins: []
}
