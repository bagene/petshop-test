// import this after install `@mdi/font` package
import '@mdi/font/css/materialdesignicons.css'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'

export default defineNuxtPlugin((app) => {
    const vuetify = createVuetify({
        theme: {
            defaultTheme: 'petshop',
            themes: {
                petshop: {
                    dark: false,
                    colors: {
                        primary: '#4EC690',
                        secondary: '#b0bec5',
                        accent: '#8c9eff',
                        error: '#b71c1c',
                        black: '#000000',
                    }
                }
            },
        }
    })
    app.vueApp.use(vuetify)
})
