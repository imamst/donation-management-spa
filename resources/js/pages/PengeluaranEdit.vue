<template>
    <form-pengeluaran :editMode="editMode"></form-pengeluaran>
</template>

<script>
    import FormPengeluaran from '../components/forms/FormPengeluaran.vue'

    export default {
        name: 'PengeluaranEdit',
        mounted() {
            this.$Progress.finish()
        },
        data() {
            return {
                editMode: true
            }
        },
        components: {
            FormPengeluaran
        }
    }
</script>