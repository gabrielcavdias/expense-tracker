import "./bootstrap";
// import { createApp } from "vue/dist/vue.esm-bundler";
// import { createPinia, PiniaVuePlugin } from "pinia";
// import Transactions from "./components/Transactions.vue";

// import App from "./App.vue";
// createApp({
//     components: {
//         "transactions-app": App,
//     },
// })
//     .use(createPinia())
//     .mount("#app");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
