<template>
    <div class="card">
        <draggable tag="ul" :list="list" class="list-group" :key="blankIndex"
                   v-for="(suggestionList, blankIndex) in list" :sortable="false">
            <div class="mb-5">Suggestions for Blank # {{blankIndex + 1}}</div>
            <li class="list-group-item" v-for="(suggestion, index) in list[blankIndex]" :key="index">
                <div class="input-group">
                    <input
                        type="text"
                        autocomplete="off"
                        class="form-control"
                        :placeholder="'Enter suggestion for blank ' + (blankIndex + 1)"
                        :data-index="index"
                        :data-blank-index="blankIndex"
                        v-model="list[blankIndex][index].text"
                        @change="suggestionsChanged"
                    >
                    <div class="input-group-append">
                    <span class="input-group-text">
                        <span class="pull-right">
                            <i class="fa fa-trash-o" @click="removeItem(blankIndex, index)">&nbsp;</i>
                        </span>
                    </span>
                    </div>
                </div>
            </li>
            <div
                slot="footer"
                class="btn-group list-group-item"
                role="group"
                aria-label="Basic example"
                key="footer"
            >
                <button class="btn btn-secondary" @click="addItemInList(blankIndex)" type="button">Add</button>
            </div>
        </draggable>
    </div>
</template>
<style scoped="">
    .mb-5 {
        margin-bottom: 5px !important;
    }
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    import draggable from "vuedraggable";

    export default {
        name: "FibDropDown",

        components: {draggable},

        props: ['type', 'suggestions'],

        data() {
            return {
                list: []
            };
        },
        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
            ])
        },
        watch: {
            "item.blankCount": function () {
                let list = JSON.parse(JSON.stringify(this.list));
                if (this.item.blankCount) {
                    for (let i = 0; i < this.item.blankCount; i++) {
                        if (!list[i]) {
                            list[i] = [{text: "", chosen: false}];
                        }
                    }
                }
                this.$set(this, "list", list);
            },
            list: function () {
                this.setQuestionDetailsByKey({key: 'fib_dropdown', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        },
        mounted() {
            if(this.$route.name == "questions_banks.edit") {
                this.$set(this, "list", JSON.parse(JSON.stringify(this.item.question_details.fib_dropdown.suggestions)))
            }
        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setQuestionDetailsByKey",
            ]),

            addItemInList: function (blankIndex) {
                let list = JSON.parse(JSON.stringify(this.list));
                list[blankIndex].push({text: "", chosen: false});
                this.$set(this, "list", list);
            },
            removeItem: function (blankIndex, index) {
                let list = JSON.parse(JSON.stringify(this.list));
                if (list[blankIndex] && list[blankIndex][index]) {
                    list[blankIndex].splice(index, 1);
                }
                this.$set(this, "list", list);
            },
            suggestionsChanged: function() {
                this.setQuestionDetailsByKey({key: 'fib_dropdown', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        }
    };
</script>
