import API from './API'
import Csrf from './Csrf'

export default {

    async getList(page) {
        await Csrf.getCookie()
        return API.get(`/transaksi/pengeluaran?page=${page}`)
    },

    async search(category, keyword) {
        await Csrf.getCookie()
        return API.get(`/transaksi/pengeluaran/search?c=${category}&q=${keyword}`)
    },

    async store(form) {
        await Csrf.getCookie()
        return API.post('/transaksi/pengeluaran', form)
    },

    async get(id) {
        await Csrf.getCookie()
        return API.get(`/transaksi/pengeluaran/${id}`)
    },

    async update(id, form) {
        await Csrf.getCookie()
        return API.patch(`/transaksi/pengeluaran/${id}`, form)
    },

    async delete(id) {
        await Csrf.getCookie()
        return API.delete(`/transaksi/pengeluaran/${id}`)
    },

    async getDailySpending(date, jenis_pengeluaran) {
        await Csrf.getCookie()
        return API.get(`/laporan/pengeluaran?tanggal=${date}&jenis_pengeluaran=${jenis_pengeluaran}`)
    },

    async getMonthlySpending(month) {
        await Csrf.getCookie()
        return API.get(`/laporan/pengeluaran?bulan=${month}`)
    },

    async getYearlySpending(year) {
        await Csrf.getCookie()
        return API.get(`/laporan/pengeluaran?tahun=${year}`)
    },

    async getMonthSpending(month) {
        await Csrf.getCookie()
        return API.get(`/pengeluaran/month/${month}`)
    },

    async countMonthSpending(month) {
        await Csrf.getCookie()
        return API.get(`/pengeluaran/count/month/${month}`)
    },

    async sumMonthSpending(month) {
        await Csrf.getCookie()
        return API.get(`/pengeluaran/sum/month/${month}`)
    },
}