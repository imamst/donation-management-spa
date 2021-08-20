<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-md-8 mb-2">
            <div class="d-flex flex-row align-middle">
                <p>Tampilkan Laporan: </p>
                <select name="periode" id="selectCategory" class="form-control ml-2" v-model="periode" @change="showNeraca">
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
                        <a type="button" :href="`/api/laporan/neraca/export?tahun=${year}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
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
                                    <th>Nominal Donasi</th>
                                    <th>Nominal Pengeluaran</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(neraca, index) in neraca_list" :key="neraca.id">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <button type="button" class="btn btn-link text-primary" @click.prevent="showNeracaBulanan(neraca.bulan)">{{ parseInt(neraca.bulan) | indonesianMonth }}</button>
                                    </td>
                                    <td>{{ neraca.total_uang_masuk | formatRupiah }}</td>
                                    <td>{{ neraca.total_uang_keluar | formatRupiah }}</td>
                                    <td>{{ (parseInt(neraca.total_uang_masuk) - (parseInt(neraca.total_uang_keluar) || 0)) | formatRupiah }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a type="button" :href="`/api/laporan/neraca/export?tahun=${year}`" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import Neraca from '../apis/Neraca'

    export default {
        name: 'LaporanNeracaBulanan',
        created() {
            this.getNeracaList();
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        props: {
            month: {
                type: String,
                default: '1'
            }
        },
        data() {
            return {
                title: window.document.title,
                neraca_list: {},
                periode: 'tahunan',
                year: new Date().getFullYear()
            }
        },
        methods: {

            getNeracaList(year = this.year) {
                Neraca.getYearlyNeraca(year)
                    .then(response => {
                        this.neraca_list = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showNeracaBulanan(month) {
                this.$router.push(`/laporan/neraca/bulanan/${month}`)
            },

            showNeraca() {
                this.$router.push(`/laporan/neraca/${this.periode}`)
            }
        }
    }
</script>
