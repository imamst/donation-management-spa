import API from './API'
import Csrf from './Csrf'

export default {

    async getList() {
        await Csrf.getCookie()
        return API.get('/master/jenis-donasi')
    },

    async get(id) {
        await Csrf.getCookie()
        return API.get(`/master/jenis-donasi/${id}`);
    },

    async store(form) {
        await Csrf.getCookie()
        return API.post('/master/jenis-donasi', form)
    },

    async update(id, form) {
        await Csrf.getCookie()
        return API.patch(`/master/jenis-donasi/${id}`, form)
    },

    async delete(id) {
        await Csrf.getCookie()
        return API.delete(`/master/jenis-donasi/${id}`)
    }
}