<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 offset-md-6 mb-2">
            <div class="d-flex flex-row align-middle">
                <p>Tampilkan Laporan: </p>
                <select name="periode" id="selectCategory" class="form-control ml-2" v-model="periode" @change="showPengeluaran">
                    <option value="harian">Harian</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="d-flex flex-row align-middle">
                <p>Group by: </p>
                <select name="id_jenis_pengeluaran" id="selectJenisPengeluaran" class="form-control" required v-model="jenis_pengeluaran" @change="getPengeluaranList(tanggal)">
                    <option value="">Tampilkan semua</option>
                    <option v-for="jenis_pengeluaran in jenis_pengeluaran_list" :key="jenis_pengeluaran.id" :value="jenis_pengeluaran.nama">
                        {{ jenis_pengeluaran.nama }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}: <b>{{ dayjs(date).format('DD MMMM YYYY') }}</b></h3>
                        <a type="button" :href="`/api/laporan/pengeluaran/export?tanggal=${date}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pengeluaranTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No Kwitansi</th>
                                    <th>Penerima</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pengeluaran, index) in pengeluaran_list" :key="pengeluaran.id">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ pengeluaran.no_kwitansi }}</td>
                                    <td>{{ pengeluaran.nama_penerima }}</td>
                                    <td>{{ pengeluaran.nama_jenis_pengeluaran }}</td>
                                    <td>Rp {{ pengeluaran.nominal_rupiah }}</td>
                                    <td>{{ dayjs(pengeluaran.created_at).format('DD MMMM YYYY') }}</td>
                                    <td>{{ pengeluaran.keterangan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a type="button" :href="`/api/laporan/pengeluaran/export?tanggal=${date}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import helper from '../helper.js'
    import JenisPengeluaran from '../apis/JenisPengeluaran'
    import Pengeluaran from '../apis/Pengeluaran'

    export default {
        name: 'LaporanPengeluaranHarian',
        created() {
            this.tanggal = this.date
            this.getJenisPengeluaranList()
            this.getPengeluaranList()
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
                jenis_pengeluaran_list: {},
                jenis_pengeluaran: '',
                tanggal: '',
                pengeluaran_list: {},
                periode: 'harian',
                dayjs: this.$dayjs
            }
        },
        methods: {

            getJenisPengeluaranList() {
                JenisPengeluaran.getList()
                        .then(response => {
                            this.jenis_pengeluaran_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getPengeluaranList(date = this.date, jenis_pengeluaran = this.jenis_pengeluaran) {
                Pengeluaran.getDailySpending(date, jenis_pengeluaran)
                    .then(response => {
                        this.pengeluaran_list = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showPengeluaran() {
                this.$router.push(`/laporan/pengeluaran/${this.periode}`)
            }
        }
    }
</script>
