<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                        <button type="button" class="btn btn-sm btn-info" @click="showCreateModal">Tambah Rekening</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="rekeningTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="rekening in rekenings" :key="rekening.id">
                            <td>{{ rekening.nama }}</td>
                            <td>{{ rekening.keterangan }}</td>
                            <td>
                                <button type="button" class="btn btn-link text-success" @click="showEditModal(rekening)">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <button type="button" class="btn btn-link text-danger" @click="destroy(rekening.id)">
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

        <modal-rekening :editMode='editMode' :modalTitle='modalTitle' :form='form'></modal-rekening>
    </div>
</div>
</template>

<script>
    import Rekening from '../apis/Rekening'
    import ModalRekening from '../components/modals/ModalRekening'

    export default {
        name: 'Rekening',
        components: {
            ModalRekening
        },
        created() {
            this.getRekeningList()
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
                rekenings: {},
                modalTitle: 'Tambah Rekening',
                editMode: false,
                errors: {}
            }
        },
        methods: {
            clearForm() {
                this.form = {
                    id: '',
                    nama: '',
                    keterangan: ''
                }
            },

            getRekeningList() {
                Rekening.getList()
                    .then(response => {
                        this.rekenings = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showCreateModal() {
                this.editMode = false
                this.modalTitle = 'Tambah Rekening'
                this.clearForm()
                $("#rekeningFormModal").modal('show')
            },

            showEditModal(rekening) {
                this.editMode = true
                this.modalTitle = 'Edit Rekening'
                this.form = {...rekening}
                $("#rekeningFormModal").modal('show')
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
                            Rekening.delete(id)
                                .then(async response => {

                                    await this.getRekeningList()
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