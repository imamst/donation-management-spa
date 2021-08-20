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
                <button type="button" class="btn btn-sm btn-info" @click="showCreateModal">Tambah Donatur</button>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                        <div class="card-tools">
                            <input type="text" name="keyword" v-model="keyword" class="form-control float-right" placeholder="Cari Nama Donatur" @keyup="search">
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="donaturTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>No. HP</th>
                                    <th>Email</th>
                                    <th>Pekerjaan</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="donatur in donaturs.data" :key="donatur.id">
                                    <td>{{ donatur.nama }}</td>
                                    <td>{{ donatur.gender }}</td>
                                    <td>{{ donatur.phone }}</td>
                                    <td>{{ donatur.email }}</td>
                                    <td>{{ donatur.pekerjaan }}</td>
                                    <td>{{ donatur.address }}</td>
                                    <td v-if="inputDonasi == true">
                                        <button type="button" class="btn btn-primary" @click="selectDonatur(donatur.id)">
                                            Pilih <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                    <td v-else>
                                        <button type="button" class="btn btn-link text-success" @click="showEditModal(donatur)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-link text-danger" @click="destroy(donatur.id)">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination :data="donaturs" @pagination-change-page="getDonaturList"></pagination>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <modal-donatur :editMode='editMode' :modalTitle='modalTitle' :form='form'></modal-donatur>
    </div>
</div>
</template>

<script>
    import Donatur from '../apis/Donatur'
    import ModalDonatur from '../components/modals/ModalDonatur'

    export default {
        name: 'Donatur',
        components: {
            ModalDonatur
        },
        created() {
            this.getDonaturList()
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        props: ["inputDonasi"],
        data() {
            return {
                title: window.document.title,
                form: {
                    id: '',
                    nama: '',
                    address: '',
                    gender: 'L',
                    email: '',
                    phone: '',
                    pekerjaan: ''
                },
                donaturs: {},
                keyword: '',
                modalTitle: 'Tambah Donatur',
                editMode: false
            }
        },
        methods: {

            clearForm() {
                this.form = {
                    id: '',
                    nama: '',
                    address: '',
                    gender: 'L',
                    email: '',
                    phone: '',
                    pekerjaan: ''
                }
            },

            getDonaturList(page = 1) {
                Donatur.getListPaginate(page)
                    .then(response => {
                        this.donaturs = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            search: _.debounce(function() {
                Donatur.search(this.keyword)
                        .then(response => {
                            this.donaturs = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            }, 1000),

            showCreateModal() {
                this.editMode = false
                this.modalTitle = 'Tambah Donatur'
                this.clearForm()
                $("#donaturFormModal").modal('show')
            },

            showEditModal(donatur) {
                this.editMode = true
                this.modalTitle = 'Edit Donatur'
                this.form = {...donatur}
                $("#donaturFormModal").modal('show')
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
                            Donatur.delete(id)
                                .then(async response => {

                                    await this.getDonaturList()
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
            },

            selectDonatur(id) {
                this.$router.push({path: `/transaksi/donasi/create/${id}`})
            }
        }
    }
</script>