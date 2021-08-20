<template>
    <div class="error-page text-center">
        <h1 class="text-danger">{{ title }}</h1>

        <div>
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Forbidden.</h3>

          <p>
            Anda tidak diijinkan untuk mengakses halaman ini.
            Silakan <router-link to="/">kembali ke Dashboard</router-link>
          </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Forbidden',
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