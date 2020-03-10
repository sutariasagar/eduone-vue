<template>
    <draggable tag="ul" :list="item.answer_details.mcq_multiple_option" class="list-group" v-if="item.answer_details.mcq_multiple_option">
        <li class="list-group-item" v-for="(suggestion, index) in item.answer_details.mcq_multiple_option" :key="index">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <input
                                type="checkbox"
                                :id="'mcq_multiple_option_chosen' + index"
                                :checked="suggestion.chosen"
                                @change="change($event, index)"

                        >
                    </span>
                </div>
                <label> {{suggestion.text}}</label>
            </div>
        </li>
    </draggable>
</template>
<style scoped="">
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    import draggable from "vuedraggable";

    export default {
        name: "EditAnswerMCQMultipleOption",

        components: { draggable },

        props: [],

        data() {
            return {
                list: [{

                }],
                answer:[]
            };
        },
        watch:{
            "item.question_details.mcq_multiple_option.suggestions": function (value) {
                //this.list = JSON.parse(JSON.stringify(value));
                this.setAnswerDetailsByKey({'key':'mcq_multiple_option','value':JSON.parse(JSON.stringify(value))})
            },
            "list": function (value) {
                console.log("in ordered list answers",this.list);
                //this.setAnswerDetailsByKey({'key':'mcq_multiple_option','value':this.list})
            }
        },
        computed:{
            ...mapGetters("QuestionsBanksSingle", [
                "item"
            ]),
        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setAnswerDetailsByKey"
            ]),
            sorted: function (evt) {

            },
            change: function (e, index) {

                let list = JSON.parse(JSON.stringify(this.item.answer_details.mcq_multiple_option));
                list[index].chosen = e.target.checked;
                this.setAnswerDetailsByKey({'key':'mcq_multiple_option','value':list});

            },
        }

    };
</script>
