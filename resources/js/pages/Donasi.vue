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
            <div class="text-right mb-2" v-if="!status_tutup_buku">
                <router-link to="/transaksi/donasi/create" class="btn btn-sm btn-info">Tambah Donasi</router-link>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                        <div class="card-tools d-flex flex-row align-middle">
                            <p>Pencarian: </p>
                            <select name="category" id="selectCategory" class="form-control mx-2" v-model="search.category">
                                <option value="no_kwitansi">No Kwitansi</option>
                                <option value="nama_jenis_donasi">Jenis Donasi</option>
                                <option value="metode_donasi">Metode</option>
                            </select>
                            <input type="text" name="keyword" v-model="search.keyword" class="form-control float-right" @keyup="searchDonasi">
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="donasiTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Donasi</th>
                                    <th>No Kwitansi</th>
                                    <th>Donatur</th>
                                    <th>Jenis</th>
                                    <th>Metode</th>
                                    <th>Nama Bank</th>
                                    <th>Nominal</th>
                                    <th>Amil</th>
                                    <th>Tanggal Dibuat</th>
                                    <th v-if="role != 'Amil Junior'">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="donasi in donasi_list.data" :key="donasi.id">
                                    <td>{{ dayjs(donasi.tgl_donasi).format('DD MMMM YYYY') }}</td>
                                    <td>{{ donasi.no_kwitansi }}</td>
                                    <td>{{ donasi.nama_donatur }}</td>
                                    <td>{{ donasi.nama_jenis_donasi }}</td>
                                    <td>{{ donasi.metode_donasi }}</td>
                                    <td>{{ donasi.nama_bank }}</td>
                                    <td>Rp {{ donasi.nominal_rupiah }}</td>
                                    <td>{{ donasi.nama_amil }}</td>
                                    <td>{{ dayjs(donasi.created_at).format('DD/MM/YYYY') }}</td>
                                    <td v-if="role != 'Amil Junior'">
                                        <button type="button" class="btn btn-link text-success" @click="edit(donasi.id)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <button v-if="(role == 'Super Admin') || (role == 'Admin')" type="button" class="btn btn-link text-danger" @click="destroy(donasi.id)">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination :data="donasi_list" @pagination-change-page="getDonasiList"></pagination>
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
    import Donasi from '../apis/Donasi'

    export default {
        name: 'Donasi',
        created() {
            this.getDonasiList();
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                role: store.role,
                status_tutup_buku: store.status_tutup_buku,
                donasi_list: {},
                search: {
                    category: 'no_kwitansi',
                    keyword: ''
                },
                dayjs: this.$dayjs
            }
        },
        methods: {

            getDonasiList(page = 1) {
                Donasi.getList(page)
                    .then(response => {
                        this.donasi_list = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            searchDonasi: _.debounce(function() {
                Donasi.search(this.search.category, this.search.keyword)
                        .then(response => {
                            this.donasi_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            }, 1000),

            edit(id) {
                this.$router.push(`/transaksi/donasi/${id}/edit`)
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
                            Donasi.delete(id)
                                .then(async response => {

                                    await this.getDonasiList()
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
