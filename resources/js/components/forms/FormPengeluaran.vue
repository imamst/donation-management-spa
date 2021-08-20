<template>
<div class="container-fluid">
    <modal-jenis-pengeluaran :modalTitle='"Tambah Jenis Pengeluaran"' :form='{}'></modal-jenis-pengeluaran>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ title }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" @submit.prevent="editMode ? update() : store()">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputTanggalPengeluaran" class="col-sm-2 col-form-label">Tanggal Pengeluaran</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_keluar" class="form-control" id="inputTanggalPengeluaran" required v-model="form.tgl_keluar">

                                <span class="invalid-feedback d-block" v-if="errors && errors.tgl_keluar">
                                    <strong>{{ errors.tgl_keluar[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNamaPenerima" class="col-sm-2 col-form-label">Nama Penerima</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_penerima" class="form-control" id="inputNamaPenerima" required v-model="form.nama_penerima">

                                <span class="invalid-feedback d-block" v-if="errors && errors.nama_penerima">
                                    <strong>{{ errors.nama_penerima[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selectJenisPengeluaran" class="col-sm-2 col-form-label">Jenis Pengeluaran</label>
                            <div class="col-sm-9">
                                <select name="id_jenis_pengeluaran" id="selectJenisPengeluaran" class="form-control" required v-model="form.id_jenis_pengeluaran">
                                    <option v-for="jenis_pengeluaran in jenis_pengeluaran_list" :key="jenis_pengeluaran.id" :value="jenis_pengeluaran.id">
                                        {{ jenis_pengeluaran.nama }}
                                    </option>
                                </select>

                                <span class="invalid-feedback d-block" v-if="errors && errors.id_jenis_pengeluaran">
                                    <strong>{{ errors.id_jenis_pengeluaran[0] }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-sm btn-success" @click="showJenisPengeluaranModal"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNominalPengeluaran" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" name="nominal" class="form-control" id="inputNominalPengeluaran" required v-model.lazy="form.nominal" v-money="money">

                                <span class="invalid-feedback d-block" v-if="errors && errors.nominal">
                                    <strong>{{ errors.nominal[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNoKwitansi" class="col-sm-2 col-form-label">No Kwitansi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled :value="form.no_kwitansi">
                                <input type="hidden" name="no_kwitansi" class="form-control" id="inputNoKwitansi" required v-model="form.no_kwitansi">

                                <span class="invalid-feedback d-block" v-if="errors && errors.no_kwitansi">
                                    <strong>{{ errors.no_kwitansi[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputKeteranganPengeluaran" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" class="form-control" id="inputKeteranganPengeluaran" v-model="form.keterangan"></textarea>

                                <span class="invalid-feedback d-block" v-if="errors && errors.keterangan">
                                    <strong>{{ errors.keterangan[0] }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <router-link to="/transaksi/pengeluaran" class="btn btn-default">Cancel</router-link>
                        <button type="submit" class="btn btn-info" v-if="editMode">Update</button>
                        <button type="submit" class="btn btn-info ml-3" v-else>Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import {VMoney} from 'v-money'
    import JenisPengeluaran from '../../apis/JenisPengeluaran'
    import NoKwitansi from '../../apis/NoKwitansi'
    import Pengeluaran from '../../apis/Pengeluaran'
    import ModalJenisPengeluaran from '../modals/ModalJenisPengeluaran'

    export default {
        name: 'FormPengeluaran',
        components: {
            ModalJenisPengeluaran,
        },
        created() {
            this.getJenisPengeluaranList()
            
            if(this.editMode) {
                this.getPengeluaran(this.$route.params.id)
            }
            else {
                this.getNoKwitansi('pengeluaran')
            }
        },
        props: [
            'editMode'
        ],
        data() {
            return {
                title: window.document.title,
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: '',
                    suffix: '',
                    precision: 0,
                    masked: false
                },
                jenis_pengeluaran_list: {},
                form: {
                    id: '',
                    tgl_keluar: '',
                    nama_penerima: '',
                    id_jenis_pengeluaran: '',
                    nominal: '',
                    no_kwitansi: '',
                    keterangan: ''
                },
                errors: {},
            }
        },
        directives: {
            money: VMoney
        },
        methods: {

            getNoKwitansi(jenis_transaksi) {
                NoKwitansi.get(jenis_transaksi)
                        .then(response => {
                            this.form.no_kwitansi = response.data.no_kwitansi
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getJenisPengeluaranList() {
                JenisPengeluaran.getList()
                        .then(response => {
                            this.jenis_pengeluaran_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getPengeluaran(id) {
                Pengeluaran.get(id)
                        .then(response => {
                            this.form = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            showJenisPengeluaranModal() {
                $("#jenisPengeluaranFormModal").modal('show')
            },

            store() {
                this.$Progress.start()
                Pengeluaran.store(this.form)
                    .then(response => {

                        this.$toast.fire({
                            icon: 'success',
                            title: response.data.message
                        })
                        this.$router.push('/transaksi/pengeluaran')
                        this.$Progress.finish()

                    }).catch(error => {
                        
                        this.$Progress.fail()
                        if(error.response.status == 422) {
                            this.errors = error.response.data.errors
                        }
                    });
            },

            update() {
                this.$Progress.start()
                Pengeluaran.update(this.form.id, this.form)
                    .then(response => {

                        this.$toast.fire({
                            icon: 'success',
                            title: response.data.message
                        })
                        this.$router.push('/transaksi/pengeluaran')
                        this.$Progress.finish()

                    }).catch(error => {
                        
                        this.$Progress.fail()
                        if(error.response.status == 422) {
                            this.errors = error.response.data.errors
                        }
                    });
            }
        }
    }
</script>
