<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> View Package</strong>
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
                                                    <th>Title</th>
                                                    <td>{{ item.title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td>{{ item.price }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ item.status }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tests With Assessment</th>
                                                    <td>{{ item.tests_with_assessment }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Video Tutorials</th>
                                                    <td>{{ item.video_tutorials }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Practice Questions</th>
                                                    <td>{{ item.practice_questions }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Mock Tests</th>
                                                    <td>{{ item.mock_tests }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pte Vouchers </th>
                                                    <td>{{ item.pte_vouchers }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Webinar Sessions</th>
                                                    <td>{{ item.webinar_sessions }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Personal Feedback And Assessment</th>
                                                    <td>{{ item.personal_feedback_and_assessment }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Coaching Session Daily</th>
                                                    <td>{{ item.coaching_session_daily }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Unique Package Name</th>
                                                    <td>{{ item.unique_package_name }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </custom-collapse-body>
                                   <back-to-index :linkname="'packages.index'"></back-to-index>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div v-bind:class="{'d-none':!showSummary,'col-md-3':showSummary}">
                <div class="card card-with-shadow custom-sidebar">
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
        ...mapGetters('PackagesSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('PackagesSingle', ['fetchData', 'resetState']),
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
}
</script>


<style scoped>

</style>
