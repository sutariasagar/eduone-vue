<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> Create New Learning Material</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form @submit.prevent="submitForm" novalidate>
                                            <div class="box">
                                                
                                                <div class="box-body">
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Title <span class="text-danger">*</span></label>
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
                                                            <bootstrap-error :name="'subject'"  v-if="errors && errors['subject']"/>
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
                                                            <bootstrap-error :name="'chapter'"  v-if="errors && errors['chapter']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['topic'] }">
                                                        <label for="topic" class="col-md-3 col-form-label">Topic </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="topic"
                                                                placeholder="Enter Topic "
                                                                :value="item.topic"
                                                                @input="updateTopic"
                                                                :options="topicsAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'topic'" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['subtopic'] }">
                                                        <label for="subtopic" class="col-md-3 col-form-label">Sub Topic </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="subtopic"
                                                                placeholder="Enter Sub Topic "
                                                                :value="item.subtopic"
                                                                @input="updateSubTopic"
                                                                :options="subtopicsAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'subtopic'"/>
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
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
            showSummary: false
        }
    },
    computed: {
        ...mapGetters('LearningMaterialsSingle', ['item', 'loading','coursesAll','subjectsAll', 'chaptersAll', 'topicsAll', 'subtopicsAll']),
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
        context.fetchSubTopicsAll();
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('LearningMaterialsSingle', ['storeData', 'resetState', 'setTitle','setCourse', 'setSubject', 'setChapter', 'setTopic','setSubTopic','fetchCoursesAll', 'fetchSubjectsAll', 'fetchChaptersAll', 'fetchTopicsAll', 'fetchSubTopicsAll']),
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
        updateTopic(value) {
            this.setTopic(value)
        },
        updateSubTopic(value) {
            this.setSubTopic(value)
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'learning_materials.index' })
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
