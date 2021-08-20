import API from './API'
import Csrf from './Csrf'

export default {

    async getList() {
        await Csrf.getCookie()
        return API.get('/amil')
    },

    async store(form) {
        await Csrf.getCookie()
        return API.post('/amil', form)
    },

    async delete(id) {
        await Csrf.getCookie()
        return API.delete(`/amil/${id}`)
    },

    async updateStatus(id, status) {
        await Csrf.getCookie()
        
        if(status) {
            return API.patch(`/amil/${id}/unblock`)
        }
        return API.patch(`/amil/${id}/block`)
    }
}