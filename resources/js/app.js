import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import './bootstrap';
import '../css/app.css';
import { createPinia } from 'pinia';
import Aos from 'aos';
import 'aos/dist/aos.css';
import { useLoveStoryStore } from './Stores/loveStoryStore';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({render: () => h(App, props)})

        const pinia = createPinia()
        app.use(plugin).use(pinia)

        app.mount(el)
    }
})

Aos.init()