import Donasi from '../apis/Donasi'

const checkStatusTutupBuku = (next) => {
    Donasi.checkStatusTutupBuku()
        .then(response => {
            
            if(response.data.result) {
                return next({
                    path: '/transaksi/donasi/close'
                })
            }
            else {
                return next()
            }
        })
        .catch(error => {
            console.log(error)
        })
}

export {checkStatusTutupBuku}