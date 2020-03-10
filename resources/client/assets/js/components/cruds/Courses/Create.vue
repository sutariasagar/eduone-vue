<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Create New Course</strong>
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
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Title <span
                                                            class="text-danger">*</span></label>
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
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['description'] }">
                                                        <label for="description" class="col-md-3 col-form-label">Description <span
                                                            class="text-danger">*</span></label>
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
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['industry'] }">
                                                        <label for="industry" class="col-md-3 col-form-label">Product <span
                                                            class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="industry"
                                                                :value="item.industry"
                                                                @input="updateIndustry"
                                                                :options="industriesAll"
                                                                 autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'industry'" v-if="errors && errors['industry']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['credit'] }">
                                                        <label for="credit" class="col-md-3 col-form-label">Credit <span
                                                            class="text-danger">*</span></label>
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
    import {mapGetters, mapActions} from 'vuex'
    import ckeditorConfig from '../../../config/ckeditor.json';

    export default {
        data() {
            return {
                // Code...
                config: ckeditorConfig,
                showSummary: false

            }
        },
        props: {
            // item: Object
        },
        components: {},
        computed: {
            ...mapGetters('CoursesSingle', ['item', 'loading', 'industriesAll']),
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            this.$eventHub.$on('toggle-called', this.toggleColumns)
            //this.fetchIndustriesAll()
        },
        mounted() {
            let context = this;

            context.fetchIndustriesAll();
        },
        destroyed() {
            this.resetState()
        },
        methods: {
            ...mapActions('CoursesSingle', ['storeData', 'resetState', 'setTitle', 'setDescription', 'setIndustry', 'setCredit', 'fetchIndustriesAll']),
            updateTitle(e) {
                this.setTitle(e.target.value)
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
                this.storeData()
                    .then(() => {
                        this.$router.push({name: 'courses.index'})
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
