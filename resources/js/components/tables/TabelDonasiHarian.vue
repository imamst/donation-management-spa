<template>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Kwitansi</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis</th>
                <th>Metode Donasi</th>
                <th>Nama Bank</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th v-if="!mode_laporan">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(donasi, index) in donasi_list" :key="donasi.id">
                <td>{{ index+1 }}</td>
                <td>{{ donasi.no_kwitansi }}</td>
                <td><b>{{ donasi.nama_donatur }}</b></td>
                <td>{{ donasi.alamat_donatur }}</td>
                <td>{{ donasi.nama_jenis_donasi }}</td>
                <td>{{ donasi.metode_donasi }}</td>
                <td>{{ donasi.nama_bank }}</td>
                <td>Rp {{ donasi.nominal_rupiah }}</td>
                <td>{{ donasi.keterangan }}</td>
                <td v-if="!mode_laporan">
                    <a type="button" :href="`/api/transaksi/donasi/${donasi.id}/export`" class="btn btn-sm btn-warning mr-3"><i class="fa fa-print"></i> Cetak</a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: 'TabelDonasiHarian',
    props: ['donasi_list', 'mode_laporan'],
}
</script>