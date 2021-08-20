<style scoped>
    .router-link-exact-active {
        background-color: #007bff;
        color: #fff !important;
    }

</style>

<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link to="/" class="brand-link d-flex flex-row align-items-center">
            <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <div>
                <span class="brand-text font-weight-light">SISKEU <br>BAITUL QURAN</span>
            </div>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-5 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block" v-if="user">
                        <i class="fas fa-user mr-2"></i> {{ user.nama }}
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/transaksi/donasi" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Donasi</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="(role == 'Super Admin') || (role == 'Admin')">
                        <router-link to="/transaksi/pengeluaran" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengeluaran</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="(role == 'Super Admin') || (role == 'Admin') || (role == 'Amil Senior')">
                        <router-link to="/laporan/donasi/bulanan" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan Donasi</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="(role == 'Super Admin') || (role == 'Admin') || (role == 'Amil Senior')">
                        <router-link to="/laporan/pengeluaran/bulanan" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan Pengeluaran</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="(role == 'Super Admin') || (role == 'Admin') || (role == 'Amil Senior')">
                        <router-link to="/laporan/neraca/bulanan" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Neraca</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="role == 'Super Admin'">
                        <router-link to="/amil" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Kelola Amil</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="role == 'Super Admin'">
                        <router-link to="/monitoring" class="nav-link">
                            <i class="nav-icon far fa-chart-bar"></i>
                            <p>Monitoring</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/rekening" class="nav-link">
                            <i class="nav-icon far fa-credit-card"></i>
                            <p>Rekening</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/donatur" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Donatur</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="role == 'Super Admin'">
                        <router-link to="/master/jenis-donasi" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis Donasi</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="role == 'Super Admin'">
                        <router-link to="/master/jenis-pengeluaran" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis Pengeluaran</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    import store from '../store.js'

    export default {
        name: 'AppSidebar',
        props: ['user', 'role']
    }

</script>
