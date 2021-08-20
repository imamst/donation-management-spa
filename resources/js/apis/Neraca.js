import API from './API'
import Csrf from './Csrf'

export default {

    async getCurrentMonthBalance() {
        await Csrf.getCookie()
        return API.get(`/cash/balance/current-month`)
    },

    async getMonthlyNeraca(month) {
        await Csrf.getCookie()
        return API.get(`/laporan/neraca?bulan=${month}`)
    },

    async getYearlyNeraca(year) {
        await Csrf.getCookie()
        return API.get(`/laporan/neraca?tahun=${year}`)
    }
}