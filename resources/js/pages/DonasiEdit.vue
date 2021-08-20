<template>
    <form-donasi :editMode="editMode"></form-donasi>
</template>

<script>
    import FormDonasi from '../components/forms/FormDonasi.vue'

    export default {
        name: 'DonasiEdit',
        mounted() {
            this.$Progress.finish()
        },
        data() {
            return {
                editMode: true
            }
        },
        components: {
            FormDonasi
        }
    }
</script>