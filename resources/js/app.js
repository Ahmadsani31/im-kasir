import './bootstrap';
import '../css/app.css';
import '@popperjs/core';
import '../../public/assets/js/pcoded.js';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import DataTablesLib from 'datatables.net'; 
import DataTable from 'datatables.net-vue3';
import $ from "jquery";
import VueSweetalert2 from 'vue-sweetalert2';

import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/css/index.css";

import VueHtmlToPaper from "vue-html-to-paper";

const options = {
  name: "_blank",
  specs: ["titlebar=yes", "scrollbars=yes"],
  styles: [
    "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
    "https://unpkg.com/kidlat-css/css/kidlat.css"
  ]
};

DataTable.use(DataTablesLib);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueHtmlToPaper, options)
            .component('loading', Loading)
            .component('DataTable', DataTable) 
            .component('Swal', VueSweetalert2) 
            .component('$', $) 
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
