<template>
    <draggable tag="ul" :list="item.question_details.mcq_single_option.suggestions" class="list-group">
        <li class="list-group-item" v-for="(suggestion, index) in item.question_details.mcq_single_option.suggestions" :key="index">
            <template>
                <div class="input-group">
                    <input
                            type="text"
                            :id="'ordered_text_input' + index"
                            :name="'ordered_text_chosen' + index"
                            autocomplete="off"
                            :value="suggestion.text"
                            class="form-control"
                            placeholder="Enter text here"
                            :ref="'ordered_text_input' + index"
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
        name: "EditMCQSingleOption",

        components: {draggable},

        props: ['type', 'suggestions'],

        data() {
            return {
                list: [
                ]
            };
        },
        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
            ])

        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setQuestionDetailsByKey",
            ]),

            addItemInList: function () {
                let list = JSON.parse(JSON.stringify(this.item.question_details.mcq_single_option.suggestions));
                list.push({text: "", chosen: false});
                console.log(list);
                //this.$set(this, "list", list);
                this.setQuestionDetailsByKey({key: 'mcq_single_option', value: {suggestions: JSON.parse(JSON.stringify(list))}})
            },
            removeItem: function (index) {
                let list = JSON.parse(JSON.stringify(this.item.question_details.mcq_single_option.suggestions));
                if (list && list[index]) {
                    list.splice(index, 1);
                }
                this.setQuestionDetailsByKey({key: 'mcq_single_option', value: {suggestions: JSON.parse(JSON.stringify(list))}})
                //this.$set(this, "list", list);
            },
            suggestionsChanged: function(e, index) {

                let list = JSON.parse(JSON.stringify(this.item.question_details.mcq_single_option.suggestions));
                list[index].text = e.target.value;
                //this.setAnswerDetailsByKey({'key':'mcq_multiple_option','value':list});

                this.setQuestionDetailsByKey({key: 'mcq_single_option', value: {suggestions: JSON.parse(JSON.stringify(list))}})
            }
        }
    };
</script>
