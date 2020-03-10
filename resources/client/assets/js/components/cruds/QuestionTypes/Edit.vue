<template>
    <div class="">

        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Update Question Type</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="col-lg-12 col-md-12">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information"></custom-collapse-heading>
                                    <custom-collapse-body>
                                         <form @submit.prevent="submitForm" novalidate>
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
                                            >
                                            <bootstrap-error :name="'title'"/>
                                    </div>
                                </div>
                                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['skill'] }">
                                    <label for="skill" class="col-md-3 col-form-label">Skill *</label>
                                    <div class="col-md-9">
                                    <v-select
                                            name="skill"
                                            label="title"
                                            @input="updateSkill"
                                            :value="item.skill"
                                            :options="skillsAll"
                                            />
                                            <bootstrap-error :name="'skill'"/>
                                    </div>
                                </div>
                                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['module_id'] }">
                                    <label for="module_id" class="col-md-3 col-form-label">Modules *</label>
                                    <div class="col-md-9">
                                    <v-select
                                            name="module_id"
                                            label="title"
                                            @input="updateModule_id"
                                            :value="item.module_id"
                                            :options="modulesAll"
                                            multiple
                                            />
                                            <bootstrap-error :name="'module_id'"/>
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
            <div class="col-md-3">
                <div class="card card-with-shadow custom-sidebar pt-3 p-3">
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
        }
    },
    computed: {
        ...mapGetters('QuestionTypesSingle', ['item', 'loading', 'skillsAll', 'modulesAll']),
        ...mapGetters('Alert', ['errors'])
    },
    created() {
        this.fetchData(this.$route.params.id)
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
        ...mapActions('QuestionTypesSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setSkill', 'setModule_id']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateSkill(value) {
            this.setSkill(value)
        },
        updateModule_id(value) {
            this.setModule_id(value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'question_types.index' })
                    this.$eventHub.$emit('update-success')
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
