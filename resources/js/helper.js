export default {

    convertToIndonesianMonth(numeric_month) {
        let indonesian_month = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ]

        let month = indonesian_month[numeric_month - 1]

        return month
    },

    getTodayDate() {
        const today = new Date()

        const day = today.getDate()
        const month = today.getMonth() + 1
        const year = today.getFullYear()

        return `${year}-${month}-${day}`
    },

    getCurrentIndonesianDate(date = new Date()) {
        const day = date.getDate()
        const month = this.convertToIndonesianMonth(date.getMonth() + 1)
        const year = date.getFullYear()

        return `${day} ${month} ${year}`
    },

    formatRupiah(angka) {
        angka = angka == null ? '0' : angka.toString()
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            let separator = sisa ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return `Rp ${rupiah}`;
    }

}