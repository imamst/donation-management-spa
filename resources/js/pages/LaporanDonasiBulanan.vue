<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-md-8 mb-2">
            <div class="d-flex flex-row align-middle">
                <p>Tampilkan Laporan: </p>
                <select name="periode" id="selectCategory" class="form-control ml-2" v-model="periode" @change="showDonasi">
                    <option value="harian">Harian</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}: <b>{{ parseInt(month) | indonesianMonth }} {{ year }}</b></h3>
                        <a type="button" :href="`/api/laporan/donasi/export?bulan=${month}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="donasiTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Donasi</th>
                                    <th>Nominal Donasi</th>
                                    <th>Jenis Donasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(donasi, index) in donasi_list" :key="donasi.id">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <button type="button" class="btn btn-link text-primary" @click.prevent="showDonasiHarian(donasi.tanggal_batch)">{{ dayjs(donasi.tanggal_batch).format('DD MMMM YYYY') }}</button>
                                    </td>
                                    <td>{{ donasi.jumlah_donasi }}</td>
                                    <td>{{ donasi.total_uang_masuk | formatRupiah}}</td>
                                    <td>{{ donasi.jenis_donasi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a type="button" :href="`/api/laporan/donasi/export?bulan=${month}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import Donasi from '../apis/Donasi'

    export default {
        name: 'LaporanDonasiBulanan',
        created() {
            this.getMonthlyDonasiList(this.month)
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        props: {
            month: {
                type: String,
                default: ((new Date().getMonth()) + 1).toString()
            }
        },
        data() {
            return {
                title: window.document.title,
                donasi_list: {},
                periode: 'bulanan',
                year: new Date().getFullYear(),
                dayjs: this.$dayjs
            }
        },
        methods: {
            getMonthlyDonasiList(bulan = this.month) {
                Donasi.getMonthlyDonation(bulan)
                    .then(response => {
                        this.donasi_list = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showDonasiHarian(tanggal) {
                this.$router.push(`/laporan/donasi/harian/${tanggal}`)
            },

            showDonasi() {
                this.$router.push(`/laporan/donasi/${this.periode}`)
            }
        }
    }
</script>
