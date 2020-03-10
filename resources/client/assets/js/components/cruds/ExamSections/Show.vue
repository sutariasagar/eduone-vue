<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Exam sections</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">View</h3>
                        </div>

                        <div class="box-body">
                            <back-buttton></back-buttton>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                        <tr>
                                            <th>#</th>
                                            <td>{{ item.id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ item.title }}</td>
                                            </tr>
                                        <tr>
                                            <th>Min questions</th>
                                            <td>{{ item.min_questions }}</td>
                                            </tr>
                                        <tr>
                                            <th>Max questions</th>
                                            <td>{{ item.max_questions }}</td>
                                            </tr>
                                        <tr>
                                            <th>Timer</th>
                                            <td>{{ item.timer }}</td>
                                            </tr>
                                        <tr>
                                            <th>Is Subsection</th>
                                            <td>{{ item.is_subsection }}</td>
                                            </tr>
                                        <tr>
                                            <th>Min time</th>
                                            <td>{{ item.min_time }}</td>
                                            </tr>
                                        <tr>
                                            <th>Max time</th>
                                            <td>{{ item.max_time }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
        }
    },
    created() {
        this.fetchData(this.$route.params.id)
    },
    destroyed() {
        this.resetState()
    },
    computed: {
        ...mapGetters('ExamSectionsSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('ExamSectionsSingle', ['fetchData', 'resetState'])
    }
}
</script>


<style scoped>

</style>
