<template>
    <div>
    <div class="border container-fluid min-vh-79" v-if="question">
        <section-timer :item="item" v-if="item.questions.listeningrol_timer" :section="'listeningrol'" v-on:endSection="endSection"></section-timer>
        <div class="row p-2" v-if="question.header">
            <div class="col-md-12">
                <p class="question-header" v-html="question.header"></p>
            </div>
        </div>

        <div
                class="row mt-3 mb-5"
                v-if="question.question_details && question.question_details.audio_upload"
        >
            <div
                    class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
            >
                <div class="col-md-4 border p-2">
                    <div class>
                        <p v-if="playerSeconds > 0">Status: Beginning in {{playerSeconds}} seconds</p>
                        <p v-else-if="!playingComplete">Status: Playing</p>
                        <p v-else>Status: Completed</p>

                        <audio-player
                                :start="startPlaying"
                                @playingComplete="onPlayingComplete"
                                :src="verifyURL($MAIN_APP_EXAM_URL+question.question_details.audio_upload.data.file_link_url[0])"                                                
                        ></audio-player>
                        <div v-if="playerSeconds > 0">
                            <b-progress :value="playerSeconds" :max="5" class="mb-3"></b-progress>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3 highlightdiv" v-if="question.answer_details.select_text">
                <div class="p-2 text-justify">
                    <span   @click="highLightWord"  v-bind:key="index" v-for="(data, index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">
                        {{data}}
                    </span>
                </div>
            </div>
        </div>

        <div v-if="question.answer_details && question.answer_details.html_text == ''">
            <div class="row mt-5 mb-2 checking">
                <div class="col-md-12">
                    <div class="p-2">
                        <div class="">
                            <textarea
                                    class="w-100 h-100 text-area"
                                    rows="10"
                                    @input="updateAnswer"
                                    @keydown="getCursorPosition"
                                    @click="getCursorPosition"
                                    @focus="getCursorPosition"
                                    v-model="answer"
                                    spellcheck="false"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 mb-2 ml-0 mr-0">
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
        <div
                class="row mt-2 mb-5"
                v-if="question.question_details && question.question_details.mcq_multiple_option "
        >
            <div class="col-md-12" v-if="question.question_details.html_text">
                <div class="p-2">
                    <div class>
                        <p v-html="question.question_details.html_text"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <div class="p-2">
                        <div class="">
                            <div
                                    class="checkbox" v-bind:key="index"
                                    v-for="(suggestion, index) in question.question_details.mcq_multiple_option.suggestions"
                            >
                                <label>
                                    <input
                                            v-model="checkedNames"
                                            @change="updateMulAnswer"
                                            class="mr-3"
                                            type="checkbox"
                                            :value="suggestion.text"
                                    >
                                    {{ suggestion.text }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
                class="row mt-2 mb-5"
                v-else-if="question.question_details && question.question_details.mcq_single_option "
        >
            <div class="col-md-12" v-if="question.question_details.html_text">
                <div class="p-2">
                    <div class>
                        <p v-html="question.question_details.html_text"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <div class="p-2">
                        <div class="">
                            <div class="checkbox" v-bind:key="index" v-for="(suggestion, index) in question.question_details.mcq_single_option.suggestions">
                                <label>
                                    <input
                                            v-model="radioSuggestion"
                                            @input="updateMulAnswer"
                                            class="mr-3"
                                            type="radio"
                                            :value="suggestion.text"
                                    >
                                    {{ suggestion.text }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
                class="mt-2 mb-5 col-md-12 custom-height"
                v-else-if="question.answer_details && question.answer_details.fib_no_options"
        >

            <div class="row p-4" v-if="question.question_details.html_text">
                <div class="col-md-12">

                    <template v-for="(data, index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">

                        <template v-if="data.includes('#b')">
                            <custom-text-input v-bind:key="index" :id="data" v-on:change="updateFIBAnswer" autocomplete="off">                                
                            </custom-text-input>
                            &nbsp
                        </template>
                        <template v-else>
                            <span v-bind:key="index" v-html="data"> </span>
                            &nbsp
                        </template>
                    </template>

                </div>
            </div>
        </div>
        <div v-else-if="question.answer_details.select_text">

        </div>
        <div v-else>
            <div class="row mt-5 mb-2">
                <div class="col-md-12">
                    <div class="p-2">
                        <div class="">
                            <textarea
                                    class="w-100 h-100 text-area"
                                    rows="10"
                                    @input="updateAnswer"
                                    @keydown="getCursorPosition"
                                    @click="getCursorPosition"
                                    @focus="getCursorPosition"
                                    v-model="answer"
                                    spellcheck="false"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 mb-2 ml-0 mr-0">
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
    </div>
        <question-footer :section="'listeningrol'" :item="item" :lastQuestion="lastQuestion" v-on:next="next" v-on:endSection="endSection">
        </question-footer>
    </div>
</template>

<script>
  import Vue from 'vue';
  import {mapActions, mapGetters} from "vuex";
  import AudioPlayer from "../../utils/AudioPlayer.vue";
  import Input from './Input.vue';
  import QuestionFooter from './QuestionFooter.vue';
  import CustomTextInput from './CustomTextInput.vue';
  import SectionTimer from './SectionTimer.vue';
  export default {
    data() {
      return {
        answer: "",
        copiedText: null,
        seconds: 0,
        playerSeconds: 0,
        checkedNames: [],
        fibAnswer: {},
        radioSuggestion:false,
        selectedText: [],
        startPlaying:false,
        playingComplete: false
      }
    },
    components:{
      AudioPlayer,
      Input,
      QuestionFooter,
      CustomTextInput,
      SectionTimer
    },
    computed: {
      ...mapGetters('StudentExam', ['item', 'loading','question','lastQuestion']),
      ...mapGetters('Alert', ['errors']),
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
    mounted() {
        this.selectedText = [];
      this.fetchSingleQuestion({
        id: this.$route.params.id,
        section: "listeningrol"
      });
      if(this.question.answer_details.select_text){
          var elems = document.querySelectorAll(".highlightdiv div span");

            [].forEach.call(elems, function(el) {
                el.classList.remove("hl");
            });
        }
      if(this.question.question_details.audio_upload){
        this.playerSeconds = 5;
        //this.startRecordingCountDown = false;
      }
      else
        this.playerSeconds = 0;

      this.$nextTick(function() {
        window.setInterval(() => {
          if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
            this.playerCountDown();
          }
        }, 1000);
      });
    },
    destroyed() {
      console.log("destroyed called");
    },
    watch: {
      "$route.params.id": function() {
        this.resetQuestionState();
        this.playingComplete = false;
        this.selectedText = [];
        this.fetchSingleQuestion({
          id: this.$route.params.id,
          section: "listeningrol"
        });
        //element.classList.remove("hl");        
        this.seconds = this.question.preparation_time;
        this.answer = "";
        this.copiedText = "";
        if(this.question.question_details.audio_upload){
          this.playerSeconds = 5;
          this.startPlaying = false;
        }
        else{
          this.playerSeconds = 0;
          //this.startPlaying = false;
        }
        if(this.question.answer_details.fib_no_options){
          console.log("type is drag and drop");
          let x = document.getElementsByClassName("dragdrop");
          for(let i=0; i< x.length; i++){
            x[i].value = "";
          }
        }
        if(this.question.answer_details.select_text){
          var elems = document.querySelectorAll(".highlightdiv div span");

            [].forEach.call(elems, function(el) {
                el.classList.remove("hl");
            });
        }
        if(this.question.question_details.fib_dropdown){
          let x = document.getElementsByClassName("custom-dropdown");
          for(let i=0; i< x.length; i++){
            x[i].value = "";
          }
        }
      }
    },
    methods: {
      ...mapActions("StudentExam", [
        "fetchSingleQuestion",
        "saveAnswer",
        "setAnswer",
        "resetQuestionState"
      ]),
        verifyURL(url){
            return url.replace('.com//','.com/');
        },
        highLightWord(e){
            let element = e.target;
            if(element.classList.contains("hl")){
                element.classList.remove("hl");
                for( var i = 0; i < this.selectedText.length; i++){ 
                    if ( this.selectedText[i] == element.innerText.trim()) {
                        this.selectedText.splice(i, 1); 
                        i--;
                    }
                }
            }else{
                element.classList.add("hl");
                this.selectedText.push(element.innerText.trim());
            }
            console.log(this.selectedText);
            this.setAnswer(JSON.stringify(this.selectedText));
        },        
      endSection(){
        this.saveAnswer();
        this.$router.push({
          name: 'exam.end'
        });
      },
      updateAnswer(event) {
        this.setAnswer(event.target.value);
      },
      playerCountDown() {
        if (this.playerSeconds == 1) {
          this.startPlayer();
        }
        this.playerSeconds = this.playerSeconds - 1;
      },
      startPlayer() {
        this.startAudioPlayer();
      },
      startAudioPlayer() {
        this.startPlaying = true;
      },
      getSelectionText(){
        let selectedTextString = "";
        var selected = this.getSelection();
        
        selectedTextString = selected.toString();
        console.log("selected", selectedTextString);
        var range = selected.getRangeAt(0);
        //console.log(range);
        if(selected.toString().length > 1){
          var newNode = document.createElement("span");
          newNode.setAttribute("class", "hl");
          range.surroundContents(newNode);
        }
        if(selectedTextString)
            this.selectedText.push(selectedTextString);
        selected.removeAllRanges();
        this.setAnswer(JSON.stringify(this.selectedText));
        return;
      },
      getSelection(){
        var seltxt = '';
        if (window.getSelection) {
          console.log("check window");
          seltxt = window.getSelection();          
        } else if (document.getSelection) {
            console.log("check get se");
          seltxt = document.getSelection();
        } else if (document.selection) {
            console.log("sele");
          seltxt = document.selection.createRange().html;
        }
        else return;
        return seltxt;
      },
      next(){
        this.saveAnswer();
        this.$router.push({
          name: 'exam.listeningrol.questions',
          params: { id: parseInt(this.$route.params.id) + 1}
        });
      },
      getData(){

      },
      callback (msg) {

      },
      updateFIBAnswer(index, value){
        this.fibAnswer[index] = value;
        console.log(this.fibAnswer);
        this.updateMulAnswer();
      },
      updateMulAnswer(event){
        if(this.question.question_details.mcq_multiple_option){
          this.setAnswer(JSON.stringify(this.checkedNames));
          return
        }
        if(this.question.question_details.mcq_single_option){
          this.setAnswer(event.target.value);
          return
        }
        if(this.question.answer_details.fib_no_options){
        console.log(this.fibAnswer)
          this.setAnswer(JSON.stringify(this.fibAnswer));
          return
        }
      },
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
      onPlayingComplete() {
          this.playingComplete = true;
        console.log("playing or record done");
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
  }
</script>
<style scoped>
    .question-header{
        font-style: italic;
        font-weight: bold;
    }
    .border{
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
    }
    span.hl {
        background-color: yellow !important;
    }
    .dragdrop{
        line-height: 20px;
    }
    input{
        color: #000000;
        border-style: groove;
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


