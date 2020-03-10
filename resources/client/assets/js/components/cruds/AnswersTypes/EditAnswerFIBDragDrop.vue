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
                            v-model="item.answer_details.fib_drag_drop.answers[blankIndex]"
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
        name: "AnswerFIBDragDrop",

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
                if(this.item && this.item.answer_details && this.item.answer_details.fib_drag_drop && this.item.answer_details.fib_drag_drop.answers) {
                    answers = JSON.parse(JSON.stringify(this.item.answer_details.fib_drag_drop.answers));
                }
                for(let i = 0; i < this.blankCount; i++) {
                    if(!answers[i]) {
                        answers[i] = "";
                    }
                }
                this.setAnswerDetailsByKey({
                    key: 'fib_drag_drop',
                    value: {answers: JSON.parse(JSON.stringify(answers))}
                })

            },
            "item.question_details.fib_drag_drop.suggestions": function() {
                let list = [];
                if(this.item && this.item.question_details && this.item.question_details.fib_drag_drop && this.item.question_details.fib_drag_drop.suggestions) {
                    _.forEach(this.item.question_details.fib_drag_drop.suggestions, function(suggestion) {
                        list.push(suggestion.text);
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
