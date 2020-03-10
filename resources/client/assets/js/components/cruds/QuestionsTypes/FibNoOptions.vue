<template>
    <div class="card">
        <!--<draggable tag="ul" :list="list" class="list-group" :sortable="false">-->
            <li class="list-group-item" v-for="(suggestion, index) in list" :key="index">
                <div class="input-group">
                    <input
                        type="text"
                        autocomplete="off"
                        class="form-control"
                        placeholder="Enter suggestion text"
                        :data-index="index"
                        v-model="list[index].text"
                        @input="suggestionsChanged"
                    >
                    <div class="input-group-append">
                    <span class="input-group-text">
                        <span class="pull-right">
                            <i class="fa fa-trash-o" @click="removeItem(index)">&nbsp;</i>
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
                <button class="btn btn-secondary" @click="addItemInList" type="button">Add</button>
            </div>
        <!--</draggable>-->
    </div>
</template>
<style scoped="">
    .mb-5 {
        margin-bottom: 5px !important;
    }
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    //import draggable from "vuedraggable";

    export default {
        name: "FibNoOptions",

        //components: {draggable},

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
            list: function () {
                this.setQuestionDetailsByKey({key: 'fib_no_options', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        },
        mounted() {
            if(this.$route.name == "questions_banks.edit") {
                this.$set(this, "list", JSON.parse(JSON.stringify(this.item.question_details.fib_no_options.suggestions)))
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
                if (list[index]) {
                    list.splice(index, 1);
                }
                this.$set(this, "list", list);
            },
            suggestionsChanged: function() {
                this.setQuestionDetailsByKey({key: 'fib_no_options', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        }
    };
</script>
