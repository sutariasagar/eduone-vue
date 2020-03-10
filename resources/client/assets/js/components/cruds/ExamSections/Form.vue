<template>
    <form @submit.prevent="submitForm" novalidate>

        <div class="box">

            <div class="box-body" >
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['min_questions'] }">
                            <label for="min_questions" class="col-md-12 col-form-label">
                                Min Questions
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input
                                        type="number"
                                        class="form-control"
                                        name="min_questions"
                                        placeholder="Enter Min questions *"
                                        :value="item[section.type].min_questions"
                                        @input="updateMin_questions"
                                        min="0">

                                <bootstrap-error :name="'min_questions'" v-if="errors && errors['min_questions']"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['max_questions'] }">
                            <label for="max_questions" class="col-md-12 col-form-label">
                                Max Questions
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input
                                        type="number"
                                        class="form-control"
                                        name="max_questions"
                                        placeholder="Enter Max questions *"
                                        :value="item[section.type].max_questions"
                                        @input="updateMax_questions"
                                        min="0">

                                <bootstrap-error :name="'max_questions'" v-if="errors && errors['max_questions']"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['timer'] }">
                            <label for="timer" class="col-md-12 col-form-label">
                                Timer
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <label class="cui-utils-control cui-utils-control-radio mr-2">
                                            Question wise
                                            <input
                                                    type="radio"
                                                    name="timer"
                                                    :value="item[section.type].timer"
                                                    :checked="item[section.type].timer === 'question_wise'"
                                                    @change="updateTimer('question_wise')"
                                            >
                                            <span class="cui-utils-control-indicator"></span>
                                        </label>
                                    </div>
                                    <div class=" col-md-6 pl-0">
                                        <label class="cui-utils-control cui-utils-control-radio">
                                            Section wise
                                            <input
                                                    type="radio"
                                                    name="timer"
                                                    :value="item[section.type].timer"
                                                    :checked="item[section.type].timer === 'section_wise'"
                                                    @change="updateTimer('section_wise')"
                                            >
                                            <span class="cui-utils-control-indicator"></span>
                                        </label>
                                    </div>

                                </div>

                                <bootstrap-error :name="'timer'" v-if="errors && errors['timer']"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['min_time'] }">
                            <label for="min_time" class="col-md-12 col-form-label">
                                Min Time
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input
                                        type="number"
                                        class="form-control"
                                        name="min_questions"
                                        placeholder="Enter Min Time *"
                                        :value="item[section.type].min_time"
                                        @input="updateMin_time"
                                        min="0">

                                <bootstrap-error :name="'min_time'" v-if="errors && errors['min_time']"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['max_time'] }">
                            <label for="max_time" class="col-md-12 col-form-label">
                                Max Time
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input
                                        type="number"
                                        class="form-control"
                                        name="min_questions"
                                        placeholder="Enter Max Time *"
                                        :value="item[section.type].max_time"
                                        @input="updateMax_time"
                                        min="0">

                                <bootstrap-error :name="'max_time'" v-if="errors && errors['max_time']"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group  mt-2">
                            <label  class="col-md-12 col-form-label">

                            </label>
                            <div class="col-md-12">
                                <vue-button-spinner
                                        class="btn btn-purple mr-2 mb-2"
                                        :isLoading="loading"
                                        :disabled="loading"
                                >
                                    Update
                                </vue-button-spinner>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="pool && pool != 'static'">
        <b-button class="btn btn-icon btn-purple btn-rounded m-2 top-buttons pull-right child-exam-section-button" @click="showExamSectionSubjectForm">
            <i class="icmn-plus "></i>
        </b-button>
        <custom-data-table :ref="section.type" class="table table-responsive" :columns="columns" :url="'/api/v1/exam-section-subject-mappings?exam_section_id='+section.id" :id="'sectionDataTable'+section.type" :load="true" :xprops="xprops" :childButtons="true"></custom-data-table>
        </div>
    </form>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'

    var context;
    export default {
        components:{
        },
        data() {
            return {
                xprops: {
                    module: 'ExamSectionSubjectMappingsIndex',
                    route: 'exam_section_subject_mappings',
                    permission_prefix: 'exam_section_subject_mappings_',
                    eventbus: new Vue()
                },
                columns: [
                    {data: 'id', name: 'id', label: "Id", group: 'basic', visible:false},
                    {data: 'chapter', name: 'chapter.title',label: 'Chapter', searchable: true, group: 'basic',},
                    {data: 'topic', label: 'Topic', name: 'topic.title', sortable: true,group: 'advanced', orderable: "false",searchable: true,visible:false },
                    {data: 'subtopic', label: 'Sub Topic', name: 'subtopic.title', sortable: true,group: 'advanced', orderable: "false",searchable: true,visible:false },
                    {data: 'min_questions', label: 'Min Questions', name: 'min_questions', sortable: true,group: 'advanced', orderable: "false",searchable: true, },
                    {data: 'max_questions', label: 'Max Questions', name: 'max_questions', sortable: true,group: 'advanced', orderable: "false",searchable: true },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        name: 'action',
                        group: 'basic',
                        label: "Action",
                        visible: 'true',
                        "render": function (data, type, row, meta) {

                            let id = row.id;
                            var div = $("<div></div>");
                            div.addClass('btn-group btn-group-xs');


                            if (ability.can(context.xprops.permission_prefix + 'edit')) {
                                let anchor = $('<a></a>');
                                anchor.attr('href', 'javascript:void(0)');
                                anchor.attr('editid', id);
                                anchor.append('<i class="fa fa-pencil"></i>');
                                anchor.addClass('btn btn-icon btn-purple btn-rounded mr-2 mb-2 custom-edit-section-button')
                                div.append(anchor)
                            }
                            if (ability.can(context.xprops.permission_prefix + 'delete')) {
                                let anchor = $('<a></a>');
                                anchor.attr('href', 'javascript:void(0)');
                                anchor.attr('deleteid', id);
                                anchor.append('<i class="fa fa-trash"></i>');
                                anchor.addClass('btn btn-icon btn-pink btn-rounded mr-2 mb-2 custom-delete')
                                div.append(anchor)
                            }
                            return div.html()

                        },
                        "className": "action",
                    }
                ],
            }
        },
        props:['section','sectionid','pool'],
        computed: {
            ...mapGetters('ExamSectionsMultiple', ['item', 'loading']),
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            // Code ...
            //this.$eventHub.$on('rules-update', this.showTable)
        },
        mounted() {
            context = this;
            context.insertItem();
            //console.log(this.$refs);
            //context.updateTitle(this.section);
        },
        destroyed() {
            this.resetState()
        },
        methods: {
            ...mapActions('ExamSectionsMultiple', ['storeData', 'resetState', 'setTitle', 'setMin_questions', 'setMax_questions', 'setTimer', 'setIs_subsection', 'setMin_time', 'setMax_time', 'setItem','createItem']),
            ...mapActions('ExamSectionSubjectMappingsIndex', ['fetchData', 'setQuery', 'resetState']),

            insertItem(){
                let item = {
                    id: this.section.id,
                    title: this.section.title,
                    type: this.section.type,
                    min_questions: this.section.min_questions,
                    max_questions: this.section.max_questions,
                    timer: this.section.timer,
                    is_subsection: this.section.is_subsection,
                    min_time: this.section.min_time,
                    max_time: this.section.max_time,
                }
                this.updateItem(item);
            },
            updateItem(item){
                this.createItem(item);
            },
            updateTitle(value) {
                this.setTitle(value)
            },
            updateMin_questions(e) {
                this.setMin_questions({value: e.target.value, section: this.section})
            },
            updateMax_questions(e) {
                this.setMax_questions({value: e.target.value, section: this.section})
            },
            updateTimer(value) {
                this.setTimer({value: value, section: this.section})
            },
            updateIs_subsection(e) {
                this.setIs_subsection({value: e.target.checked, section: this.section})
            },
            updateMin_time(e) {
                this.setMin_time({value: e.target.value, section: this.section})
            },
            updateMax_time(e) {
                this.setMax_time({value: e.target.value, section: this.section})
            },
            submitForm() {
                this.storeData(this.section)
                    .then(() => {
                        //this.$router.push({ name: 'exam_sections.index' })
                        this.$eventHub.$emit('create-success')
                    })
                    .catch((error) => {
                        console.error(error)
                    })
            },
            hideModal() {
                this.$refs.myModalRef.hide()
            },
            showExamSectionSubjectForm(){
                this.$emit('showForm', this.section);
            },

            reloadDataTable(){
                this.$refs[this.section.type].reloadDataTable();
            }
        }
    }
</script>


<style scoped>
.child-exam-section-button{
    position:absolute;
    float: right;
    left: 84%;
}
</style>