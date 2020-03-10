
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.jQuery = window.$ = require('jquery');
// global.jQuery = global.$ = require('jquery');
window._ = require('lodash')
window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (error.response.status === 401) {
        window.location.assign('/login')
    }

    return Promise.reject(error)
})



window.purify = o => JSON.parse(JSON.stringify(o))


let token = document.head.querySelector('meta[name="csrf-token"]')


if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}
//const APP_EXAM_URL = document.getElementById('exam_url').value
//console.log("appurl", APP_EXAM_URL)
let date_format = document.head.querySelector('meta[name="dp-date"]')
let time_format = document.head.querySelector('meta[name="dp-time"]')
let datetime_format = document.head.querySelector('meta[name="dp-datetime"]')
let app_locale = document.head.querySelector('meta[name="app-locale"]')

if (date_format && time_format && datetime_format) {
    window.date_format_moment = date_format.content
    window.time_format_moment = time_format.content
    window.datetime_format_moment = datetime_format.content
    window.app_locale = app_locale.content
} else {
    console.error('Moment.js date and time formats not found')
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

window.Vue = require('vue')
Vue.prototype.$eventHub = new Vue()
Vue.prototype.$APP_EXAM_URL = document.getElementById('exam_url').value
//Vue.prototype.$MAIN_APP_EXAM_URL = document.getElementById('main_app_url').value

import router from './routes'
import store from './store'

import VueAWN from 'vue-awesome-notifications'
import vSelect from 'vue-select'
import datePicker from 'vue-bootstrap-datetimepicker'
import VueSweetalert2 from 'vue-sweetalert2'
import ability from './config/ability'
import { abilitiesPlugin } from '@casl/vue'
import VueCkeditor from 'vue-ckeditor2'
import { vsCollapse, vsIcon } from 'vuesax'
import { ToggleButton } from 'vue-js-toggle-button'
import App from './App.vue'
import BootstrapVue from 'bootstrap-vue'
import VueYouTubeEmbed from 'vue-youtube-embed'
import VueTransmit from "vue-transmit"
// import LoadScript from 'vue-plugin-load-script';
// Vue.use(LoadScript);


Vue.use(VueAWN, { position: 'top-right', durations: { success: 20000 }, animationDuration: 500, icons: { enabled: false }, labels: { success: '<i class="fa fa-check custom-green-color mr-3"> </i> Success <i class="pull-right fa fa-times"></i>' } })
Vue.use(datePicker)
Vue.use(VueSweetalert2)
Vue.use(abilitiesPlugin, ability)
Vue.use(VueCkeditor)
Vue.use(BootstrapVue)
Vue.use(VueYouTubeEmbed)
Vue.use(VueTransmit)

Vue.component('App', require('./App.vue'));
Vue.component('back-buttton', require('./components/BackButton.vue'))
Vue.component('bootstrap-alert', require('./components/Alert.vue'))
Vue.component('bootstrap-error', require('./components/Errors.vue'))
Vue.component('event-hub', require('./components/EventHub.vue'))
Vue.component('bread-crumbs', require('./components/BreadCrumbs.vue'))
Vue.component('vue-button-spinner', require('./components/VueButtonSpinner.vue'))
Vue.component('v-select', vSelect)
Vue.component('vue-ckeditor', VueCkeditor)
Vue.component('ToggleButton', ToggleButton)
Vue.component('custom-collapse-body', require('./components/utils/CustomCollapseBody.vue'))
Vue.component('custom-collapse-heading', require('./components/utils/CustomCollapseHeading.vue'))
Vue.component('custom-data-table', require('./components/utils/CustomDataTable.vue'))
Vue.component('item-changes', require('./components/utils/ItemChanges.vue'))
Vue.component('data-table', require('./components/utils/DataTable.vue'))
Vue.component('back-to-index', require('./components/utils/BackToIndex.vue'))
moment.updateLocale(window.app_locale, {
    week: {
        dow: 1
    }
})


// TODO: the next line is added for debugging purposes and should be removed for production build
window.ability = ability

const app = new Vue({
    data: {
        relationships: {},
        dpconfigDate: {
            format: window.date_format_moment
        },
        dpconfigTime: {
            format: window.time_format_moment
        },
        dpconfigDatetime: {
            format: window.datetime_format_moment,
            sideBySide: true
        },
    },
    mounted() {
        if (this.$route.name !== 'login')
            this.updateRules()
    },
    watch: {
        '$route': function () {
            this.updateRules()
        }
    },
    methods: {
        updateRules() {
            console.log("checking in roles");
            store.dispatch('Rules/fetchData')
                .then(() => {
                    this.$eventHub.$emit('rules-update')
                })
        }
    },
    template: '<App/>',
    components: {
        App
    },
    router,
    store
}).$mount('#app')
