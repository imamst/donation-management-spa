import API from './API'
import Csrf from './Csrf'

export default {

    async get(id) {
        await Csrf.getCookie()
        return API.get(`/donatur/${id}`)
    },

    async getList() {
        await Csrf.getCookie()
        return API.get(`/donatur`)
    },

    async getListPaginate(page) {
        await Csrf.getCookie()
        return API.get(`/donatur/paginate?page=${page}`)
    },

    async search(keyword) {
        await Csrf.getCookie()
        return API.get(`/donatur/search?q=${keyword}`)
    },

    async store(form) {
        await Csrf.getCookie()
        return API.post('/donatur', form)
    },

    async update(id, form) {
        await Csrf.getCookie()
        return API.patch(`/donatur/${id}`, form)
    },

    async delete(id) {
        await Csrf.getCookie()
        return API.delete(`/donatur/${id}`)
    }
}