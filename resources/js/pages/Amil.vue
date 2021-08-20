<style scoped>
    #togglePassword, #togglePasswordConfirmation {
        cursor: pointer;
    }
</style>

<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                        <button data-toggle="modal" data-target="#amilFormModal" class="btn btn-sm btn-info">Buat Akun Amil</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="amilTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="amil in amils" :key="amil.id">
                            <td>{{ amil.nama }}</td>
                            <td>{{ amil.email }}</td>
                            <td>{{ amil.role }}</td>
                            <td>{{ amil.status }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" v-if="amil.status == 'Aktif'" @click="updateStatus(amil.id, false)">
                                    <i class="fas fa-ban"></i> Block
                                </button>

                                <button type="button" class="btn btn-sm btn-success" v-else @click="updateStatus(amil.id, true)">
                                    <i class="fas fa-unlock"></i> Un-Block
                                </button>

                                <button type="button" class="btn btn-sm btn-danger" @click="destroy(amil.id)">
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

        <!-- Create Amil Modal -->
        <div class="modal fade" id="amilFormModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Amil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-horizontal" @submit.prevent="store">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="inputNama" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Nama" required v-model="form.nama">

                                    <span class="invalid-feedback d-block" v-if="errors && errors.nama">
                                        <strong>{{ errors.nama[0] }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" required v-model="form.email">

                                    <span class="invalid-feedback d-block" v-if="errors && errors.email">
                                        <strong>{{ errors.email[0] }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="inputPassword" required v-model="form.password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <span class="invalid-feedback d-block" v-if="errors && errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPasswordConfirmation" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" required v-model="form.password_confirmation">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePasswordConfirmation">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="selectRole" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select name="role" id="selectRole" class="custom-select" v-model="form.role">
                                        <option value="1">Amil Junior</option>
                                        <option value="2">Amil Senior</option>
                                        <option value="3">Admin</option>
                                    </select>

                                    <span class="invalid-feedback d-block" v-if="errors && errors.role">
                                        <strong>{{ errors.role[0] }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="selectStatus" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" id="selectStatus" class="custom-select" v-model="form.status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                    </select>

                                    <span class="invalid-feedback d-block" v-if="errors && errors.status">
                                        <strong>{{ errors.status[0] }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</div>
</template>

<script>
    import Amil from '../apis/Amil'

    export default {
        name: 'Amil',
        created() {
            this.getList()
        },
        mounted() {
            let scripts = [
                "/js/togglePassword.js"
            ];

            scripts.forEach(script => {
                let tag = document.createElement("script");
                tag.setAttribute("src", script);
                document.head.appendChild(tag);
            });

            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                form: {
                    nama: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role: '1',
                    status: '1'
                },
                amils: {},
                errors: {}
            }
        },
        methods: {

            getList() {
                Amil.getList()
                    .then(response => {
                        this.amils = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            store() {
                this.$Progress.start()

                Amil.store(this.form)
                    .then(async response => {

                        this.form = {
                            nama: '',
                            email: '',
                            password: '',
                            password_confirmation: '',
                            role: '1',
                            status: '1'
                        }

                        await this.getList()
                        $('#amilFormModal').modal('hide')
                        this.$toast.fire({
                            icon: 'success',
                            title: response.data.message
                        })

                        this.$Progress.finish()

                    })
                    .catch(error => {

                        this.$Progress.fail()

                        if(error.response.status == 422)
                        {
                            this.errors = error.response.data.errors
                        }

                    })
            },

            updateStatus(id, status) {
                this.$Progress.start()

                Amil.updateStatus(id, status)
                    .then(async response => {

                        await this.getList()
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
                            Amil.delete(id)
                                .then(async response => {

                                    await this.getList()
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