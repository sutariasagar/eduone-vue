<template>
    <draggable tag="ul" :list="list" class="list-group">
        <li class="list-group-item" v-for="(suggestion, index) in list" :key="index">
            <template>
                <div class="input-group">
                    <input
                            type="text"
                            :id="'mcq_multiple_option_input' + index"
                            :name="'mcq_multiple_option_chosen' + index"
                            v-model="list[index].text"
                            autocomplete="off"
                            class="form-control"
                            placeholder="Enter text here"
                            :ref="'mcq_multiple_option_input' + index"
                            @change="suggestionsChanged"
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
        name: "MCQMultipleOption",

        components: {draggable},

        props: ['type', 'suggestions'],

        data() {
            return {
                list: [
                ]
            };
        },
        mounted(){
            this.addItemInList()
        },
        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
            ])

        },
        watch: {
            list: function () {
                this.setQuestionDetailsByKey({key: 'mcq_multiple_option', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setQuestionDetailsByKey",
            ]),

            addItemInList: function () {
                let list = JSON.parse(JSON.stringify(this.list));
                list.push({text: "", chosen: false});
                this.$set(this, "list", list);
            },
            removeItem: function (index) {
                let list = JSON.parse(JSON.stringify(this.list));
                if (list && list[index]) {
                    list.splice(index, 1);
                }
                this.$set(this, "list", list);
            },
            suggestionsChanged: function() {
                this.setQuestionDetailsByKey({key: 'mcq_multiple_option', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        }
    };
</script>
