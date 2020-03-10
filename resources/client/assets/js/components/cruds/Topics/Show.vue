<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> View Topic</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <table class="table table-bordered table-striped" v-if="item">
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
                                                    <th>Course</th>
                                                    <td>
                                                        <span class="label label-info" v-if="item.course !== null">
                                                            {{ item.course.title }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Subject</th>
                                                    <td>
                                                        <span class="label label-info" v-if="item.subject !== null">
                                                            {{ item.subject.title }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Chapter</th>
                                                    <td>
                                                        <span class="label label-info" v-if="item.chapter !== null">
                                                            {{ item.chapter.title }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Learning Sequence</th>
                                                    <td>{{ item.learning_sequence }}</td>
                                                    </tr>
                                                <tr>
                                                    <th>Parent Topic</th>
                                                    <td>
                                                        <span class="label label-info" v-if="item.parent !== null">
                                                            {{ item.parent.title }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </custom-collapse-body>
                                <back-to-index :linkname="'topics.index'"></back-to-index>
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
        ...mapGetters('TopicsSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('TopicsSingle', ['fetchData', 'resetState']),
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
}
</script>


<style scoped>

</style>
