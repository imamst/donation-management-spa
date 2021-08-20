import API from './API'
import Csrf from './Csrf'

export default {

    async getList(page) {
        await Csrf.getCookie()
        return API.get(`/transaksi/donasi?page=${page}`)
    },

    async search(category, keyword) {
        await Csrf.getCookie()
        return API.get(`/transaksi/donasi/search?c=${category}&q=${keyword}`)
    },

    async store(form) {
        await Csrf.getCookie()
        return API.post('/transaksi/donasi', form)
    },

    async get(id) {
        await Csrf.getCookie()
        return API.get(`/transaksi/donasi/${id}`)
    },

    async update(id, form) {
        await Csrf.getCookie()
        return API.patch(`/transaksi/donasi/${id}`, form)
    },

    async delete(id) {
        await Csrf.getCookie()
        return API.delete(`/transaksi/donasi/${id}`)
    },

    async getDailyDonation(tanggal, jenis_donasi) {
        await Csrf.getCookie()
        return API.get(`/laporan/donasi?tanggal=${tanggal}&jenis_donasi=${jenis_donasi}`)
    },

    async getMonthlyDonation(month) {
        await Csrf.getCookie()
        return API.get(`/laporan/donasi?bulan=${month}`)
    },

    async getYearlyDonation(year) {
        await Csrf.getCookie()
        return API.get(`/laporan/donasi?tahun=${year}`)
    },

    async countMonthDonation(month) {
        await Csrf.getCookie()
        return API.get(`/donasi/count/month/${month}`)
    },

    async sumMonthDonation(month) {
        await Csrf.getCookie()
        return API.get(`/donasi/sum/month/${month}`)
    },

    async checkStatusTutupBuku() {
        await Csrf.getCookie()
        return API.get(`/transaksi/donasi/status`)
    },

    async tutupBuku() {
        await Csrf.getCookie()
        return API.get(`/transaksi/donasi/close`)
    },

    async exportExcelToday() {
        await Csrf.getCookie()
        return API.get(`/donasi/export/today`)
    }
}