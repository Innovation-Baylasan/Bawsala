module.exports = {
    theme: {
        boxShadow: {
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
                    '100':'#FEEEED',
                    '500':'#f04238',
                },
                gray:{
                    '100':'#F0F0F0',
                    '500':'#9A9A9A',
                }
            }
        }
    },
    variants: {},
    plugins: []
}
