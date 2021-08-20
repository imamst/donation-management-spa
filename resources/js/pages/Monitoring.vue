<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h3 class="card-title">{{ title }}</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="monitoringTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Amil</th>
                            <th>Terakhir Login</th>
                            <th>Terakhir Logout</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="amil_record in monitoring_list" :key="amil_record.id">
                            <td>{{ amil_record.nama_amil }}</td>
                            <td>{{ dayjs(amil_record.tgl_login).format('DD MMMM YYYY H:m:s') }}</td>
                            <td>{{ (amil_record.tgl_logout != null ) ? dayjs(amil_record.tgl_logout).format('DD MMMM YYYY HH:mm:ss') : '' }}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import Monitoring from '../apis/Monitoring'

    export default {
        name: 'Monitoring',
        created() {
            this.getMonitoringList()
        },
        mounted() {
            this.$parent.setTitle(this.title)
            this.$Progress.finish()
        },
        data() {
            return {
                title: window.document.title,
                monitoring_list: {},
                dayjs: this.$dayjs
            }
        },
        methods: {
            getMonitoringList() {
                Monitoring.getList()
                    .then(response => {
                        this.monitoring_list = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }
</script>