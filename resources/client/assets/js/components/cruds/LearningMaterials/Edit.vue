<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Update Learning Material</strong>
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
                                                                <bootstrap-error :name="'course'"/>
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
                                                                <bootstrap-error :name="'subject'"/>
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
                                                                <bootstrap-error :name="'chapter'"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['topic'] }">
                                                        <label for="topic" class="col-md-3 col-form-label">Topic </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                    name="topic"
                                                                    label="title"
                                                                    @input="updateTopic"
                                                                    :value="item.topic"
                                                                    :options="topicsAll"
                                                                     autocomplete="off"
                                                            />
                                                                <bootstrap-error :name="'topic'"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['subtopic'] }">
                                                        <label for="subtopic" class="col-md-3 col-form-label">Sub Topic</label>
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

                                                <div class="box-footer  mt-5">
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
                <div class="card card-with-shadow custom-sidebar pt-3 p-3">
                    <item-changes :item="item"></item-changes>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
import { mapGetters, mapActions } from 'vuex';
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
        ...mapGetters('LearningMaterialsSingle', ['item', 'loading', 'coursesAll', 'subjectsAll', 'chaptersAll', 'topicsAll','subtopicsAll']),
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
            let app = then
            this.fetchData(this.$route.params.id).then(function(){
                app.loadTables=true;
            });
        }
    },
    methods: {
        ...mapActions('LearningMaterialsSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setCourse', 'setSubject', 'setChapter', 'setTopic','setSubTopic']),
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
        showTable(){
                let app = this
                this.fetchData(this.$route.params.id).then(function(){
                    app.loadTables = true;
            });
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'learning_materials.index' })
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
