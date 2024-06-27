import { defineVitestConfig } from '@nuxt/test-utils/config'
import vue from "@vitejs/plugin-vue";
export default defineVitestConfig({
    test: {
        environment: 'nuxt',
        globals: true,
        server: {
            deps: {
                inline: ['vuetify']
            },
        }
    }
})
