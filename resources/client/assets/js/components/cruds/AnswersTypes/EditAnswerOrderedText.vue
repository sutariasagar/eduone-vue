<template>
    <div>
        <draggable tag="ul" :list="item.answer_details.ordered_text" class="list-group">
            <li class="list-group-item" v-for="(suggestion, index) in item.answer_details.ordered_text" :key="index">

                <div class="input-group">

                    <label>{{suggestion.text}}</label>
                </div>
            </li>
        </draggable>
    </div>
</template>
<style scoped="">
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    import draggable from "vuedraggable";

    export default {
        name: "EditAnswerOrderedText",

        components: {draggable},

        props: [],

        data() {
            return {
                list: [],
                checked: true
            };
        },
        watch: {
            "item.question_details.ordered_text.suggestions": function (value) {
                this.setAnswerDetailsByKey({'key':'ordered_text','value':JSON.parse(JSON.stringify(value))})
            },
            "item.answer_details.ordered_text": function () {
                //let item = this.item.answer_details.ordered_text;
                //this.setAnswerDetailsByKey({'key':'ordered_text','value':JSON.parse(JSON.stringify(item))})
                //this.$set(this, 'list', JSON.parse(JSON.stringify(this.item.question_details.ordered_text.suggestions)));
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
            ]),
            change(list){
                console.log("this is moved", list)
            }

        }
    };
</script>
