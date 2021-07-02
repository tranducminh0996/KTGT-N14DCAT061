import Vue from 'vue';
import ElementUI from 'element-ui';
import store from './store';
import 'viewerjs/dist/viewer.css';
import Viewer from 'v-viewer';
import './assets/element/element-ui.css';
import i18n from './lang';
import Cookies from 'js-cookie';

Vue.use(ElementUI, {
    size: Cookies.get('size') || 'medium', // set element-ui default size
    i18n: (key, value) => i18n.t(key, value),
});

Vue.use(Viewer, {
    defaultOptions: {
        zIndex: 9999999,
    },
});
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => {
    Vue.component(key.split('/').pop().split('.')[0], files(key).default);
});
Vue.config.devtools = true;
new Vue({
    el: '#app',
    store,
    i18n
});
