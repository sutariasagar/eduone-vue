<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Create New Subject</strong>
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
                                                    <label for="title" class="col-md-3 col-form-label">Title  <span class="text-danger">*</span></label>
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
                                                    <label for="course" class="col-md-3 col-form-label">Course  <span class="text-danger">*</span></label>
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
            ...mapGetters('SubjectsSingle', ['item', 'loading', 'coursesAll']),
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            this.$eventHub.$on('toggle-called', this.toggleColumns)
        },
        mounted() {
            let context = this;

            context.fetchCoursesAll();

        },
        destroyed() {
            this.resetState()
        },
        methods: {
            ...mapActions('SubjectsSingle', ['storeData', 'resetState', 'setTitle', 'setCourse', 'fetchCoursesAll']),
            updateTitle(e) {
                this.setTitle(e.target.value)
            },
            updateCourse(value) {
                this.setCourse(value)
            },
            submitForm() {
                this.storeData()
                    .then(() => {
                        this.$router.push({name: 'subjects.index'})
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
