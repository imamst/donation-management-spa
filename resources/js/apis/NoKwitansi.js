import API from './API'
import Csrf from './Csrf'

export default {

    async get(jenis_transaksi) {
        await Csrf.getCookie()
        return API.get(`/receipt/${jenis_transaksi}`);
    },
}