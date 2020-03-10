<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> View Student</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>Id</th>
                                                    <td>{{ item.id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Registration Id</th>
                                                    <td>{{ item.registration_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Test Taker Id</th>
                                                    <td>{{ item.test_taker_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>First Name</th>
                                                    <td>{{ item.first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Middle Name</th>
                                                    <td>{{ item.middle_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Name</th>
                                                    <td>{{ item.last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ item.email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td>{{ item.phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date Of Birth</th>
                                                    <td>{{ item.date_of_birth }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td>{{ item.gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td>{{ item.country }}</td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td>{{ item.state }}</td>
                                                </tr>
                                                <tr>
                                                    <th>City</th>
                                                    <td>{{ item.city }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td>{{ item.type }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Package</th>
                                                    <td>
                                                        <span class="label label-info" v-if="item.package !== null">
                                                            {{ item.package.title }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </custom-collapse-body>
                                    <back-to-index :linkname="'students.index'"></back-to-index>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div v-bind:class="{'d-none':!showSummary,'col-md-3':showSummary}">
                <div class="card card-with-shadow custom-sidebar pt-3 p-3">
                    <item-changes :item="item"></item-changes>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
            showSummary: false
        }
    },
    created() {
        this.fetchData(this.$route.params.id)
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    destroyed() {
        this.resetState()
    },
    computed: {
        ...mapGetters('StudentsSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('StudentsSingle', ['fetchData', 'resetState']),
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
}
</script>


<style scoped>

</style>
