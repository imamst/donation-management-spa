<template>
    <div>
        <app-navbar></app-navbar>

        <app-sidebar :user="user" :role="role"></app-sidebar>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <p class="m-0 text-dark"><i class="fas fa-calendar-alt"></i> {{ date }}</p>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" v-if="title != ''">
                                <li class="breadcrumb-item"><router-link to="/dashboard">Dashboard</router-link></li>
                                <li class="breadcrumb-item active">{{ title }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->
            
            <!-- Main content -->
            <section class="content">

                    <router-view />

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ year }} <a href="#">Pondok Pesantren Baitul Quran</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.00
            </div>
        </footer>
    </div>
</template>

<script>
    import store, { checkStatusTutupBuku } from './store.js'
    import helper from './helper.js'
    import User from './apis/User.js'
    import AppNavbar from './components/AppNavbar.vue'
    import AppSidebar from './components/AppSidebar.vue'

    export default {
        name: 'App',
        created() {
            User.auth()
                .then(response => {
                    this.user = response.data
                    this.role = response.data.role
                    store.role = response.data.role
                })
            
            checkStatusTutupBuku()
        },
        mounted() {
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                date: helper.getCurrentIndonesianDate(),
                year: new Date().getFullYear(),
                user: null,
                role: ''
            }
        },
        methods: {
            setTitle(value) {
                this.title = value
            }
        },
        components: {
            AppNavbar,
            AppSidebar
        }
    }
</script>
