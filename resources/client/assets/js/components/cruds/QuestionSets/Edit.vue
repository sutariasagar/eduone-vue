<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Update Question Set</strong>
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
                            </div>
                            <div v-if="item.id">
                                <b-tabs content-class="mt-3">

                                    <b-tab :title="section.title"  v-for="section in sectionsAll" v-bind:key="section.id">
                                        <p class="text-center" v-if="item.selectedQuestions && item.selectedQuestions[section.id].length > 0">{{item.selectedQuestions[section.id].length}} records selected</p>
                                        <custom-data-table :parentId="item.id"  :selectedRows="JSON.parse(JSON.stringify(item.selectedQuestions[section.id]))" :section="section.id" @change=storeSelectedQuestions @remove=storeSelectedQuestions :columns="columns" :childButtons=true :url="'/api/v1/questions-banks?section_type='+section.id" :id="'QuestionSetDataTable_'+section.id" :load="loadTables" :xprops="xprops" :multiselect="true"></custom-data-table>
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
                                    </b-tab>

                                </b-tabs>
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
import { mapGetters, mapActions } from 'vuex'
import formSkeleton from '../../utils/skeleton/Form.vue'

var context;
export default {
    data() {
        return {
            showSummary: false,
            xprops: {
                module: 'QuestionsBanksIndex',
                route: 'questions_banks',
                permission_prefix: 'questions_bank_',
                eventbus: new Vue()
            },
            selected:'all',
            columns: [
                {data:'id', name: 'id', label: "Id", group: 'basic', visible:true},
                {data:'title', name: 'title', searchable: true, label: "Title", group: 'basic'},
                {data:'header', name: 'header',searchable: true, label: 'Header', sortable: true,group: 'advanced', visible:false},
                {data:'include_in_practice_set', name: 'include_in_practice_set',searchable: true, label: 'Included in Practice set',  sortable: true ,group: 'advanced'},
                {data:'max_score', name: 'max_score',searchable: true, label: 'Max score',  sortable: true ,group: 'advanced'},
                {data:'preparation_time', name: 'preparation_time', searchable: true,label: 'Preparation time',  sortable: true,group: 'advanced', visible:true },
                {data:'count', name: 'count', searchable: true,label: 'Counts',  sortable: true,group: 'advanced', visible:true },
                {data:'attempt_time', name: 'attempt_time',searchable: true, label: 'Attempt time', sortable: true ,group: 'advanced', visible:false},
                {data:'status', name: 'status',searchable: true, label: 'Status', sortable: true ,group: 'advanced', visible:false},
                {data:'min_words', name: 'min_words', label: 'Min words', searchable: true, sortable: true ,group: 'advanced', visible:false},
                {data:'max_words', name: 'max_words', label: 'Max words',searchable: true,  sortable: true ,group: 'advanced', visible:false},
                {data:'question_type', name: 'question_type', label: 'Question type',searchable: true,group: 'advanced', visible:true},
                {data:'created_at', name: 'created_at', searchable: true, visible:false, label: "Created At", group: 'advanced'},
                {data:'updated_at', name: 'updated_at', searchable: true, visible:false, label: "Updated At", group: 'advanced'},
                {data:'created_by', name: 'created_by.name', searchable: true, visible:false, label: "Created By", group: 'advanced'},
                {data:'updated_by', name: 'updated_by.name', searchable: true, visible:false, label: "Updated By", group: 'advanced'},
            ],
            loadTables: false,
        }
    },
    components:{
        formSkeleton
    },
    computed: {
        ...mapGetters('QuestionSetsSingle', ['item','sectionsAll']),
        ...mapGetters('QuestionsBanksIndex', ['data', 'total', 'loading']),
        ...mapGetters('Alert', ['errors'])
    },
    created() {
        this.fetchData(this.$route.params.id)
        this.$eventHub.$on('rules-update', this.showTable)
        this.fetchSectionsAll();
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    destroyed() {
        this.resetState()
        this.questionIndexResetState();
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.questionIndexResetState();
            this.fetchData(this.$route.params.id)

        },
        query: {
            handler(query) {
                this.setQuery(query)
            },
            deep: true
        }
    },
    mounted() {
        context = this;
    },
    methods: {
        ...mapActions('QuestionSetsSingle', ['fetchData', 'updateData', 'resetState', 'setTitle','fetchSectionsAll','setSelectedQuestions']),
        ...mapActions('QuestionsBanksIndex', ['setQuery', 'questionIndexResetState']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        showTable() {
            this.loadTables = true;
        },
        storeSelectedQuestions(selectedIds){
            //console.log("checking in question set create",selectedIds);
            this.setSelectedQuestions(selectedIds);
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'question_sets.index' })
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
