<template>
    <div>
        <draggable tag="ul" :list="list" class="list-group">
            <li class="list-group-item" v-for="(suggestion, index) in list" :key="index">

                <div class="input-group">

                    <label>{{list[index].text}}</label>
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
        name: "AnswerOrderedText",

        components: {draggable},

        props: [],

        data() {
            return {
                list: [],
                checked: true
            };
        },
        watch: {
            "item.question_details.ordered_text.suggestions": function () {
                this.$set(this, 'list', JSON.parse(JSON.stringify(this.item.question_details.ordered_text.suggestions)));
            },
            "list": function () {
                this.setAnswerDetailsByKey({key: 'ordered_text', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
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
