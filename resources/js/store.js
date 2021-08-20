import Vue from 'vue'
import Donasi from './apis/Donasi'

const store = Vue.observable({
    role: '',
    status_tutup_buku: false,
});

export const checkStatusTutupBuku = () => {
    Donasi.checkStatusTutupBuku().then(response => store.status_tutup_buku = response.data.result)
}

export const setRole = (role) => {
    this.role = role
}

export default store;