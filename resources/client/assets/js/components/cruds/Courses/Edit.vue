<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Update Course</strong>
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
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['description'] }">
                                        <label for="description" class="col-md-3 col-form-label">Description *</label>
                                        <div class="col-md-9">
                                            <vue-ckeditor
                                                :id="'description'"
                                                name="description"
                                                placeholder="Enter Description *"
                                                :value="item.description"
                                                @input="updateDescription"
                                                :config="config"
                                                 autocomplete="off"
                                            />
                                            <bootstrap-error :name="'description'" v-if="errors && errors['description']"/>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['industry'] }">
                                        <label for="industry" class="col-md-3 col-form-label">Product *</label>
                                        <div class="col-md-9">
                                            <v-select
                                                    name="industry"
                                                    label="title"
                                                    @input="updateIndustry"
                                                    :value="item.industry"
                                                    :options="industriesAll"
                                                     autocomplete="off"
                                            />
                                            <bootstrap-error :name="'industry'" v-if="errors && errors['industry']"/>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['credit'] }">
                                        <label for="credit" class="col-md-3 col-form-label">Credit *</label>
                                        <div class="col-md-9">
                                            <input
                                                type="number"
                                                class="form-control"
                                                name="credit"
                                                placeholder="Enter Credit *"
                                                :value="item.credit"
                                                @input="updateCredit"
                                                 autocomplete="off"
                                                min="0"
                                            >
                                            <bootstrap-error :name="'credit'" v-if="errors && errors['credit']"/>
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
                <div class="card card-with-shadow custom-sidebar pt-3 p-3">
                    <item-changes :item="item"></item-changes>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'
import ckeditorConfig from '../../../config/ckeditor.json';
import formSkeleton from '../../utils/skeleton/Form.vue';

export default {
    data() {
        return {
            // Code...
            config: ckeditorConfig,
            showSummary: false,
            loadTables: false

        }
    },
    computed: {
        ...mapGetters('CoursesSingle', ['item', 'loading', 'industriesAll']),
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
        ...mapActions('CoursesSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setDescription', 'setIndustry', 'setCredit']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        showTable(){
                let app = this
                this.fetchData(this.$route.params.id).then(function(){
                    app.loadTables = true;
                });
        },
        updateDescription(value) {
            this.setDescription(value)
        },
        updateIndustry(value) {
            this.setIndustry(value)
        },
        updateCredit(e) {
            this.setCredit(e.target.value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'courses.index' })
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
