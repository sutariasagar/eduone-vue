<template>
    <draggable tag="ul" :list="item.answer_details.ordered_images" class="list-group">
        {{item.answer_details}}
        <li class="list-group-item" v-for="(suggestion, index) in item.answer_details.ordered_images" :key="index">
            <label> {{ suggestion.url }}</label>
            <img :src="suggestion.url">
        </li>
    </draggable>
</template>
<style scoped="">
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    import draggable from "vuedraggable";
    import bus from "../../../bus";

    export default {
        name: "EditAnswerOrderedImages",

        components: {draggable},

        props: ['type', 'suggestions'],

        data() {
            return {
                list: [
                    {
                        chosen: "",
                        url: ""
                    }
                ]
            };
        },
        watch: {

            "item.question_details.ordered_images.suggestions": function (value) {
                console.log("checking here");
                this.setAnswerDetailsByKey({'key':'ordered_images','value':JSON.parse(JSON.stringify(value))})
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
