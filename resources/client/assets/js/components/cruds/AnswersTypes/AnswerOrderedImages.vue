<template>
    <draggable tag="ul" :list="list" class="list-group">
        <li class="list-group-item" v-for="(suggestion, index) in list" :key="index">
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
        name: "AnswerOrderedImages",

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

            "list": function () {
                this.setAnswerDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        },
        mounted(){
            let context = this;
          console.log("mounted");

          bus.$on("ordered_images_changed", function () {
              context.$set(context, 'list', JSON.parse(JSON.stringify(context.item.question_details.ordered_images.suggestions)));
          });
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
