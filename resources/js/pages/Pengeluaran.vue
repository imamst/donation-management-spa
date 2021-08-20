<style scoped>
    ul.pagination {
        width: 100%;
        overflow-x: scroll;
    }
</style>

<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="text-right mb-2">
                <router-link to="/transaksi/pengeluaran/create" class="btn btn-sm btn-info">Tambah Pengeluaran</router-link>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                        <div class="card-tools d-flex flex-row align-middle">
                            <p>Pencarian: </p>
                            <select name="category" id="selectCategory" class="form-control mx-2" v-model="search.category">
                                <option value="no_kwitansi">No Kwitansi</option>
                                <option value="nama_jenis_pengeluaran">Jenis Pengeluaran</option>
                            </select>
                            <input type="text" name="keyword" v-model="search.keyword" class="form-control float-right" @keyup="searchPengeluaran">
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pengeluaranTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Keluar</th>
                                    <th>No Kwitansi</th>
                                    <th>Penerima</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Nominal</th>
                                    <th>Amil</th>
                                    <th>Tanggal Dibuat</th>
                                    <th v-if="role != 'Amil Junior'">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pengeluaran in pengeluaran_list.data" :key="pengeluaran.id">
                                    <td>{{ dayjs(pengeluaran.tgl_keluar).format('DD MMMM YYYY') }}</td>
                                    <td>{{ pengeluaran.no_kwitansi }}</td>
                                    <td>{{ pengeluaran.nama_penerima }}</td>
                                    <td>{{ pengeluaran.nama_jenis_pengeluaran }}</td>
                                    <td>Rp {{ pengeluaran.nominal_rupiah }}</td>
                                    <td>{{ pengeluaran.nama_amil }}</td>
                                    <td>{{ dayjs(pengeluaran.created_at).format('DD MMMM YYYY') }}</td>
                                    <td v-if="role != 'Amil Junior'">
                                        <button type="button" class="btn btn-link text-success" @click="edit(pengeluaran.id)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <button type="button" class="btn btn-link text-danger" @click="destroy(pengeluaran.id)">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination :data="pengeluaran_list" @pagination-change-page="getPengeluaranList"></pagination>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import store from '../store.js'
    import Pengeluaran from '../apis/Pengeluaran'

    export default {
        name: 'Pengeluaran',
        created() {
            this.getPengeluaranList();
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                role: store.role,
                pengeluaran_list: {},
                search: {
                    category: 'no_kwitansi',
                    keyword: ''
                },
                dayjs: this.$dayjs
            }
        },
        methods: {

            getPengeluaranList(page = 1) {
                Pengeluaran.getList(page)
                    .then(response => {
                        this.pengeluaran_list = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            searchPengeluaran: _.debounce(function() {
                Pengeluaran.search(this.search.category, this.search.keyword)
                        .then(response => {
                            this.pengeluaran_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            }, 1000),

            edit(id) {
                this.$router.push(`/transaksi/pengeluaran/${id}/edit`)
            },

            destroy(id) {
                this.$swal.fire({
                        title: 'Yakin hapus data?',
                        text: "Data yang telah dihapus tidak dapat dikembalikan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hapus!'
                    }).then((result) => {

                        if (result.isConfirmed) {

                            this.$Progress.start()
                            Pengeluaran.delete(id)
                                .then(async response => {

                                    await this.getPengeluaranList()
                                    this.$toast.fire({
                                        icon: 'success',
                                        title: response.data.message
                                    })
                                    this.$Progress.finish()

                                })
                                .catch(error => {

                                    this.$Progress.fail()
                                    this.$swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Gagal. Silakan coba lagi.',
                                    })
                                    
                                })
                        }
                    })
            }
        }
    }
</script>
