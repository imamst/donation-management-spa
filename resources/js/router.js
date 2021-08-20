import Vue from 'vue'
import VueRouter from 'vue-router'

import {authCheck, guestCheck} from './middleware/auth'
import App from './App.vue'

//Pages
import Login from './pages/Login.vue'
import Dashboard from './pages/Dashboard.vue'
import AccountPassword from './pages/AccountPassword.vue'
import Amil from './pages/Amil.vue'
import Donasi from './pages/Donasi.vue'
import DonasiClose from './pages/DonasiClose.vue'
import DonasiCreate from './pages/DonasiCreate.vue'
import DonasiEdit from './pages/DonasiEdit.vue'
import LaporanDonasiHarian from './pages/LaporanDonasiHarian'
import LaporanDonasiBulanan from './pages/LaporanDonasiBulanan'
import LaporanDonasiTahunan from './pages/LaporanDonasiTahunan'
import Pengeluaran from './pages/Pengeluaran.vue'
import PengeluaranCreate from './pages/PengeluaranCreate.vue'
import PengeluaranEdit from './pages/PengeluaranEdit.vue'
import LaporanPengeluaranHarian from './pages/LaporanPengeluaranHarian'
import LaporanPengeluaranBulanan from './pages/LaporanPengeluaranBulanan'
import LaporanPengeluaranTahunan from './pages/LaporanPengeluaranTahunan'
import LaporanNeracaBulanan from './pages/LaporanNeracaBulanan'
import LaporanNeracaTahunan from './pages/LaporanNeracaTahunan'
import Rekening from './pages/Rekening.vue'
import Donatur from './pages/Donatur.vue'
import JenisDonasi from './pages/JenisDonasi.vue'
import JenisPengeluaran from './pages/JenisPengeluaran.vue'
import Monitoring from './pages/Monitoring.vue'
import Forbidden from './pages/errors/Forbidden.vue'
import NotFound from './pages/errors/NotFound.vue'

const routes = [
    {
        path: '/login', 
        name: 'Login',
        component: Login,
        meta: {
            guestOnly: true,
            title: 'Login'
        }
    },
    {
        path: '/', 
        component: App,
        children: [
            {
                path: '',
                name: 'Dashboard',
                component: Dashboard,
                meta: {
                    requiresAuth: true,
                    title: 'Dashboard'
                },
            },
            {
                path: '/account/password/edit', 
                name: 'AccountPassword',
                component: AccountPassword,
                meta: {
                    requiresAuth: true,
                    title: 'Ubah Password'
                }
            },
            {
                path: '/amil', 
                name: 'Amil',
                component: Amil,
                meta: {
                    requiresAuth: true,
                    title: 'Kelola Amil',
                    roles: ["Super Admin"]
                }
            },
            {
                path: '/transaksi/donasi', 
                name: 'Donasi',
                component: Donasi,
                meta: {
                    requiresAuth: true,
                    title: 'Donasi'
                }
            },
            {
                path: '/transaksi/donasi/close', 
                name: 'DonasiClose',
                component: DonasiClose,
                meta: {
                    requiresAuth: true,
                    title: 'Transaksi Donasi Hari Ini Berhasil Ditutup'
                }
            },
            {
                path: '/transaksi/donasi/create', 
                name: 'DonaturSelect',
                component: Donatur,
                props: { inputDonasi: true },
                meta: {
                    requiresAuth: true,
                    title: 'Step 1: Pilih Donatur'
                }
            },
            {
                path: '/transaksi/donasi/create/:id_donatur', 
                name: 'DonasiCreate',
                component: DonasiCreate,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Step 2: Input Detail Donasi'
                }
            },
            {
                path: '/transaksi/donasi/:id/edit', 
                name: 'DonasiEdit',
                component: DonasiEdit,
                meta: {
                    requiresAuth: true,
                    title: 'Edit Donasi',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/laporan/donasi/harian/:date?', 
                name: 'LaporanDonasiHarian',
                component: LaporanDonasiHarian,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Donasi Harian',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/laporan/donasi/bulanan/:month?', 
                name: 'LaporanDonasiBulanan',
                component: LaporanDonasiBulanan,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Donasi Bulanan',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/laporan/donasi/tahunan/:year?', 
                name: 'LaporanDonasiTahunan',
                component: LaporanDonasiTahunan,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Donasi Tahunan',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/transaksi/pengeluaran', 
                name: 'Pengeluaran',
                component: Pengeluaran,
                meta: {
                    requiresAuth: true,
                    title: 'Pengeluaran',
                    roles: ["Super Admin", "Admin"]
                }
            },
            {
                path: '/transaksi/pengeluaran/create', 
                name: 'PengeluaranCreate',
                component: PengeluaranCreate,
                props: { inputPengeluaran: true },
                meta: {
                    requiresAuth: true,
                    title: 'Input Detail Pengeluaran',
                    roles: ["Super Admin", "Admin"]
                }
            },
            {
                path: '/transaksi/pengeluaran/:id/edit', 
                name: 'PengeluaranEdit',
                component: PengeluaranEdit,
                meta: {
                    requiresAuth: true,
                    title: 'Edit Pengeluaran',
                    roles: ["Super Admin", "Admin"]
                }
            },
            {
                path: '/laporan/pengeluaran/harian/:date?', 
                name: 'LaporanPengeluaranHarian',
                component: LaporanPengeluaranHarian,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Pengeluaran Harian',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/laporan/pengeluaran/bulanan/:month?', 
                name: 'LaporanPengeluaranBulanan',
                component: LaporanPengeluaranBulanan,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Pengeluaran Bulanan',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/laporan/pengeluaran/tahunan/:year?', 
                name: 'LaporanPengeluaranTahunan',
                component: LaporanPengeluaranTahunan,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Pengeluaran Tahunan',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/laporan/neraca/bulanan/:month?', 
                name: 'LaporanNeracaBulanan',
                component: LaporanNeracaBulanan,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Neraca Bulanan',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/laporan/neraca/tahunan/:year?', 
                name: 'LaporanNeracaTahunan',
                component: LaporanNeracaTahunan,
                props: true,
                meta: {
                    requiresAuth: true,
                    title: 'Laporan Neraca Tahunan',
                    roles: ["Super Admin", "Admin", "Amil Senior"]
                }
            },
            {
                path: '/rekening', 
                name: 'Rekening',
                component: Rekening,
                meta: {
                    requiresAuth: true,
                    title: 'Rekening'
                }
            },
            {
                path: '/donatur', 
                name: 'Donatur',
                component: Donatur,
                meta: {
                    requiresAuth: true,
                    title: 'Donatur'
                }
            },
            {
                path: '/master/jenis-donasi', 
                name: 'Jenis Donasi',
                component: JenisDonasi,
                meta: {
                    requiresAuth: true,
                    title: 'Jenis Donasi',
                    roles: ["Super Admin"]
                }
            },
            {
                path: '/master/jenis-pengeluaran', 
                name: 'Jenis Pengeluaran',
                component: JenisPengeluaran,
                meta: {
                    requiresAuth: true,
                    title: 'Jenis Pengeluaran',
                    roles: ["Super Admin"]
                }
            },
            {
                path: '/monitoring', 
                name: 'Monitoring',
                component: Monitoring,
                meta: {
                    requiresAuth: true,
                    title: 'Monitoring Amil',
                    roles: ["Super Admin"]
                }
            },
            {
                path: '/forbidden', 
                name: 'Access Denied',
                component: Forbidden,
                meta: {
                    title: '403 Access Denied'
                }
            },
            { 
                path: '*', 
                name: 'Not Found',
                component: NotFound,
                meta: {
                    title: '404 Not Found'
                }
            }
        ],
        meta: {
            requiresAuth: true,
            title: ''
        },
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((toRoute, fromRoute, next) => {
    Vue.prototype.$Progress.start()

    if (toRoute.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        authCheck(next, toRoute.meta.roles)
    }
    else if (toRoute.matched.some(record => record.meta.guestOnly)) {
        // for guest only
        guestCheck(next)
    } else {
        next()
    }
})

router.afterEach((toRoute, fromRoute) => {
    window.document.title = toRoute.meta && toRoute.meta.title ? toRoute.meta.title : 'Home'
})

export default router