<template>
    <div class="modal fade" id="donaturFormModal" tabindex="-1" role="dialog" aria-labelledby="donaturFormModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                            <label for="inputNamaDonatur" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="inputNamaDonatur" placeholder="Nama" required v-model="form.nama">

                                <span class="invalid-feedback d-block" v-if="errors && errors.nama">
                                    <strong>{{ errors.nama[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="selectGenderDonatur" class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select name="gender" id="selectGenderDonatur" class="custom-select" v-model="form.gender">
                                    <option value="L" selected aria-selected="true">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>

                                <span class="invalid-feedback d-block" v-if="errors && errors.gender">
                                    <strong>{{ errors.gender[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhoneDonatur" class="col-sm-3 col-form-label">No. HP</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" class="form-control" id="inputPhoneDonatur" placeholder="082329xxx" v-model="form.phone">

                                <span class="invalid-feedback d-block" v-if="errors && errors.phone">
                                    <strong>{{ errors.phone[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmailDonatur" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="inputEmailDonatur" placeholder="email@email.com" v-model="form.email">

                                <span class="invalid-feedback d-block" v-if="errors && errors.email">
                                    <strong>{{ errors.email[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPekerjaanDonatur" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input type="text" name="pekerjaan" class="form-control" id="inputPekerjaanDonatur" v-model="form.pekerjaan">

                                <span class="invalid-feedback d-block" v-if="errors && errors.pekerjaan">
                                    <strong>{{ errors.pekerjaan[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAddressDonatur" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="address" class="form-control" id="inputAddressDonatur" required v-model="form.address"></textarea>

                                <span class="invalid-feedback d-block" v-if="errors && errors.address">
                                    <strong>{{ errors.address[0] }}</strong>
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
    import Donatur from '../../apis/Donatur'

    export default {
        name: 'ModalDonatur',
        props: ['editMode', 'modalTitle', 'form'],
        data() {
            return {
                errors: {}
            }
        },
        methods: {
            store() {
                this.$Progress.start()

                Donatur.store(this.form)
                    .then(async (response) => {

                        await this.$parent.getDonaturList()
                        $('#donaturFormModal').modal('hide')
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

                Donatur.update(this.form.id, this.form)
                    .then(async response => {
                        
                        await this.$parent.getDonaturList()
                        $("#donaturFormModal").modal('hide')
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