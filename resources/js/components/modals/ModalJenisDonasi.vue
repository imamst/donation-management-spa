<template>
    <div class="modal fade" id="jenisDonasiFormModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ modalTitle }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" @submit.prevent="editMode ? update() : store()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputNamaJenisDonasi" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="inputNamaJenisDonasi" placeholder="Nama" required v-model="form.nama">

                                <span class="invalid-feedback d-block" v-if="errors && errors.nama">
                                    <strong>{{ errors.nama[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputMinimumDonasiJenisDonasi" class="col-sm-3 col-form-label">Minimum Donasi</label>
                            <div class="col-sm-9">
                                <input type="text" name="minimum_donasi" class="form-control" id="inputMinimumDonasiJenisDonasi" v-model.lazy="form.minimum_donasi" v-money="money">

                                <span class="invalid-feedback d-block" v-if="errors && errors.minimum_donasi">
                                    <strong>{{ errors.minimum_donasi[0] }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" v-show="editMode">Update</button>
                        <button type="submit" class="btn btn-primary" v-show="!editMode">Simpan</button>
                    </div>
                </form>
            </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import {VMoney} from 'v-money'
    import JenisDonasi from '../../apis/JenisDonasi'

    export default {
        name: 'ModalJenisDonasi',
        props: ['editMode', 'modalTitle', 'form'],
        data() {
            return {
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: '',
                    suffix: '',
                    precision: 0,
                    masked: false
                },
                errors: {}
            }
        },
        directives: {
            money: VMoney
        },
        methods: {
            store() {
                this.$Progress.start()

                JenisDonasi.store(this.form)
                    .then(async (response) => {

                        await this.$parent.getJenisDonasiList()
                        $('#jenisDonasiFormModal').modal('hide')
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

            update() {
                this.$Progress.start()

                JenisDonasi.update(this.form.id, this.form)
                    .then(async response => {
                        
                        await this.$parent.getJenisDonasiList()
                        $("#jenisDonasiFormModal").modal('hide')
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
        }
    }
</script>