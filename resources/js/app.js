import _ from 'lodash'
import Vue from 'vue'
import VueRouter from 'vue-router'
import Swal from 'sweetalert2'
import VueProgressBar from 'vue-progressbar'
import dayjs from 'dayjs'
import UpdateLocale from 'dayjs/plugin/updateLocale'
import 'dayjs/locale/id'
import router from './router'
import './filter'

dayjs.extend(UpdateLocale)
dayjs.locale('id')
dayjs.updateLocale('id', {
    months: [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ]
})

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

Object.defineProperty(Vue.prototype, '$swal', { value: Swal })
Object.defineProperty(Vue.prototype, '$toast', { value: Toast })
Vue.prototype.$dayjs = dayjs

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})

Vue.router = router
Vue.use(VueRouter)
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
    router
})