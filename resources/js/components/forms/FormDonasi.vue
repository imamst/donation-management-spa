<template>
<div class="container-fluid">
    <modal-donatur v-if="editMode" :modalTitle='"Tambah Donatur"' :form='{}'></modal-donatur>
    <modal-jenis-donasi :modalTitle='"Tambah Jenis Donasi"' :form='{}'></modal-jenis-donasi>
    <modal-rekening :modalTitle='"Tambah Rekening"' :form='{}'></modal-rekening>
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
                            <label for="inputTanggalDonasi" class="col-sm-2 col-form-label">Tanggal Donasi</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_donasi" class="form-control" id="inputTanggalDonasi" required v-model="form.tgl_donasi">

                                <span class="invalid-feedback d-block" v-if="errors && errors.tgl_donasi">
                                    <strong>{{ errors.tgl_donasi[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selectDonatur" class="col-sm-2 col-form-label">Donatur</label>
                            <div class="col-sm-9">
                                <select name="id_donatur" id="selectDonatur" class="form-control" required v-model="form.id_donatur">
                                    <option v-for="donatur in donatur_list"  :key="donatur.id" :value="donatur.id">
                                        {{ donatur.nama }}
                                    </option>
                                </select>

                                <span class="invalid-feedback d-block" v-if="errors && errors.id_donatur">
                                    <strong>{{ errors.id_donatur[0] }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-1" v-if="editMode">
                                <button type="button" class="btn btn-sm btn-success" @click="showDonaturModal"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selectJenisDonasi" class="col-sm-2 col-form-label">Jenis Donasi</label>
                            <div class="col-sm-9">
                                <select name="id_jenis_donasi" id="selectJenisDonasi" class="form-control" required v-model="form.id_jenis_donasi">
                                    <option v-for="jenis_donasi in jenis_donasi_list" :key="jenis_donasi.id" :value="jenis_donasi.id">
                                        {{ jenis_donasi.nama }}
                                    </option>
                                </select>

                                <span class="invalid-feedback d-block" v-if="errors && errors.id_jenis_donasi">
                                    <strong>{{ errors.id_jenis_donasi[0] }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-sm btn-success" @click="showJenisDonasiModal"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selectMetodeDonasi" class="col-sm-2 col-form-label">Metode Donasi</label>
                            <div class="col-sm-10">
                                <select name="metode_donasi" id="selectMetodeDonasi" class="form-control" required v-model="form.metode_donasi">
                                    <option value="Tunai">Tunai</option>
                                    <option value="Barang">Barang</option>
                                    <option value="Overbook">Overbook</option>
                                </select>

                                <span class="invalid-feedback d-block" v-if="errors && errors.metode_donasi">
                                    <strong>{{ errors.metode_donasi[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row" v-if="form.metode_donasi == 'Overbook'">
                            <label for="inputNamaBank" class="col-sm-2 col-form-label">Nama Bank</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_bank" class="form-control" id="inputNamaBank" required v-model="form.nama_bank">

                                <span class="invalid-feedback d-block" v-if="errors && errors.nama_bank">
                                    <strong>{{ errors.nama_bank[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row" v-show="form.metode_donasi == 'Overbook'">
                            <label for="selectRekening" class="col-sm-2 col-form-label">Rekening</label>
                            <div class="col-sm-9">
                                <select name="id_rekening" id="selectRekening" class="form-control" v-model="form.id_rekening">
                                    <option v-for="rekening in rekening_list" :key="rekening.id" :value="rekening.id">
                                        {{ rekening.nama }}
                                    </option>
                                </select>

                                <span class="invalid-feedback d-block" v-if="errors && errors.id_rekening">
                                    <strong>{{ errors.id_rekening[0] }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-sm btn-success" @click="showRekeningModal"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNominalDonasi" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" name="nominal" class="form-control" id="inputNominalDonasi" required v-model.lazy="form.nominal" v-money="money">

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
                            <label for="inputKeteranganDonasi" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" class="form-control" id="inputKeteranganDonasi" v-model="form.keterangan"></textarea>

                                <span class="invalid-feedback d-block" v-if="errors && errors.keterangan">
                                    <strong>{{ errors.keterangan[0] }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <router-link to="/transaksi/donasi" class="btn btn-default">Cancel</router-link>
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
    import Donatur from '../../apis/Donatur'
    import JenisDonasi from '../../apis/JenisDonasi'
    import Rekening from '../../apis/Rekening'
    import NoKwitansi from '../../apis/NoKwitansi'
    import Donasi from '../../apis/Donasi'
    import ModalDonatur from '../modals/ModalDonatur'
    import ModalJenisDonasi from '../modals/ModalJenisDonasi'
    import ModalRekening from '../modals/ModalRekening'

    export default {
        name: 'FormDonasi',
        components: {
            ModalDonatur,
            ModalJenisDonasi,
            ModalRekening
        },
        created() {
            this.getJenisDonasiList()
            this.getRekeningList()

            if(this.editMode) {
                this.getDonaturList()
                this.getDonasi(this.$route.params.id)
            }
            else {
                this.getDonatur(this.id_donatur)
                this.getNoKwitansi('donasi')
            }
        },
        props: [
            'editMode',
            'id_donatur'
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
                donatur: {},
                donatur_list: {},
                jenis_donasi_list: {},
                rekening_list: {},
                form: {
                    id: '',
                    tgl_donasi: '',
                    id_donatur: this.id_donatur,
                    id_jenis_donasi: '',
                    metode_donasi: '',
                    nama_bank: '-',
                    id_rekening: '',
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

            getDonatur(id) {
                Donatur.get(id)
                        .then(response => {
                            this.donatur_list = [response.data]
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getDonaturList() {
                Donatur.getList()
                        .then(response => {
                            this.donatur_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getJenisDonasiList() {
                JenisDonasi.getList()
                        .then(response => {
                            this.jenis_donasi_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getRekeningList() {
                Rekening.getList()
                        .then(response => {
                            this.rekening_list = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            getDonasi(id) {
                Donasi.get(id)
                        .then(response => {
                            this.form = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            },

            showDonaturModal() {
                $("#donaturFormModal").modal('show')
            },

            showJenisDonasiModal() {
                $("#jenisDonasiFormModal").modal('show')
            },

            showRekeningModal() {
                $("#rekeningFormModal").modal('show')
            },

            store() {
                this.$Progress.start()
                Donasi.store(this.form)
                    .then(response => {

                        this.$toast.fire({
                            icon: 'success',
                            title: response.data.message
                        })
                        this.$router.push('/transaksi/donasi')
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
                Donasi.update(this.form.id, this.form)
                    .then(response => {

                        this.$toast.fire({
                            icon: 'success',
                            title: response.data.message
                        })
                        this.$router.push('/transaksi/donasi')
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
