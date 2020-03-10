<template>
    <draggable tag="ul" :list="item.question_details.mcq_multiple_option.suggestions" class="list-group">
        <li class="list-group-item" v-for="(suggestion, index) in item.question_details.mcq_multiple_option.suggestions" :key="index">
            <template>
                <div class="input-group">
                    <input
                            type="text"
                            :id="'mcq_multiple_option_input' + index"
                            :name="'mcq_multiple_option_chosen' + index"
                            :value="suggestion.text"
                            autocomplete="off"
                            class="form-control"
                            placeholder="Enter text here"
                            :ref="'mcq_multiple_option_input' + index"
                            @change="suggestionsChanged($event, index)"
                    >
                    <div class="input-group-append">
                    <span class="input-group-text">
                        <span class="pull-right">
                            <i class="fa fa-trash-o" @click="removeItem(index)">&nbsp;</i>
                        </span>
                    </span>
                    </div>
                </div>
            </template>
        </li>
        <div

                slot="footer"
                class="btn-group list-group-item"
                role="group"
                aria-label="Basic example"
                key="footer"
        >
            <button class="btn btn-secondary" @click="addItemInList()" type="button">Add</button>
        </div>
    </draggable>
</template>
<style scoped="">
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    import draggable from "vuedraggable";

    export default {
        name: "EditMCQMultipleOption",

        components: {draggable},

        props: ['type', 'suggestions'],

        data() {
            return {
                list: [
                ]
            };
        },
        mounted(){
            //this.addItemInList()
        },
        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
            ])

        },
        watch: {
            list: function () {
                //this.setQuestionDetailsByKey({key: 'mcq_multiple_option', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setQuestionDetailsByKey",
            ]),

            addItemInList: function () {
                let list = JSON.parse(JSON.stringify(this.item.question_details.mcq_multiple_option.suggestions));
                list.push({text: "", chosen: false});
                console.log(list);
                //this.$set(this, "list", list);
                this.setQuestionDetailsByKey({key: 'mcq_multiple_option', value: {suggestions: JSON.parse(JSON.stringify(list))}})
            },
            removeItem: function (index) {
                let list = JSON.parse(JSON.stringify(this.item.question_details.mcq_multiple_option.suggestions));
                if (list && list[index]) {
                    list.splice(index, 1);
                }
                this.setQuestionDetailsByKey({key: 'mcq_multiple_option', value: {suggestions: JSON.parse(JSON.stringify(list))}})
                //this.$set(this, "list", list);
            },
            suggestionsChanged: function(e, index) {

                let list = JSON.parse(JSON.stringify(this.item.question_details.mcq_multiple_option.suggestions));
                list[index].text = e.target.value;
                //this.setAnswerDetailsByKey({'key':'mcq_multiple_option','value':list});

                this.setQuestionDetailsByKey({key: 'mcq_multiple_option', value: {suggestions: JSON.parse(JSON.stringify(list))}})
            }
        }
    };
</script>
