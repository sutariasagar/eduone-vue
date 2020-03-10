<template>
    <draggable tag="ul" :list="list" class="list-group">
        <li class="list-group-item" v-for="(suggestion, index) in list" :key="index">
            <template>
                <div class="input-group">
                    <input
                            type="text"
                            :id="'ordered_text_input' + index"
                            :name="'ordered_text_chosen' + index"
                            v-model="list[index].text"
                            autocomplete="off"
                            class="form-control"
                            placeholder="Enter text here"
                            :ref="'ordered_text_input' + index"
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
        name: "AnswerSelectText",

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
                this.setAnswerDetailsByKey({key: 'select_text', value: JSON.parse(JSON.stringify(this.list))})
            }
        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setAnswerDetailsByKey",
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
                this.setAnswerDetailsByKey({key: 'select_text', value: JSON.parse(JSON.stringify(this.list))})
            }
        }
    };
</script>
