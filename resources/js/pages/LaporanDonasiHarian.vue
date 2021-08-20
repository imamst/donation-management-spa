<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 offset-md-6 mb-2">
            <div class="d-flex flex-row align-middle">
                <p>Tampilkan Laporan: </p>
                <select name="periode" id="selectCategory" class="form-control ml-2" v-model="periode" @change="showDonasi">
                    <option value="harian">Harian</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                </select>
            </div>
        </div>
         <div class="col-md-3 mb-2">
            <div class="d-flex flex-row align-middle">
                <p>Group by: </p>
                <select name="id_jenis_donasi" id="selectJenisDonasi" class="form-control" required v-model="jenis_donasi" @change="getDonasiList(tanggal)">
                    <option value="">Tampilkan semua</option>
                    <option v-for="jenis_donasi in jenis_donasi_list" :key="jenis_donasi.id" :value="jenis_donasi.nama">
                        {{ jenis_donasi.nama }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}: <b>{{ dayjs(date).format('DD MMMM YYYY') }}</b></h3>
                        <a type="button" :href="`/api/laporan/donasi/export?tanggal=${date}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <tabel-donasi-harian :mode_laporan="true" :donasi_list="donasi_list"></tabel-donasi-harian>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a type="button" :href="`/api/laporan/donasi/export?tanggal=${date}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import JenisDonasi from '../apis/JenisDonasi'
    import Donasi from '../apis/Donasi'
    import TabelDonasiHarian from '../components/tables/TabelDonasiHarian'
    import helper from '../helper.js'

    export default {
        name: 'Donasi',
        components: {
            TabelDonasiHarian
        },
        created() {
            this.tanggal = this.date
            this.getJenisDonasiList()
            this.getDonasiList()
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        props: {
            date: {
                type: String,
                default: helper.getTodayDate()
            }
        },
        data() {
            return {
                title: window.document.title,
                jenis_donasi_list: {},
                jenis_donasi: '',
                tanggal: '',
                donasi_list: {},
                periode: 'harian',
                dayjs: this.$dayjs
            }
        },
        methods: {
            getJenisDonasiList() {
                JenisDonasi.getList()
                        .then(response => {
                            this.jenis_donasi_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getDonasiList(date = this.date, jenis_donasi = this.jenis_donasi) {
                Donasi.getDailyDonation(date, jenis_donasi)
                        .then(response => {
                            this.donasi_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            showDonasi() {
                this.$router.push(`/laporan/donasi/${this.periode}`)
            }
        }
    }
</script>
