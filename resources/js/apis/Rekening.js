import API from './API'
import Csrf from './Csrf'

export default {

    async getList() {
        await Csrf.getCookie()
        return API.get('/rekening')
    },

    async get(id) {
        await Csrf.getCookie()
        return API.get(`/rekening/${id}`);
    },

    async store(form) {
        await Csrf.getCookie()
        return API.post('/rekening', form)
    },

    async update(id, form) {
        await Csrf.getCookie()
        return API.patch(`/rekening/${id}`, form)
    },

    async delete(id) {
        await Csrf.getCookie()
        return API.delete(`/rekening/${id}`)
    }
}