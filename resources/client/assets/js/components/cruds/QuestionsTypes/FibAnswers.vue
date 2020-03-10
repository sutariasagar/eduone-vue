<template>
    <section>
        <div class="row" v-if="item">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">Type: {{ type }}</li>
                    <li class="list-group-item">fibOption: {{ fibOption }}</li>
                    <li class="list-group-item">item[type + '_details']: {{ item[type + '_details'] }}</li>
                    <li class="list-group-item">item[type + '_details'][fibOption]: {{ item[type + '_details'][fibOption] }}</li>
                </ul>
            </div>
        </div>
        <div class="row"
             v-if="item && type && fibOption && item[type + '_details'] && item[type + '_details'][fibOption]">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">count: {{ item[type + '_details'][fibOption].count }}</li>
                </ul>
            </div>
            <div class="col-md-12" v-if="type == 'answer'">
                <label class="col-md-12 col-form-label">FIB Answers</label>
                <div class="col-md-12">
                    <input
                        v-for="(index) in item[type + '_details'][fibOption].count"
                        type="text"
                        class="form-control col-md-12"
                        :name="'fib_answer_' + (Number(index))"
                        :placeholder="'Enter answer for blank # ' + (Number(index))"
                        v-model="item[type + '_details'][fibOption].answers[index-1]"
                    >
                </div>
            </div>

            <template v-else>
                <div class="col-md-12" v-if="fibOption != 'fib_no_options'">
                    <label class="col-md-12 col-form-label">FIB Suggestions</label>
                    <template v-if="fibOption == 'fib_dropdown'">
                        <template v-for="(mainIndex) in item[type + '_details'][fibOption].count">
                            <label class="col-md-12 col-form-label">Suggestions for {{ mainIndex }}</label>
                            <div class="col-md-12">
                                <ul class="list-group">
                                    <li
                                        class="list-group-item"
                                        v-for="(suggestion, index) in item[type + '_details'][fibOption].suggestions['blank_' + mainIndex]"
                                        :key="index"
                                    >
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control col-md-12"
                                                :name="'fib_suggestion_' + (Number(index))"
                                                v-model="item[type + '_details'][fibOption].suggestions['blank_' + mainIndex][index]"
                                            >
                                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="pull-right">
                                        <i class="fa fa-trash-o" @click="removeSuggestion(index, mainIndex)">&nbsp;</i>
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
                                        <button class="btn btn-secondary" @click="addSuggestion(mainIndex)"
                                                type="button">
                                            Add
                                        </button>
                                    </div>
                                </ul>
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <div class="col-md-12">
                            <ul class="list-group">
                                <li
                                    class="list-group-item"
                                    v-for="(index) in item[type + '_details'][fibOption].count"
                                    :key="index"
                                >
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control col-md-12"
                                            :name="'fib_suggestion_' + (Number(index))"
                                            v-model="item[type + '_details'][fibOption].suggestions[index]"
                                        >
                                        <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="pull-right">
                                        <i class="fa fa-trash-o" @click="removeSuggestion(index)">&nbsp;</i>
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
                                    <button class="btn btn-secondary" @click="addSuggestion" type="button">Add</button>
                                </div>
                            </ul>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </section>
</template>
<style scoped="">
</style>
<script>
    import {mapActions, mapGetters} from "vuex";

    const _ = require("lodash");
    export default {
        name: "FibAnswers",

        props: ["fibOption", "type"],

        data() {
            return { };
        },

        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
            ]),
            ...mapGetters("Alert", ["errors"])
        },

        watch: {
            "item.question_detils": function(val) {
                this.setQuestion_details(val);
            },

            "item.answer_detils": function(val) {
                this.setAnswer_details(val);
            },

            fibOption: function () {
                let context = this;
                if (context.item && context.fibOption && context.type) {
                    if (!context.item[context.type + '_details']) {
                        context.item[context.type + '_details'] = {}
                    }
                    if (!context.item[context.type + '_details'][context.fibOption]) {
                        context.item[context.type + '_details'][context.fibOption] = {}
                    }
                    if (context.type == 'answer') {
                        if (!context.item[context.type + '_details'][context.fibOption].answers) {
                            context.item[context.type + '_details'][context.fibOption].answers = []
                        }
                    } else if (context.type == 'question') {
                        if (!context.item[context.type + '_details'][context.fibOption].suggestions) {
                            if (this.fibOption == 'fib_dropdown') {
                                context.item[context.type + '_details'][context.fibOption].suggestions = {}
                            } else {
                                context.item[context.type + '_details'][context.fibOption].suggestions = []
                            }
                        }
                    }
                    if(context.type == "question") {
                        context.setQuestion_details(context.item[context.type + '_details'])
                    } else if (context.type == 'answer') {
                        context.setAnswer_details(context.item[context.type + '_details'])
                    }
                }
            },
        },

        mounted: function () {
            let context = this;
            if (context.item && context.fibOption && context.type) {
                if (!context.item[context.type + '_details']) {
                    context.item[context.type + '_details'] = {}
                }
                if (!context.item[context.type + '_details'][context.fibOption]) {
                    context.item[context.type + '_details'][context.fibOption] = {}
                }
                if (context.type == 'answer') {
                    if (!context.item[context.type + '_details'][context.fibOption].answers) {
                        context.item[context.type + '_details'][context.fibOption].answers = []
                    }
                } else if (context.type == 'question') {
                    if (!context.item[context.type + '_details'][context.fibOption].suggestions) {
                        if (this.fibOption == 'fib_dropdown') {
                            context.item[context.type + '_details'][context.fibOption].suggestions = {}
                        } else {
                            context.item[context.type + '_details'][context.fibOption].suggestions = []
                        }
                    }
                }
                if(context.type == "question") {
                    context.setQuestion_details(context.item[context.type + '_details'])
                } else if (context.type == 'answer') {
                    context.setAnswer_details(context.item[context.type + '_details'])
                }
            }

        },

        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "forceUpdateItem",
                "setQuestion_details",
                "setAnswer_details"
            ]),

            addSuggestion: function (mainIndex) {
                let context = this;
                if (_.isNumber(mainIndex)) {
                    if (!context.item[context.type + '_details'][context.fibOption].suggestions) {
                        context.item[context.type + '_details'][context.fibOption].suggestions = {};
                    }
                    if (!context.item[context.type + '_details'][context.fibOption].suggestions['blank_' + mainIndex]) {
                        context.item[context.type + '_details'][context.fibOption].suggestions['blank_' + mainIndex] = [];
                    }
                    context.item[context.type + '_details'][context.fibOption].suggestions['blank_' + mainIndex].push("");
                } else {
                    if (!context.item[context.type + '_details'][context.fibOption].suggestions) {
                        context.item[context.type + '_details'][context.fibOption].suggestions = [];
                    }
                    context.item[context.type + '_details'][context.fibOption].suggestions.push("");
                }
            },
            removeSuggestion: function (index, mainIndex) {
                let context = this;
                if (context.item[context.type + '_details'][context.fibOption].suggestions) {
                    if (mainIndex) {
                        if (context.item[context.type + '_details'][context.fibOption].suggestions['blank_' + mainIndex] && context.item[context.type + '_details'][context.fibOption].suggestions['blank_' + mainIndex][index]) {
                            context.item[context.type + '_details'][context.fibOption].suggestions['blank_' + mainIndex].splice(index, 1);
                        }
                    } else {
                        if (context.item[context.type + '_details'][context.fibOption].suggestions[index]) {
                            context.item[context.type + '_details'][context.fibOption].suggestions.splice(index, 1);
                        }
                    }
                }
            }
        }
    };
</script>
