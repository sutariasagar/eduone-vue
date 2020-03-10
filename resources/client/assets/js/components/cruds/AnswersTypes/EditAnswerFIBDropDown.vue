<template>
    <div>
        <draggable tag="ul" :list="list" class="list-group" v-for="(suggestionList, blankIndex) in item.blankCount"
                   :key="blankIndex">
            <div class="form-group row">
                <div class="col-md-9">
                    <v-select
                            :label="'Answer for Blank # ' + (blankIndex + 1)"
                            :name="'answer_blank_' + (blankIndex + 1)"
                            :placeholder="'Answer for Blank # ' + (blankIndex + 1)"
                            v-model="item.answer_details.fib_dropdown.answers[blankIndex]"
                            :options="list[blankIndex]"
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
        name: "AnswerFIBDropdown",

        components: {draggable},

        props: [],

        data() {
            return {
                list: [],
                checked: true
            };
        },
        watch: {
            "item.blankCount": function () {
                let answers = [];
                if(this.item && this.item.answer_details && this.item.answer_details.fib_dropdown && this.item.answer_details.fib_dropdown.answers) {
                    answers = JSON.parse(JSON.stringify(this.item.answer_details.fib_dropdown.answers));
                }
                for(let i = 0; i < this.blankCount; i++) {
                    if(!answers[i]) {
                        answers[i] = "";
                    }
                }
                this.setAnswerDetailsByKey({
                    key: 'fib_dropdown',
                    value: {answers: JSON.parse(JSON.stringify(answers))}
                })

            },
            "item.question_details.fib_dropdown.suggestions": function() {
                let list = [];
                if(this.item && this.item.question_details && this.item.question_details.fib_dropdown && this.item.question_details.fib_dropdown.suggestions) {
                    _.forEach(this.item.question_details.fib_dropdown.suggestions, function(suggestions, index) {
                        if(!list[index]) list[index] = [];
                        _.forEach(suggestions, function(suggestion) {
                            list[index].push(suggestion.text);
                        })
                    })
                }
                this.$set(this, "list", JSON.parse(JSON.stringify(list)))
            }
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
