<template>
    <div>
        <draggable tag="ul" :list="list" class="list-group">
            <div class="form-group row">
                <div class="col-md-9">
                    <v-select
                            label="text"
                            :name="'answer_MCQ'"
                            :placeholder="'Answer for MCQ '"
                            v-model="answer"
                            :options="list"
                            autocomplete="off"
                    />
                </div>
            </div>
        </draggable>
    </div>
</template>
<style scoped="">
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    import draggable from "vuedraggable";

    export default {
        name: "AnswerMCQSingleOption",

        components: {draggable},

        props: [],

        data() {
            return {
                list: [],
                checked: true,
                answer: ""
            };
        },
        mounted(){
            this.$set(this, 'list', JSON.parse(JSON.stringify(this.item.question_details.mcq_single_option.suggestions)));
            this.$set(this, 'answer',JSON.parse(JSON.stringify(this.item.answer_details.mcq_single_option)));
        },
        watch: {
            "item.question_details.mcq_single_option.suggestions": function() {
                this.$set(this, 'list', JSON.parse(JSON.stringify(this.item.question_details.mcq_single_option.suggestions)));
            },
            "answer": function(){
                this.setAnswerDetailsByKey({key: 'mcq_single_option', value: this.answer})
            },

        },
        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item"
            ]),
        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setAnswerDetailsByKey"
            ])
        }
    };
</script>
