import { render } from "@testing-library/vue";
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const vuetify = createVuetify({
    components,
    directives,
})

export default function (component: any, props: any) {
    return render(component, {
        props,
        global: {
            plugins: [vuetify]
        }
    });
}
