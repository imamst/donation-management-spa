import API from './API'
import Csrf from './Csrf'

export default {

    async getList() {
        await Csrf.getCookie()
        return API.get('/master/jenis-pengeluaran')
    },

    async get(id) {
        await Csrf.getCookie()
        return API.get(`/master/jenis-pengeluaran/${id}`);
    },

    async store(form) {
        await Csrf.getCookie()
        return API.post('/master/jenis-pengeluaran', form)
    },

    async update(id, form) {
        await Csrf.getCookie()
        return API.patch(`/master/jenis-pengeluaran/${id}`, form)
    },

    async delete(id) {
        await Csrf.getCookie()
        return API.delete(`/master/jenis-pengeluaran/${id}`)
    }
}