<template>
    <form @submit.prevent="submitForm" novalidate>
        <div class="box">

            <div class="box-body">

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
                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['topic'] }">
                    <label for="topic" class="col-md-3 col-form-label">Topic </label>
                    <div class="col-md-9">
                        <v-select
                                label="title"
                                name="topic"
                                placeholder="Enter Topic *"
                                :value="item.topic"
                                @input="updateTopic"
                                :options="topicsAll"
                                autocomplete="off"
                        />
                        <bootstrap-error :name="'topic'" v-if="errors && errors['chapter']" />
                    </div>
                </div>
                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['subtopic'] }">
                    <label for="subtopic" class="col-md-3 col-form-label">Sub Topic </label>
                    <div class="col-md-9">
                        <v-select
                                label="title"
                                name="subtopic"
                                placeholder="Enter Sub Topic *"
                                :value="item.subtopic"
                                @input="updateSubTopic"
                                :options="subtopicsAll"
                                autocomplete="off"
                        />
                        <bootstrap-error :name="'subtopic'" v-if="errors && errors['chapter']" />
                    </div>
                </div>
                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['min_questions'] }">
                    <label for="min_questions" class="col-md-3 pr-0 col-form-label">Min questions <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input
                                type="number"
                                class="form-control"
                                name="min_questions"
                                placeholder="Enter Min questions *"
                                :value="item.min_questions"
                                @input="updateMin_questions"
                                min="0"
                        >
                        <bootstrap-error :name="'min_questions'" v-if="errors && errors['min_questions']"/>
                    </div>
                </div>
                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['max_questions'] }">
                    <label for="max_questions" class="col-md-3 pr-0 col-form-label">Max questions <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input
                                type="number"
                                class="form-control"
                                name="max_questions"
                                placeholder="Enter Max questions *"
                                :value="item.max_questions"
                                @input="updateMax_questions"
                                min="0"
                        >
                        <bootstrap-error :name="'max_questions'" v-if="errors && errors['max_questions']"/>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <vue-button-spinner
                        class="btn btn-primary btn-sm"
                        :isLoading="loading"
                        :disabled="loading"
                >
                    Save
                </vue-button-spinner>
            </div>
        </div>
    </form>
</template>


<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data() {
            return {
                // Code...
            }
        },
        computed: {
            ...mapGetters('ExamSectionSubjectMappingsSingle', ['item', 'loading', 'chaptersAll', 'topicsAll', 'subtopicsAll', 'examsectionsAll']),
            ...mapGetters('Alert', ['errors'])
        },
        props:['section'],
        created() {
            this.resetState()
            //this.fetchExamsectionsAll()
        },
        mounted() {
            let context = this;
            context.fetchExamsectionsAll();
            context.fetchChaptersAll();
            context.fetchTopicsAll();
            context.fetchSubTopicsAll();
        },
        destroyed() {
            this.resetState()
        },
        methods: {
            ...mapActions('ExamSectionSubjectMappingsSingle', ['storeData','updateData', 'resetState', 'setExam_section', 'setMin_questions', 'setMax_questions', 'setChapter', 'setTopic', 'setSubTopic', 'fetchExamsectionsAll', 'fetchChaptersAll', 'fetchTopicsAll', 'fetchSubTopicsAll','setExam_section_id']),
            updateExam_section(value) {
                this.setExam_section(value)
            },
            updateExam_section_id(value) {
                this.setExam_section_id(value)
            },
            updateMin_questions(e) {
                this.setMin_questions(e.target.value)
            },
            updateMax_questions(e) {
                this.setMax_questions(e.target.value)
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
                let vm = this;
                this.updateData()
                    .then(() => {
                        //this.$router.push({ name: 'exam_section_subject_mappings.index' })
                        vm.$emit('dataUpdated',vm.item.exam_section);
                        this.$eventHub.$emit('create-success')
                    })
                    .catch((error) => {
                        console.error(error)
                    })
            }
        }
    }
</script>


<style scoped>

</style>
