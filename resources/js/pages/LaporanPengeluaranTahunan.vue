<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-md-8 mb-2">
            <div class="d-flex flex-row align-middle">
                <p>Tampilkan Laporan: </p>
                <select name="periode" id="selectCategory" class="form-control ml-2" v-model="periode" @change="showPengeluaran">
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
                        <h3 class="card-title">{{ title }}: <b>{{ year }}</b></h3>
                        <a type="button" :href="`/api/laporan/pengeluaran/export?tahun=${year}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pengeluaranTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Bulan</th>
                                    <th>Jumlah Pengeluaran</th>
                                    <th>Nominal Pengeluaran</th>
                                    <th>Jenis Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pengeluaran, index) in pengeluaran_list" :key="pengeluaran.id">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <button type="button" class="btn btn-link text-primary" @click.prevent="showPengeluaranBulanan(pengeluaran.bulan)">{{ parseInt(pengeluaran.bulan) | indonesianMonth }}</button>
                                    </td>
                                    <td>{{ pengeluaran.jumlah_pengeluaran }}</td>
                                    <td>{{ pengeluaran.total_uang_keluar | formatRupiah }}</td>
                                    <td>{{ pengeluaran.jenis_pengeluaran }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a type="button" :href="`/api/laporan/pengeluaran/export?tahun=${year}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import Pengeluaran from '../apis/Pengeluaran'

    export default {
        name: 'LaporanPengeluaranTahunan',
        created() {
            this.getPengeluaranList();
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        props: {
            year: {
                type: Number,
                default: new Date().getFullYear()
            }
        },
        data() {
            return {
                title: window.document.title,
                pengeluaran_list: {},
                periode: 'tahunan'
            }
        },
        methods: {

            getPengeluaranList(tahun = this.year) {
                Pengeluaran.getYearlySpending(tahun)
                    .then(response => {
                        this.pengeluaran_list = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showPengeluaranBulanan(month) {
                this.$router.push(`/laporan/pengeluaran/bulanan/${month}`)
            },

            showPengeluaran() {
                this.$router.push(`/laporan/pengeluaran/${this.periode}`)
            }
        }
    }
</script>
