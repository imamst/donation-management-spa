import API from './API'
import Csrf from './Csrf'

export default {

    async getList() {
        await Csrf.getCookie()
        return API.get('/monitoring')
    },

}