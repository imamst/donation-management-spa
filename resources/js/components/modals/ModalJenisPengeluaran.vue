<template>
    <div class="modal fade" id="jenisPengeluaranFormModal">
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
                            <label for="inputNama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Nama" required v-model="form.nama">

                                <span class="invalid-feedback d-block" v-if="errors && errors.nama">
                                    <strong>{{ errors.nama[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputKeterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea name="keterangan" class="form-control" id="inputKeterangan" v-model="form.keterangan"></textarea>

                                <span class="invalid-feedback d-block" v-if="errors && errors.keterangan">
                                    <strong>{{ errors.keterangan[0] }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" v-if="editMode">Update</button>
                        <button type="submit" class="btn btn-primary" v-else>Simpan</button>
                    </div>
                </form>
            </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import JenisPengeluaran from '../../apis/JenisPengeluaran'

    export default {
        name: 'ModalJenisPengeluaran',
        props: ['editMode', 'modalTitle', 'form'],
        data() {
            return {
                errors: {}
            }
        },
        methods: {
            store() {
                this.$Progress.start()

                JenisPengeluaran.store(this.form)
                    .then(async (response) => {

                        await this.$parent.getJenisPengeluaranList()
                        $('#jenisPengeluaranFormModal').modal('hide')
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

                JenisPengeluaran.update(this.form.id, this.form)
                    .then(async response => {
                        
                        await this.$parent.getJenisPengeluaranList()
                        $("#jenisPengeluaranFormModal").modal('hide')
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