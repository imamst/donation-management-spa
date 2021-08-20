<template>
    <div class="error-page text-center">
        <h1 class="text-warning">{{ title }}</h1>

        <div>
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Not Found.</h3>

          <p>
            Halaman yang Anda cari tidak ditemukan.
            Silakan <router-link to="/">kembali ke Dashboard</router-link>
          </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Not Found',
    data() {
        return {
            title: window.document.title
        }
    },
    mounted() {
        this.$parent.setTitle(this.title)
        this.$Progress.finish()
    },
}
</script>