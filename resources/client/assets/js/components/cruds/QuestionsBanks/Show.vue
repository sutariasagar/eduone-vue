<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> View Questions Banks</strong>
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
                                                    <th>Header</th>
                                                    <td>{{ item.header }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Max score</th>
                                                    <td>{{ item.max_score }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Preparation time</th>
                                                    <td>{{ item.preparation_time }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Attempt time</th>
                                                    <td>{{ item.attempt_time }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ item.status }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Min words</th>
                                                    <td>{{ item.min_words }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Max words</th>
                                                    <td>{{ item.max_words }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Question type</th>
                                                    <td>
                                                        <span class="label label-info" v-if="item.question_type !== null">
                                                            {{ item.question_type.title }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </custom-collapse-body>
                                    <back-to-index :linkname="'questions_banks.index'"></back-to-index>
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
        ...mapGetters('QuestionsBanksSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('QuestionsBanksSingle', ['fetchData', 'resetState']),
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
}
</script>


<style scoped>

</style>
