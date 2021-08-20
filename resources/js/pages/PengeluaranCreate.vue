<template>
    <form-pengeluaran :editMode="editMode"></form-pengeluaran>
</template>

<script>
    import FormPengeluaran from '../components/forms/FormPengeluaran.vue'

    export default {
        name: 'PengeluaranCreate',
        mounted() {
            this.$Progress.finish()
            this.$parent.setTitle(window.document.title)
        },
        data() {
            return {
                editMode: false
            }
        },
        components: {
            FormPengeluaran
        }
    }
</script>