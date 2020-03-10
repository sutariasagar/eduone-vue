<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> Clone Exam</strong>
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
                                                    <div class="row">
                                                        <div class="col-md-12 text-right mb-2">
                                                            <toggle-button @change="updateStatus" :value="true" :width="85" color="#4949e3" :height="33" :labels="{checked: 'Active', unchecked: 'Inactive'}"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Exam Title <span
                                                            class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="examtitle"
                                                                placeholder="Enter Exam Title *"
                                                                :value="item.title"
                                                                @input="updateTitle"
                                                            ><bootstrap-error :name="'title'" v-if="errors && errors['title']"/>
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
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['question_pool'] }">
                                                        <div class="col-md-3">
                                                            <label for="question_pool">Question pool <span
                                                            class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                name="question_pool"
                                                                @input="updateQuestion_pool"
                                                                :value="item.question_pool"
                                                                :options="question_poolEnum"
                                                                label="label"
                                                            /><bootstrap-error :name="'question_pool'" v-if="errors && errors['question_pool']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-if="item.question_pool && item.question_pool.value == 'static'" v-bind:class="{ 'has-danger': errors && errors['question_set'] }">
                                                        <label for="question_set" class="col-md-3 col-form-label">Question Set <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                    label="title"
                                                                    name="question_set"
                                                                    placeholder="Enter Question Set *"
                                                                    :value="item.question_set"
                                                                    @input="updateQuestionSet"
                                                                    :options="questionSetsAll"
                                                                    autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'question_set'" v-if="errors && errors['question_set']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <div class="col-md-6" v-bind:class="{ 'has-danger': errors && errors['duration_min'] }">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="duration_min">Min Duration <span
                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="number"
                                                                        class="col-md-12 form-control"
                                                                        name="duration_min"
                                                                        placeholder="Enter Min Duration  *"
                                                                        :value="item.duration_min"
                                                                        @input="updateDurationMin"
                                                                        autocomplete="off"
                                                                        min="0"
                                                                    ><bootstrap-error :name="'duration_min'" v-if="errors && errors['duration_min']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" v-bind:class="{ 'has-danger': errors && errors['duration_max'] }">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="duration_max"> Max Duration<span
                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="number"
                                                                        class="col-md-12 form-control"
                                                                        name="duration_max"
                                                                        placeholder="Enter Max Duration  *"
                                                                        :value="item.duration_max"
                                                                        @input="updateDurationMax"
                                                                        autocomplete="off"
                                                                        min="0"
                                                                    ><bootstrap-error :name="'duration_max'" v-if="errors && errors['duration_max']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['start_instructions'] }">
                                                        <div class="col-md-3" >
                                                            <label for="start_instructions">Start instructions <span
                                                            class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <vue-ckeditor
                                                                name="start_instructions"
                                                                :id="'start_instructions'"
                                                                :value="item.start_instructions"
                                                                @input="updateStart_instructions"
                                                                :config="config"
                                                            /><bootstrap-error :name="'start_instructions'" v-if="errors && errors['start_instructions']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['end_instructions'] }">
                                                        <div class="col-md-3">
                                                            <label for="end_instructions">End instructions</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <vue-ckeditor
                                                                name="end_instructions"
                                                                :id="'end_instructions'"
                                                                :value="item.end_instructions"
                                                                @input="updateEnd_instructions"
                                                                :config="config"
                                                            /><bootstrap-error :name="'end_instructions'" v-if="errors && errors['end_instructions']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['exam_type'] }">
                                                        <div class="col-md-3">
                                                            <label for="exam_type">Exam Type</label>
                                                        </div>
                                                        <div class="col-md-9">


                                                            <v-select
                                                                label="label"
                                                                name="exam_type"
                                                                @input="updateExam_type"
                                                                :value="item.exam_type"
                                                                :options="exam_typeEnum"
                                                            /><bootstrap-error :name="'exam_type'" v-if="errors && errors['exam_type']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['can_see_solution'] }">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-9">
                                                            <label class="cui-utils-control cui-utils-control-checkbox">
                                                                Can See Solution
                                                                <input
                                                                    type="checkbox"
                                                                    name="can_see_solution"
                                                                    :value="item.can_see_solution"
                                                                    :checked="item.can_see_solution == true"
                                                                    @change="updateCan_see_solution"
                                                                    ><bootstrap-error :name="'can_see_solution'" v-if="errors && errors['can_see_solution']"/>
                                                                <span class="cui-utils-control-indicator"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-6" v-bind:class="{ 'has-danger': errors && errors['instruction_type'] }">
                                                            <label class="cui-utils-control cui-utils-control-radio">
                                                                Record Audio
                                                                Introduction
                                                                <input
                                                                type="radio"
                                                                name="instruction_type"
                                                                :value="item.instruction_type"
                                                                :checked="item.instruction_type === 'audio'"
                                                                @change="updateInstruction_type('audio')"
                                                                ><bootstrap-error :name="'instruction_type'" v-if="errors && errors['instruction_type']"/>
                                                                <span class="cui-utils-control-indicator"></span>
                                                            </label>
                                                            </div>
                                                            <div class="col-md-6" v-bind:class="{ 'has-danger': errors && errors['course'] }">
                                                            <label class="cui-utils-control cui-utils-control-radio ">
                                                                Record Video
                                                                Introduction
                                                                <input
                                                                type="radio"
                                                                name="instruction_type"
                                                                :value="item.instruction_type"
                                                                :checked="item.instruction_type === 'video'"
                                                                @change="updateInstruction_type('video')"
                                                                ><bootstrap-error :name="'end_instructions'" v-if="errors && errors['end_instructions']"/>
                                                                <span class="cui-utils-control-indicator"></span>
                                                            </label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer  mt-5">
                                                    <vue-button-spinner
                                                            class="btn btn-purple mr-2 mb-2"
                                                            :isLoading="loading"
                                                            :disabled="loading"
                                                            >
                                                        CLONE
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
                    <div class="" >
                        <div class="card-body" v-if="item.speakingsection && item.speakingsection.id">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">

                                        <custom-collapse-heading heading="Speaking" to='speaking'></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="speaking">
                                            <section-form :pool="item.question_pool.value" :loadSectionTable="loadTables" :ref="item.speakingsection.type" v-on:showForm="showSectionSubjectFormModal" :section="item.speakingsection" :sectionid="item.speakingsection.id"></section-form>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body"  v-if="item.writingsection && item.writingsection.id">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">

                                        <custom-collapse-heading heading="Writing" to='writing'></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="writing">
                                            <section-form :pool="item.question_pool.value" :loadSectionTable="loadTables" :ref="item.writingsection.type" v-on:showForm="showSectionSubjectFormModal" :section="item.writingsection" :sectionid="item.writingsection.id"></section-form>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" v-if="item.readingsection && item.readingsection.id">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">

                                        <custom-collapse-heading heading="Reading" to='reading'></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="reading">
                                            <section-form :pool="item.question_pool.value" :loadSectionTable="loadTables" :ref="item.readingsection.type" v-on:showForm="showSectionSubjectFormModal" :section="item.readingsection" :sectionid="item.readingsection.id"></section-form>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" v-if="item.listeningsstsection && item.listeningsstsection.id">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">

                                        <custom-collapse-heading heading="Listening (SST)" to='listeningsstsection'></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="listeningsstsection">
                                            <section-form :pool="item.question_pool.value" :loadSectionTable="loadTables" :ref="item.listeningsstsection.type" v-on:showForm="showSectionSubjectFormModal" :section="item.listeningsstsection" :sectionid="item.listeningsstsection.id"></section-form>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" v-if="item.listeningrolsection && item.listeningrolsection.id">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">

                                        <custom-collapse-heading heading="Listening (ROL)" to='listeningrolsection'></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="listeningrolsection">
                                            <section-form :pool="item.question_pool.value" :loadSectionTable="loadTables" :ref="item.listeningrolsection.type" v-on:showForm="showSectionSubjectFormModal" :section="item.listeningrolsection" :sectionid="item.listeningrolsection.id"></section-form>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div>
                        <b-modal ref="examSectionSubjectModal" :hide-footer='true' header-class='custom-sidebar-no-hover' centered id="examsectionsubjectmodal" ok-title="Save" button-size="sm" :title="currentSection ? currentSection.type : ''">
                                <div v-if="currentSection">
                                    <exam-section-subject-form v-on:dataAdded="sectionSubjectDataAdded" :section="currentSection">

                                    </exam-section-subject-form>
                                </div>
                        </b-modal>
                    </div>

                    <div>
                        <b-modal ref="examSectionSubjectEditModal" :hide-footer='true' header-class='custom-sidebar-no-hover' centered id="examsectionsubjecteditmodal" ok-title="Save" button-size="sm">

                                <exam-section-subject-edit-form v-on:dataUpdated="sectionSubjectDataUpdated">

                                </exam-section-subject-edit-form>

                        </b-modal>
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
import ckeditorConfig from "../../../config/ckeditor.json";
import sectionForm from '../ExamSections/Form.vue';
import examSectionSubjectForm from '../ExamSectionSubjectMappings/ExamSectionSubjectForm.vue';
import examSectionSubjectEditForm from '../ExamSectionSubjectMappings/ExamSectionSubjectEditForm.vue';
var context;

export default {
    data() {
        return {
            // Code...
            config: ckeditorConfig,
            currentSection: null,
            loadTables: false,
            showSummary: false
        }
    },
    computed: {
        ...mapGetters('ExamsSingle', ['item', 'loading','coursesAll', 'question_poolEnum','exam_typeEnum', 'statusEnum','questionSetsAll']),
        ...mapGetters('Alert', ['errors'])
    },
    components:{
        sectionForm,
        examSectionSubjectForm,
        examSectionSubjectEditForm
    },
    created() {
        //this.fetchData(this.$route.params.id)
        this.$eventHub.$on('rules-update', this.showTable)
        this.$eventHub.$on('edit-custom-data',this.showEditPopup)
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    mounted() {
        let context = this;
        context.fetchCoursesAll();
        context.fetchQuestionSetsAll();
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('ExamsSingle', ['fetchData', 'updateData','cloneData', 'resetState', 'setTitle','setCourse', 'setQuestion_pool', 'setTotal_marks', 'setPassing_marks', 'setDurationMin','setDurationMax', 'setStatus', 'setStart_instructions', 'setEnd_instructions', 'setExam_type', 'setSections_count', 'setCan_see_solution', 'setInstruction_type','fetchCoursesAll','fetchQuestionSetsAll','resetSubjectChapterForm','setSubjectChapterFormData','setQuestionSet']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateQuestionSet(value){
          this.setQuestionSet(value);
        },
        updateCourse(value) {
            this.setCourse(value)
        },
        updateQuestion_pool(value) {
            this.setQuestion_pool(value)
        },
        updateTotal_marks(e) {
            this.setTotal_marks(e.target.value)
        },
        updatePassing_marks(e) {
            this.setPassing_marks(e.target.value)
        },
        updateDurationMin(e) {
            this.setDurationMin(e.target.value);
        },
        updateDurationMax(e) {
            this.setDurationMax(e.target.value);
        },
        updateStatus(value) {
            this.setStatus(value)
        },
        updateStart_instructions(value) {
            this.setStart_instructions(value)
        },
        updateEnd_instructions(value) {
            this.setEnd_instructions(value)
        },
        updateExam_type(value) {
            this.setExam_type(value)
        },
        updateSections_count(e) {
            this.setSections_count(e.target.value)
        },
        updateCan_see_solution(e) {
            this.setCan_see_solution(e.target.checked)
        },
        updateInstruction_type(value) {
            this.setInstruction_type(value)
        },
        submitForm() {
            this.cloneData()
                .then(() => {
                    this.$router.push({ name: 'exams.index' })
                    this.$eventHub.$emit('create-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
        showSectionSubjectFormModal(value) {
            this.resetSubjectChapterForm();
            this.currentSection = value;
            this.$refs.examSectionSubjectModal.show();
        },
        sectionSubjectDataAdded(value) {
            this.$refs.examSectionSubjectModal.hide();
            this.$refs[value.type].reloadDataTable();
        },
        sectionSubjectDataUpdated(value) {
            this.$refs.examSectionSubjectEditModal.hide();
            this.$refs[value.type].reloadDataTable();
        },
        showTable() {

            this.loadTables = true;
            this.fetchData(this.$route.params.id)

        },
        showEditPopup(subjectId) {

            this.setSubjectChapterFormData(subjectId);
            //this.currentSection = value;
            this.$refs.examSectionSubjectEditModal.show();
        },
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
}
</script>


<style scoped>

</style>
