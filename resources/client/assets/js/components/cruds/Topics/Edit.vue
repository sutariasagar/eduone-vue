<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Update Topic</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form-skeleton v-if="!loadTables"></form-skeleton>                                        
                                        <form v-else @submit.prevent="submitForm" novalidate>
                            <div class="box">

                                <div class="box-body">

                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                        <label for="title" class="col-md-3 col-form-label">Title *</label>
                                        <div class="col-md-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="title"
                                                placeholder="Enter Title *"
                                                :value="item.title"
                                                @input="updateTitle"
                                                 autocomplete="off"
                                            >
                                             <bootstrap-error :name="'title'" v-if="errors && errors['title']"/>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['course'] }">
                                        <label for="course" class="col-md-3 col-form-label">Course *</label>
                                        <div class="col-md-9">
                                            <v-select
                                                    name="course"
                                                    label="title"
                                                    @input="updateCourse"
                                                    :value="item.course"
                                                    :options="coursesAll"
                                                     autocomplete="off"
                                            />
                                             <bootstrap-error :name="'course'" v-if="errors && errors['course']"/>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['subject'] }">
                                        <label for="subject" class="col-md-3 col-form-label">Subject *</label>
                                        <div class="col-md-9">
                                            <v-select
                                                    name="subject"
                                                    label="title"
                                                    @input="updateSubject"
                                                    :value="item.subject"
                                                    :options="subjectsAll"
                                                     autocomplete="off"
                                            />
                                             <bootstrap-error :name="'subject'" v-if="errors && errors['subject']"/>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['chapter'] }">
                                        <label for="chapter" class="col-md-3 col-form-label">Chapter *</label>
                                        <div class="col-md-9">
                                            <v-select
                                                    name="chapter"
                                                    label="title"
                                                    @input="updateChapter"
                                                    :value="item.chapter"
                                                    :options="chaptersAll"
                                                     autocomplete="off"
                                            />
                                             <bootstrap-error :name="'chapter'" v-if="errors && errors['chapter']"/>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['learning_sequence'] }">
                                        <label for="learning_sequence" class="col-md-3 col-form-label">Learning Sequence  *</label>
                                        <div class="col-md-9">
                                            <input
                                                type="number"
                                                class="form-control"
                                                name="learning_sequence"
                                                placeholder="Enter Learning Sequence  *"
                                                :value="item.learning_sequence"
                                                @input="updateLearning_sequence"
                                                 autocomplete="off"
                                                min="0"
                                            >
                                             <bootstrap-error :name="'learning_sequence'" v-if="errors && errors['learning_sequence']"/>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['parent'] }">
                                        <label for="parent" class="col-md-3 col-form-label">Parent Topic</label>
                                        <div class="col-md-9">
                                        <v-select
                                                name="parent"
                                                label="title"
                                                @input="updateParent"
                                                :value="item.parent"
                                                :options="topicsAll"
                                                 autocomplete="off"
                                        />
                                         <bootstrap-error :name="'parent'" v-if="errors && errors['parent']"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer mt-5">
                                    <vue-button-spinner
                                        class="btn btn-purple mr-2 mb-2"
                                        :isLoading="loading"
                                        :disabled="loading"
                                    >
                                        UPDATE
                                    </vue-button-spinner>
                                    <back-buttton></back-buttton>
                                </div>
                            </div>
                        </form>
                                    </custom-collapse-body>
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
import formSkeleton from '../../utils/skeleton/Form.vue';

export default {
    data() {
        return {
            // Code...
            showSummary: false,
            loadTables: false
        }
    },
    computed: {
        ...mapGetters('TopicsSingle', ['item', 'loading', 'coursesAll', 'subjectsAll', 'chaptersAll', 'topicsAll']),
        ...mapGetters('Alert', ['errors'])
    },
    components:{
        formSkeleton
    },
    created() {
        this.$eventHub.$on('rules-update', this.showTable)                        
        this.fetchData(this.$route.params.id)
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            let app = this
            this.fetchData(this.$route.params.id).then(function(){
            app.loadTables = true;
            });
        }
    },
    methods: {
        ...mapActions('TopicsSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setCourse', 'setSubject', 'setChapter', 'setLearning_sequence', 'setParent']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        showTable(){
                let app = this
                this.fetchData(this.$route.params.id).then(function(){
                    app.loadTables = true;
                });
        },
        updateCourse(value) {
            this.setCourse(value)
        },
        updateSubject(value) {
            this.setSubject(value)
        },
        updateChapter(value) {
            this.setChapter(value)
        },
        updateLearning_sequence(e) {
            this.setLearning_sequence(e.target.value)
        },
        updateParent(value) {
            this.setParent(value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'topics.index' })
                    this.$eventHub.$emit('update-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
}
</script>


<style scoped>

</style>
