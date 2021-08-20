<template>
    <form-donasi :editMode="editMode" :id_donatur="id_donatur"></form-donasi>
</template>

<script>
    import FormDonasi from '../components/forms/FormDonasi.vue'

    export default {
        name: 'DonasiCreate',
        mounted() {
            this.$Progress.finish()
            this.$parent.setTitle(window.document.title)
        },
        props: ['id_donatur'],
        data() {
            return {
                editMode: false
            }
        },
        components: {
            FormDonasi
        }
    }
</script>