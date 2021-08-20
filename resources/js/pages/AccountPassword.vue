<style scoped>
    #togglePassword, #togglePasswordConfirmation {
        cursor: pointer;
    }
</style>

<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Ubah Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" @submit.prevent="updatePassword">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required v-model="form.password">
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
                            <label for="inputPasswordConfirmation" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" placeholder="Ketik Ulang Password" required v-model="form.password_confirmation">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePasswordConfirmation">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import User from '../apis/User'

    export default {
        name: 'AccountPassword',
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
                    password: '',
                    password_confirmation: ''
                },
                errors: {},
            }
        },
        methods: {

            updatePassword() {
                this.$Progress.start()
                User.updatePassword(this.form)
                    .then(response => {

                        this.form = {}
                        this.$toast.fire({
                            icon: 'success',
                            title: response.data.message
                        })
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
