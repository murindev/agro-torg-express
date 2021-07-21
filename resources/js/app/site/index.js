// require('../../bootstrap');
window.Vue = require('vue');
import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);
Vue.component('mainslider', require('../../components/front/slider').default);
Vue.component('CatalogBoardSlider', require('../../components/front/CatalogBoardSlider').default);

const index = new Vue({
    el: '#app',
});
