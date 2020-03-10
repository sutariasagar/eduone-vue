<template>
    <div>
        <draggable tag="ul" :list="list" class="list-group" v-for="(suggestionList, blankIndex) in item.blankCount"
                   :key="blankIndex">
            <div class="form-group row">
                <div class="col-md-9">
                    <input
                            :label="'Answer for Blank # ' + (blankIndex + 1)"
                            :name="'answer_blank_' + (blankIndex + 1)"
                            :placeholder="'Answer for Blank # ' + (blankIndex + 1)"
                            v-model="item.answer_details.fib_no_options.answers[blankIndex]"
                            :options="list"
                            autocomplete="off"
                            class="form-control w-100"
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
        name: "AnswerFIBNoOptions",

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
                if(this.item && this.item.answer_details && this.item.answer_details.fib_no_options && this.item.answer_details.fib_no_options.answers) {
                    answers = JSON.parse(JSON.stringify(this.item.answer_details.fib_no_options.answers));
                }
                for(let i = 0; i < this.blankCount; i++) {
                    if(!answers[i]) {
                        answers[i] = "";
                    }
                }
                this.setAnswerDetailsByKey({
                    key: 'fib_no_options',
                    value: {answers: JSON.parse(JSON.stringify(answers))}
                })

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
