<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                        <button type="button" class="btn btn-sm btn-info" @click="showCreateModal">Tambah Jenis Donasi</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="jenisDonasiTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Minimum Donasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="jenis in jenis_donasi" :key="jenis.id">
                            <td>{{ jenis.nama }}</td>
                            <td>Rp {{ jenis.minimum_donasi }}</td>
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

        <modal-jenis-donasi :editMode='editMode' :modalTitle='modalTitle' :form='form'></modal-jenis-donasi>
    </div>
</div>
</template>

<script>
    import JenisDonasi from '../apis/JenisDonasi'
    import ModalJenisDonasi from '../components/modals/ModalJenisDonasi'

    export default {
        name: 'JenisDonasi',
        components: {
            ModalJenisDonasi
        },
        created() {
            this.getJenisDonasiList()
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
                    minimum_donasi: '',
                },
                jenis_donasi: {},
                modalTitle: 'Tambah Jenis Donasi',
                editMode: false,
                errors: {}
            }
        },
        methods: {
            clearForm() {
                this.form = {
                    id: '',
                    nama: '',
                    minimum_donasi: '',
                }
            },

            getJenisDonasiList() {
                JenisDonasi.getList()
                    .then(response => {
                        this.jenis_donasi = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showCreateModal() {
                this.editMode = false
                this.modalTitle = 'Tambah Jenis Donasi'
                this.clearForm()
                $("#jenisDonasiFormModal").modal('show')
            },

            showEditModal(jenis) {
                this.editMode = true
                this.modalTitle = 'Edit Jenis Donasi'
                this.form = {...jenis}
                $("#jenisDonasiFormModal").modal('show')
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
                            JenisDonasi.delete(id)
                                .then(async response => {

                                    await this.getJenisDonasiList()
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