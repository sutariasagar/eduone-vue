<template>
    <div class="row ml-3 mr-0 mt-3">
        <div class="col-lg-5 col-md-5 border pt-3 pb-3" id="suggestionsBox">
            <ul class="list-group list-group-flush">
                <template v-for="(suggestion, index) in suggestions">
                    <li v-bind:key="index"
                        :class="'list-group-item ' + (selectedSuggestionIndex == index ? 'active' : '')"
                        @click="selectedSuggestionIndex = index;"
                    >{{ suggestion.text }}</li>
                </template>
            </ul>
        </div>
        <div class="col-lg-1 col-md-1 d-flex align-items-center">
            <i class="fa fa-2x fa-arrow-circle-left" @click="moveLeft">&nbsp;</i>
            <i class="fa fa-2x fa-arrow-circle-right" @click="moveRight">&nbsp;</i>
        </div>
        <div class="col-lg-5 col-md-5 border pt-3 pb-3" id="answersBox">
            <ul class="list-group list-group-flush">
                <template v-for="(answer, index) in answers">
                    <li v-bind:key="index"
                        :class="'list-group-item ' + (selectedAnswerIndex == index ? 'active' : '')"
                        @click="selectedAnswerIndex = index;"
                    >{{ answer }}</li>
                </template>
            </ul>
        </div>
        <div class="col-lg-1 col-md-1 align-self-center">
            <i class="fa fa-2x fa-arrow-circle-up d-block" @click="moveUp">&nbsp;</i>
            <i class="fa fa-2x fa-arrow-circle-down d-block" @click="moveDown">&nbsp;</i>
        </div>
    </div>
</template>

<script>
import Vue from "vue";
import { mapActions, mapGetters } from "vuex";
export default {
    name: "OrderedText",
    data() {
        return {
            answers: [],
            suggestions: [],
            selectedAnswerIndex: null,
            selectedSuggestionIndex: null
        };
    },
    components: {},
    computed: {
        ...mapGetters("StudentExam", [
            "item",
            "loading",
            "question",
            "lastQuestion"
        ]),
        ...mapGetters("Alert", ["errors"])
    },
    mounted() {
        this.suggestions = JSON.parse(
            JSON.stringify(
                this.question.question_details.ordered_text.suggestions
            )
        );
        this.$nextTick(() => {
            document.getElementById("suggestionsBox").style.minHeight =
                document.getElementById("suggestionsBox").offsetHeight + "px";
            document.getElementById("answersBox").style.minHeight =
                document.getElementById("suggestionsBox").offsetHeight + "px";
        });
    },
    destroyed() {
        console.log("destroyed called");
    },
    watch: {
        "$route.params.id": function() {
            this.suggestions = JSON.parse(
                JSON.stringify(
                    this.question.question_details.ordered_text.suggestions
                )
            );
            this.answers = []
        },
        answers: function() {
            this.$emit(
                "answerChanged",
                JSON.parse(JSON.stringify(this.answers))
            );
        }
    },
    methods: {
        moveLeft() {
            if (this.selectedAnswerIndex == null) return;
            let answers = JSON.parse(JSON.stringify(this.answers));
            this.suggestions.push({
                text: answers[this.selectedAnswerIndex],
                chosen: false
            });
            this.answers.splice(this.selectedAnswerIndex, 1);
            this.selectedAnswerIndex = null;
        },

        moveRight() {
            if (this.selectedSuggestionIndex == null) return;
            let suggestions = JSON.parse(JSON.stringify(this.suggestions));
            this.answers.push(suggestions[this.selectedSuggestionIndex].text);
            this.suggestions.splice(this.selectedSuggestionIndex, 1);
            this.selectedSuggestionIndex = null;
        },

        moveUp() {
            if (
                this.selectedAnswerIndex == null ||
                this.selectedAnswerIndex == 0
            ) {
                return;
            }

            let answers = JSON.parse(JSON.stringify(this.answers));

            let tempContainer = answers[this.selectedAnswerIndex - 1];
            answers[this.selectedAnswerIndex - 1] =
                answers[this.selectedAnswerIndex];
            answers[this.selectedAnswerIndex] = tempContainer;
            this.selectedAnswerIndex--;
            this.$set(this, "answers", JSON.parse(JSON.stringify(answers)));
        },

        moveDown() {
            if (
                this.selectedAnswerIndex == null ||
                this.selectedAnswerIndex == this.answers.length - 1
            ) {
                return;
            }

            let answers = JSON.parse(JSON.stringify(this.answers));

            let tempContainer = answers[this.selectedAnswerIndex + 1];
            answers[this.selectedAnswerIndex + 1] =
                answers[this.selectedAnswerIndex];
            answers[this.selectedAnswerIndex] = tempContainer;
            this.selectedAnswerIndex++;
            this.$set(this, "answers", JSON.parse(JSON.stringify(answers)));
        }
    }
};
</script>
<style scoped="">
.question-header {
    font-style: italic;
    font-weight: bold;
}
</style>


