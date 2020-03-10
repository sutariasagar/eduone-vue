<template>
    <draggable tag="ul" :list="list" class="list-group">
        <li class="list-group-item" v-for="(suggestion, index) in list" :key="index">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <input
                                type="checkbox"
                                :id="'mcq_multiple_option_chosen' + index"
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
        name: "AnswerMCQMultipleOption",

        components: { draggable },

        props: [],

        data() {
            return {
                list: [
                    {
                        text: "",
                        chosen: false
                    }
                ],
                answer:[]
            };
        },
        watch:{
            "item.question_details.mcq_multiple_option.suggestions": function (value) {
                this.list = JSON.parse(JSON.stringify(value));
            },
            "list": function (value) {
                console.log("in ordered list answers",this.item.answer_details);
                this.setAnswerDetailsByKey({'key':'mcq_multiple_option','value':this.list})
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

                let list = JSON.parse(JSON.stringify(this.list));
                list[index].chosen = e.target.checked;
                this.$set(this, "list", JSON.parse(JSON.stringify(list)))
            },
        }

    };
</script>
