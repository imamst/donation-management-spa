<template>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Dropdown Menu -->
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <router-link to="/account/password/edit" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Ubah Password
                </router-link>
                <div class="dropdown-divider"></div>
                <a href="#" @click.prevent="logout" class="dropdown-item">
                    <i class="fas fa-power-off mr-2"></i> Logout
                </a>
            </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
</template>

<script>
    import store from '../store.js'
    import User from '../apis/User.js'

    export default {
        name: 'AppNavbar',
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
