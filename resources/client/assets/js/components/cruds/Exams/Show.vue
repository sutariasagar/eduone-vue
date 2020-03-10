<template>
    <div class="">
        <skeleton-loading>
        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> View Exams</strong>
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
                                            <th>Question pool</th>
                                            <td>{{ item.question_pool }}</td>
                                            </tr>
                                        <tr>
                                            <th>Total marks</th>
                                            <td>{{ item.total_marks }}</td>
                                            </tr>
                                        <tr>
                                            <th>Passing marks</th>
                                            <td>{{ item.passing_marks }}</td>
                                            </tr>
                                        <tr>
                                            <th>Duration</th>
                                            <td>{{ item.duration }}</td>
                                            </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ item.status }}</td>
                                            </tr>
                                        <tr>
                                            <th>Start instructions</th>
                                            <td v-html="item.start_instructions"></td>
                                            </tr>
                                        <tr>
                                            <th>End instructions</th>
                                            <td v-html="item.end_instructions"></td>
                                            </tr>
                                        <tr>
                                            <th>Exam type</th>
                                            <td>{{ item.exam_type }}</td>
                                            </tr>
                                        <tr>
                                            <th>Sections count</th>
                                            <td>{{ item.sections_count }}</td>
                                            </tr>
                                        <tr>
                                            <th>Can see solution</th>
                                            <td>{{ item.can_see_solution }}</td>
                                            </tr>
                                        <tr>
                                            <th>Instruction type</th>
                                            <td>{{ item.instruction_type }}</td>
                                            </tr>
                                        <tr>
                                            <th>Created by</th>
                                            <td>
                                                <span class="label label-info" v-if="item.created_by !== null">
                                                    {{ item.created_by.name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Updated by</th>
                                            <td>
                                                <span class="label label-info" v-if="item.updated_by !== null">
                                                    {{ item.updated_by.name }}
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </custom-collapse-body>
                                <back-to-index :linkname="'exams.index'"></back-to-index>
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
        </skeleton-loading>
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
        ...mapGetters('ExamsSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('ExamsSingle', ['fetchData', 'resetState']),
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
}
</script>


<style scoped>

</style>
