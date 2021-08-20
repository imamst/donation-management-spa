<template>
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row" v-if="(role == 'Admin') || (role == 'Super Admin')">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Donasi Bulan {{ current_indonesian_month }}</span>
                <div>
                    <span class="info-box-number mb-2">{{ current_month_donasi_sum }}</span>
                    <span class="text-success">{{ current_month_donasi_count }} Donasi</span>
                </div>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-12 col-md-4">
            <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pengeluaran Bulan {{ current_indonesian_month }}</span>
                <div>
                    <span class="info-box-number mb-2">{{ current_month_pengeluaran_sum }}</span>
                    <span class="text-danger">{{ current_month_pengeluaran_count }} Pengeluaran</span>
                </div>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-12 col-md-4">
            <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Saldo Bulan {{ current_indonesian_month }}</span>
                <span class="info-box-number">{{ current_month_balance }}</span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: TODAY'S DONATION -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Donasi Hari Ini</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <tabel-donasi-harian :donasi_list="today_donasi_list"></tabel-donasi-harian>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix" v-if="!tutup_buku">
                <router-link to="/transaksi/donasi/create" class="btn btn-sm btn-info float-left">Input Donasi Baru</router-link>
                <button type="button" class="btn btn-sm btn-secondary float-right" @click="closeTodayTransaction">Tutup Buku</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
</template>

<script>
    import store from '../store'
    import helper from '../helper'
    import Donasi from '../apis/Donasi'
    import Pengeluaran from '../apis/Pengeluaran'
    import Neraca from '../apis/Neraca'
    import TabelDonasiHarian from '../components/tables/TabelDonasiHarian'

    export default {
        name: 'Dashboard',
        components: {
            TabelDonasiHarian
        },
        created() {
            if((store.role == 'Admin') || (store.role == 'Super Admin'))
            {
                this.countCurrentMonthDonation()
                this.sumCurrentMonthDonation()
                this.countCurrentMonthSpending()
                this.sumCurrentMonthSpending()
                this.getCurrentMonthBalance()
            }
            this.getTodayDonation()
            this.checkStatusTutupBuku()
        },
        mounted() {
            this.$parent.setTitle('')
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                role: store.role,
                tutup_buku: true,
                date_ymd: helper.getTodayDate(),
                current_month: new Date().getMonth() + 1,
                current_indonesian_month: helper.convertToIndonesianMonth(new Date().getMonth() + 1),
                today_donasi_list: {},
                current_month_donasi_count: 0,
                current_month_donasi_sum: '',
                current_month_pengeluaran_count: 0,
                current_month_pengeluaran_sum: '',
                current_month_balance: 0
            }
        },
        methods: {
            getTodayDonation(date = this.date_ymd, jenis_donasi = "") {
                Donasi.getDailyDonation(date, jenis_donasi)
                        .then(response => {
                            this.today_donasi_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            countCurrentMonthDonation() {
                Donasi.countMonthDonation(this.current_month)
                        .then(response => {
                            this.current_month_donasi_count = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            sumCurrentMonthDonation() {
                Donasi.sumMonthDonation(this.current_month)
                        .then(response => {
                            this.current_month_donasi_sum = helper.formatRupiah(response.data)
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            countCurrentMonthSpending() {
                Pengeluaran.countMonthSpending(this.current_month)
                        .then(response => {
                            this.current_month_pengeluaran_count = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            sumCurrentMonthSpending() {
                Pengeluaran.sumMonthSpending(this.current_month)
                        .then(response => {
                            this.current_month_pengeluaran_sum = helper.formatRupiah(response.data)
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getCurrentMonthBalance() {
                Neraca.getCurrentMonthBalance()
                        .then(response => {
                            this.current_month_balance = helper.formatRupiah(response.data)
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            checkStatusTutupBuku() {
                Donasi.checkStatusTutupBuku()
                        .then(response => this.tutup_buku = response.data.result)
            },

            closeTodayTransaction() {
                this.$swal.fire({
                        title: 'Tutup transaksi hari ini?',
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#28A745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {

                        if (result.isConfirmed) {

                            this.$Progress.start()
                            Donasi.tutupBuku()
                                .then(() => {
                                    store.status_tutup_buku = true
                                    this.$router.push({path: '/transaksi/donasi/close'})
                                })
                                .catch(error => {
                                    console.log(error)
                                })             
                        }
                    })
            }
        }
    }
</script>
