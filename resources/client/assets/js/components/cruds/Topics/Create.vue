<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Create New Topic</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form @submit.prevent="submitForm" novalidate style="min-height: 100px">
                                            <div class="box">
                                                <div class="box-body">

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Title <span class="text-danger">*</span> </label>
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
                                                        <label for="course" class="col-md-3 col-form-label">Course <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="course"
                                                                placeholder="Enter Course *"
                                                                :value="item.course"
                                                                @input="updateCourse"
                                                                :options="coursesAll"
                                                                 autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'course'" v-if="errors && errors['course']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['subject'] }">
                                                        <label for="subject" class="col-md-3 col-form-label">Subject <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="subject"
                                                                placeholder="Enter Subject *"
                                                                :value="item.subject"
                                                                @input="updateSubject"
                                                                :options="subjectsAll"
                                                                 autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'subject'" v-if="errors && errors['subject']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['chapter'] }">
                                                        <label for="chapter" class="col-md-3 col-form-label">Chapter <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="chapter"
                                                                placeholder="Enter Chapter *"
                                                                :value="item.chapter"
                                                                @input="updateChapter"
                                                                :options="chaptersAll"
                                                                 autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'chapter'" v-if="errors && errors['chapter']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['learning_sequence'] }">
                                                        <label for="learning_sequence" class="col-md-3 col-form-label">Learning Sequence  <span class="text-danger">*</span> </label>
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
                                                        <label for="parent" class="col-md-3 col-form-label">Parent Topic </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                    label="title"
                                                                    name="parent"
                                                                    placeholder="Enter Parent Topic"
                                                                    :value="item.parent"
                                                                    @input="updateParent"
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
                                                        CREATE
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
    import {mapActions, mapGetters} from 'vuex'

    export default {
        data() {
            return {
                // Code...
                showSummary: false
            }
        },
        components: {},
        computed: {
            ...mapGetters('TopicsSingle', ['item', 'loading', 'coursesAll', 'subjectsAll', 'chaptersAll', 'topicsAll']),
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            this.$eventHub.$on('toggle-called', this.toggleColumns)
        },
        mounted() {
            let context = this;

            context.fetchCoursesAll();
            context.fetchSubjectsAll();
            context.fetchChaptersAll();
            context.fetchTopicsAll();
        },
        destroyed() {
            this.resetState()
        },
        methods: {
            ...mapActions('TopicsSingle', ['storeData', 'resetState', 'setTitle', 'setCourse', 'setSubject', 'setChapter', 'setLearning_sequence', 'setParent', 'fetchCoursesAll', 'fetchSubjectsAll', 'fetchChaptersAll', 'fetchTopicsAll']),
            updateTitle(e) {
                this.setTitle(e.target.value)
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
                this.storeData()
                    .then(() => {
                        this.$router.push({name: 'topics.index'})
                        this.$eventHub.$emit('create-success')
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
