<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Exam section subject mapping</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm" novalidate>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exam_section">Exam section *</label>
                                    <v-select
                                            name="exam_section"
                                            label="title"
                                            @input="updateExam_section"
                                            :value="item.exam_section"
                                            :options="examsectionsAll"
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="min_questions">Min questions *</label>
                                    <input
                                            type="number"
                                            class="form-control"
                                            name="min_questions"
                                            placeholder="Enter Min questions *"
                                            :value="item.min_questions"
                                            @input="updateMin_questions"
                                            min="0"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="max_questions">Max questions *</label>
                                    <input
                                            type="number"
                                            class="form-control"
                                            name="max_questions"
                                            placeholder="Enter Max questions *"
                                            :value="item.max_questions"
                                            @input="updateMax_questions"
                                            min="0"
                                            >
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
                </div>
            </div>
        </section>
    </section>
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
        ...mapGetters('ExamSectionSubjectMappingsSingle', ['item', 'loading', 'examsectionsAll']),
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
        ...mapActions('ExamSectionSubjectMappingsSingle', ['fetchData', 'updateData', 'resetState', 'setExam_section', 'setMin_questions', 'setMax_questions']),
        updateExam_section(value) {
            this.setExam_section(value)
        },
        updateMin_questions(e) {
            this.setMin_questions(e.target.value)
        },
        updateMax_questions(e) {
            this.setMax_questions(e.target.value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'exam_section_subject_mappings.index' })
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
