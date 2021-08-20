<template>
<div class="container-fluid">

    <!-- Main row -->
    <div class="row">
    <!-- Left col -->
        <div class="col-md-12">
            <!-- TABLE: TODAY'S DONATION -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">{{ title }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div>
                        <a type="button" :href="`/api/donasi/export/today?d=${date}`" class="btn btn-sm btn-success mr-3"><i class="fas fa-file-excel"></i> Export Donasi Hari Ini</a>
                        <button type="button" class="btn btn-sm btn-secondary" @click="logout"><i class="fas fa-power-off"></i> Logout</button>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
</template>

<script>
    import store from '../store'
    import helper from '../helper'
    import User from '../apis/User'

    export default {
        name: 'DonasiClose',
        mounted() {
            this.$parent.setTitle('')
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                date: helper.getCurrentIndonesianDate(),
            }
        },
        methods: {
            logout() {
                User.logout()
                    .then(() => {
                        store.role = ''
                        this.$router.push({ name: "Login" })
                    })
                    .catch((errors) => {

                    })
            }
        }
    }
</script>
