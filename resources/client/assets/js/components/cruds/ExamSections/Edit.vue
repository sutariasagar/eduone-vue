<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Exam sections</h1>
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
                                    <label for="title">Title *</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="title"
                                            placeholder="Enter Title *"
                                            :value="item.title"
                                            @input="updateTitle"
                                            >
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
                                <div class="form-group">
                                    <label for="timer">Timer *</label>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="timer"
                                                    :value="item.timer"
                                                    :checked="item.timer === 'question_wise'"
                                                    @change="updateTimer('question_wise')"
                                                    >
                                            Question wise
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                    type="radio"
                                                    name="timer"
                                                    :value="item.timer"
                                                    :checked="item.timer === 'section_wise'"
                                                    @change="updateTimer('section_wise')"
                                                    >
                                            Section wise
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                    type="checkbox"
                                                    name="is_subsection"
                                                    :value="item.is_subsection"
                                                    :checked="item.is_subsection == true"
                                                    @change="updateIs_subsection"
                                                    >
                                            Is Subsection *
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="min_time">Min time</label>
                                    <input
                                            type="number"
                                            class="form-control"
                                            name="min_time"
                                            placeholder="Enter Min time"
                                            :value="item.min_time"
                                            @input="updateMin_time"
                                            min="0"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="max_time">Max time</label>
                                    <input
                                            type="number"
                                            class="form-control"
                                            name="max_time"
                                            placeholder="Enter Max time"
                                            :value="item.max_time"
                                            @input="updateMax_time"
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
        ...mapGetters('ExamSectionsSingle', ['item', 'loading']),
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
        ...mapActions('ExamSectionsSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setMin_questions', 'setMax_questions', 'setTimer', 'setIs_subsection', 'setMin_time', 'setMax_time']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateMin_questions(e) {
            this.setMin_questions(e.target.value)
        },
        updateMax_questions(e) {
            this.setMax_questions(e.target.value)
        },
        updateTimer(value) {
            this.setTimer(value)
        },
        updateIs_subsection(e) {
            this.setIs_subsection(e.target.checked)
        },
        updateMin_time(e) {
            this.setMin_time(e.target.value)
        },
        updateMax_time(e) {
            this.setMax_time(e.target.value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'exam_sections.index' })
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
