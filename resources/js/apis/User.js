import API from './API'
import Csrf from './Csrf'

export default {
    async login(form) {
        await Csrf.getCookie()

        return API.post('/login', form)
    },

    async logout() {
        await Csrf.getCookie()

        return API.post('/logout')
    },

    auth() {
        return API.get('/user')
    },

    async updatePassword(form) {
        await Csrf.getCookie()

        return API.patch('/account/password', form)
    },
    async cron() {
        return API.get('/cron/refresh/mv')
    }
}