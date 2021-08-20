<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                        <button type="button" class="btn btn-sm btn-info" @click="showCreateModal">Tambah Jenis Pengeluaran</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="jenisPengeluaranTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="jenis in jenis_pengeluaran" :key="jenis.id">
                            <td>{{ jenis.nama }}</td>
                            <td>{{ jenis.keterangan }}</td>
                            <td>
                                <button type="button" class="btn btn-link text-success" @click="showEditModal(jenis)">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                
                                <button type="button" class="btn btn-link text-danger" @click="destroy(jenis.id)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <modal-jenis-pengeluaran :editMode='editMode' :modalTitle='modalTitle' :form='form'></modal-jenis-pengeluaran>
    </div>
</div>
</template>

<script>
    import JenisPengeluaran from '../apis/JenisPengeluaran'
    import ModalJenisPengeluaran from '../components/modals/ModalJenisPengeluaran'

    export default {
        name: 'JenisPengeluaran',
        components: {
            ModalJenisPengeluaran,
        },
        created() {
            this.getJenisPengeluaranList()
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                form: {
                    id: '',
                    nama: '',
                    keterangan: '',
                },
                jenis_pengeluaran: {},
                modalTitle: 'Tambah Jenis Pengeluaran',
                editMode: false,
                errors: {}
            }
        },
        methods: {
            clearForm() {
                this.form = {
                    id: '',
                    nama: '',
                    keterangan: '',
                }
            },

            getJenisPengeluaranList() {
                JenisPengeluaran.getList()
                    .then(response => {
                        this.jenis_pengeluaran = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showCreateModal() {
                this.editMode = false
                this.modalTitle = 'Tambah Jenis Pengeluaran'
                this.clearForm()
                $("#jenisPengeluaranFormModal").modal('show')
            },

            showEditModal(jenis) {
                this.editMode = true
                this.modalTitle = 'Edit Jenis Pengeluaran'
                this.form = {...jenis}
                $("#jenisPengeluaranFormModal").modal('show')
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
                            JenisPengeluaran.delete(id)
                                .then(async response => {

                                    await this.getJenisPengeluaranList()
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