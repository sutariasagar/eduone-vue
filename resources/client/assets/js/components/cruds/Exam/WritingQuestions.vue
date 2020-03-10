<template>
    <div>
    <div class="border container-fluid min-vh-79" v-if="question">
        <div class="row p-1" v-if="question.header">
            <div class="col-md-11">
                <p class="question-header" v-html="question.header"></p>
            </div>
             <div class="col-md-1">
                <p class="question-header float-right mr-2"> {{ time }}</p>
            </div>
        </div>
        <div
            class="row mt-2 mb-2"
            v-if="question.question_details && question.question_details.html_text"
        >
            <div class="col-md-12">
                <div class="p-2">
                    <div class>
                        <p v-html="question.question_details.html_text"></p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="row mt-2 mb-2"
            v-if="question.question_details && question.question_details.html_text"
        >
            <div class="col-md-12"> 
                <div class="p-2">
                    <div class>
                        <textarea
                            class="w-100 h-100 text-area"
                            rows="10"
                            @input="updateAnswer"
                            @keydown="getCursorPosition"
                            @click="getCursorPosition"
                            @focus="getCursorPosition"
                            v-model="answer"
                            spellcheck="false"
                            autofocus
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="row mt-2 mb-2 ml-0 mr-0"
            v-if="question.question_details && question.question_details.html_text"
        >
            <div class="col-md-4 text-left">
                <button @click="copyText" class="ccp-button">Copy</button>
            </div>
            <div class="col-md-4 text-center">
                <button @click="cutText" class="ccp-button">Cut</button>
            </div>
            <div class="col-md-4 text-right">
                <button @click="pasteText" class="ccp-button">Paste</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="p-2">Total Word Count: {{ wordcount }}</div>
            </div>
        </div>

    </div>
    <question-footer :section="'writing'" :item="item" :lastQuestion="lastQuestion" v-on:next="next" v-on:endSection="endSection">
    </question-footer>
    </div>
</template>

<script>
import Vue from "vue";
import { mapActions, mapGetters } from "vuex";
import QuestionFooter from "./QuestionFooter.vue";
export default {
    data() {
        return {
            answer: "",
            copiedText: null,
            seconds: 0,
            counterMethod: null
        };
    },
    components: {
      QuestionFooter
    },
    mounted(){
      this.fetchSingleQuestion({
        id: this.$route.params.id,
        section: "writing"
      });
      this.seconds = this.question.attempt_time;
      this.counterMethod = setInterval(this.myTimer,1000);
    },
    computed: {
        ...mapGetters("StudentExam", [
            "item",
            "loading",
            "question",
            "lastQuestion"
        ]),
        ...mapGetters("Alert", ["errors"]),
          time(){
            return new Date(this.seconds * 1000).toISOString().substr(14, 5);
          },
        wordcount() {
            if(this.answer !=""){
                return this.answer.match(/\S+/g).length
            }else{
                return 0;
            }                    
        }
    },
    created() {

    },
    destroyed() {
        //console.log("destroyed called");
    },
    watch: {
        "$route.params.id": function() {
            console.log("checking its here or not");
            this.resetQuestionState();
            this.fetchSingleQuestion({
                id: this.$route.params.id,
                section: "writing"
            });
            this.seconds = this.question.attempt_time;
            this.answer = "";
            this.copiedText = "";
            clearInterval(this.counterMethod);
            this.counterMethod = setInterval(this.myTimer,1000);
        }
    },
    methods: {
        ...mapActions("StudentExam", [
            "fetchSingleQuestion",
            "saveAnswer",
            "setAnswer",
            "resetQuestionState",
            "setLastQuestion"
        ]),

      myTimer(){
        this.countDown();
      },
        endSection() {
            clearInterval(this.counterMethod);
            this.saveAnswer();
            //this.setLastQuestion();
            this.$router.push({
                name: "exam.reading.questions",
                params: { id: parseInt(1) }
            });
        },
        updateAnswer(event) {
            this.setAnswer(event.target.value);
        },
          countDown() {
            console.log("in writing countdown", this.seconds);
            if(this.seconds == 0){
              if(this.lastQuestion){
                this.endSection();
              }else{
                this.next();
              }
            }else{
              this.seconds = this.seconds - 1;
            }
          },
        next() {
            clearInterval(this.counterMethod);
            this.saveAnswer();
            this.$router.push({
                name: "exam.writing.questions",
                params: { id: parseInt(this.$route.params.id) + 1 }
            });
        },
        getData() {},
        callback(msg) {},
        getCursorPosition(event) {
            let el = event.target;
            this.lastKnownPosition = 0;
            if ("selectionStart" in el) {
                this.lastKnownPosition = el.selectionStart;
            } else if ("selection" in document) {
                el.focus();
                let Sel = document.selection.createRange();
                let SelLength = document.selection.createRange().text.length;
                Sel.moveStart("character", -el.value.length);
                this.lastKnownPosition = Sel.text.length - SelLength;
            }
        },
        getSelectedText() {
            this.copiedText = null;

            var txtArea = document.getElementsByClassName("text-area")[0];
            var selectedText;
            if (txtArea.selectionStart != undefined)
            {
              var startPosition = txtArea.selectionStart;
              var endPosition = txtArea.selectionEnd;
              selectedText = txtArea.value.substring(startPosition, endPosition);
            }
            this.copiedText = selectedText;
        },
        copyText() {
            this.getSelectedText();
        },
        cutText() {
            this.getSelectedText();
            document.execCommand("cut");
        },
        pasteText() {
            if (!String.prototype.splice) {
                /**
                 * {JSDoc}
                 *
                 * The splice() method changes the content of a string by removing a range of
                 * characters and/or adding new characters.
                 *
                 * @this {String}
                 * @param {number} start Index at which to start changing the string.
                 * @param {number} delCount An integer indicating the number of old chars to remove.
                 * @param {string} newSubStr The String that is spliced in.
                 * @return {string} A new string with the spliced substring.
                 */
                String.prototype.splice = function(start, delCount, newSubStr) {
                    return (
                        this.slice(0, start) +
                        newSubStr +
                        this.slice(start + Math.abs(delCount))
                    );
                };
            }
            if(this.copiedText != null){
                this.answer = this.answer.splice(
                    this.lastKnownPosition,
                    0,
                    this.copiedText
                );
            }
            
        }
    }
};
</script>
<style scoped="">
.question-header {
    font-style: italic;
    font-weight: bold;
}
.border {
    border: 2px solid black !important;
}
.ccp-button {
    min-width: 150px;
    background: #ffffff;
    -webkit-appearance: unset;
    -moz-appearance: unset;
    -webkit-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
    -moz-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
    box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
    border-style: inset;
}
textarea{
    border-style: inset;
}
</style>


