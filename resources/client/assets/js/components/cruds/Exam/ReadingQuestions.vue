<template>

    <div>
    <div class="border container-fluid min-vh-79" v-if="question">

        <section-timer v-if="item.questions.reading_timer" :sectionCompleted='sectionCompleted' :item="item" :section="'reading'" v-on:endSection="endSection"></section-timer>
        <div
            class="row mb-5"
            v-if="question.question_details && question.question_details.mcq_single_option"
        >
            <div class="col-md-6">
                <div class="p-2">
                    <div>
                        <p v-html="question.question_details.html_text_2"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row p-1" v-if="question.header">

                    <div class="col-md-12">
                        <p class="question-header" v-html="question.header"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="p-1">
                        <div class="col-md-12">
                            <p v-html="question.question_details.html_text"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="p-2">
                        <div class="col-md-12">
                            <div v-bind:key="index"
                                class="checkbox"
                                v-for="(suggestion,index) in question.question_details.mcq_single_option.suggestions"
                            >
                                <label>
                                    <input
                                        v-model="radioSuggestion"
                                        @input="updateAnswer"
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
            class="row mb-5"
            v-if="question.question_details && question.question_details.mcq_multiple_option"
        >
            <div class="col-md-6">
                <div class="p-2">
                    <div class>
                        <p v-html="question.question_details.html_text_2"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row p-1" v-if="question.header">
                    <div class="col-md-12">
                        <p class="question-header" v-html="question.header"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="p-2">
                        <div class="col-md-12">
                            <p v-html="question.question_details.html_text"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="p-2">
                        <div class="col-md-12">
                            <div
                                v-bind:key="index"
                                class="checkbox"
                                v-for="(suggestion, index) in question.question_details.mcq_multiple_option.suggestions"
                            >
                                <label>
                                    <input
                                        v-model="checkedNames"
                                        @change="updateAnswer"
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
            class="mb-2 col-md-12"  v-on:drop="drop" v-on:dragover="allowDrop"
            v-if="question.question_details && question.question_details.fib_drag_drop"
        >

            <div class="row p-2" v-if="question.header">
                <div class="col-md-12">
                    <p class="question-header" v-html="question.header"></p>
                </div>
            </div>
            <div class="row p-2 custom-height" v-if="question.question_details.html_text"  >
                <div class="col-md-12">
                    <template v-for="(data,index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">
                        <template v-if="data.includes('#b')">
                            &nbsp
                            <custom-input v-bind:key="index" :id="data" v-on:change="updateFIBAnswer" v-on:addToSuggestion="addToSuggestions"></custom-input>                            
                            &nbsp
                        </template>
                        <template v-else >
                            <span v-bind:key="index" v-html="' '+data"> </span>
                            
                        </template>
                    </template>

                </div>
            </div>
            <div class="row p-2 mt-5 custom-blue-background dragdrop" v-on:drop="drop" v-on:dragover="allowDrop" v-on:focus="beforeChange" >
                <div class="col-md-12">
                    <div class="mb-3" >
                    <span v-on:dragstart="drag" draggable="true" v-bind:key="index" v-for="(suggestion, index) in suggestionArray" class="label label-default p-1 m-2 pl-5 pr-5 mb-3">
                         {{suggestion.text}}
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div
                class="mb-5 col-md-12"
                v-if="question.question_details && question.question_details.fib_dropdown"
        >

            <div class="row p-2" v-if="question.header">
                <div class="col-md-12">
                    <p class="question-header" v-html="question.header"></p>
                </div>
            </div>
            <div class="row p-2 custom-height" v-if="question.question_details.html_text">
                <div class="col-md-12">
                    <template  v-for="(data, index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">
                        <template v-if="data.includes('#b')">
                            <custom-drop-down v-bind:key="index" :customref="question.id" :suggestions="question.question_details.fib_dropdown.suggestions" :id="data" v-on:change="updateFIBAnswer">

                            </custom-drop-down>
                            &nbsp
                        </template>
                        <template v-else >
                            <span v-bind:key="index" v-html="data"> </span>
                            &nbsp
                        </template>
                    </template>

                </div>
            </div>

        </div>
        <div
                v-if="question.question_details && question.question_details.ordered_text"
        >

            <div class="row p-2" v-if="question.header">
                <div class="col-md-12">
                    <p class="question-header" v-html="question.header"></p>
                </div>
            </div>
        <ordered-text
            v-if="question.question_details && question.question_details.ordered_text"
            @answerChanged="orderTextUpdated"
        ></ordered-text>
        </div>
    </div>
        <question-footer :section="'reading'" :item="item" :lastQuestion="lastQuestion" v-on:next="next" v-on:endSection="endSection">
        </question-footer>
</div>
</template>

<script>
import Vue from "vue";
import { mapActions, mapGetters } from "vuex";
import CustomInput from './CustomInput.vue';
import CustomDropDown from './CustomDropDown.vue';
import OrderedText from "./OrderedText";
import QuestionFooter from "./QuestionFooter.vue";
import SectionTimer from './SectionTimer.vue';
export default {
    data() {
      return {
        checkedNames: [],
        radioSuggestion:false,
        fibAnswer: {},
        suggestionArray: [],
        sectionCompleted: false        
      }
    },
    components: { OrderedText,CustomInput,CustomDropDown,QuestionFooter,SectionTimer },
    computed: {
        ...mapGetters("StudentExam", [
            "item",
            "loading",
            "question",
            "lastQuestion"
        ]),
        ...mapGetters("Alert", ["errors"])
    },
    mounted(){
        
    },
    created() {
        this.fibAnswer = {};
        this.suggestionArray = [];
        
        this.fetchSingleQuestion({
            id: this.$route.params.id,
            section: "reading"
        });
        this.setAnswer("");
        if(this.question.question_details.fib_drag_drop){            
              console.log("type is drag and drop");
              this.suggestionArray = JSON.parse(JSON.stringify(this.question.question_details.fib_drag_drop.suggestions));
              console.log(this.suggestionArray);
              let x = document.getElementsByClassName("dragdrop");
              for(let i=0; i< x.length; i++){
                x[i].value = "";
              }
            }
    },
    destroyed() {
        console.log("destroyed called");
    },
    watch: {
        "$route.params.id": function() {
            console.log("yes we are watching");
            this.resetQuestionState();
            this.checkedNames = [];
            this.radioSuggestion = false;
            this.fibAnswer = {};
            this.suggestionArray = [];            
            this.fetchSingleQuestion({
                id: this.$route.params.id,
                section: "reading"
            });
            if(this.question.question_details.fib_drag_drop){
              console.log("type is drag and drop");
              this.suggestionArray = JSON.parse(JSON.stringify(this.question.question_details.fib_drag_drop.suggestions));
              console.log(this.suggestionArray);
              let x = document.getElementsByClassName("dragdrop");
              for(let i=0; i< x.length; i++){
                x[i].value = "";
              }
            }
          if(this.question.question_details.fib_dropdown){              
            // let x = document.getElementsByClassName("custom-dropdown");
            // for(let i=0; i< x.length; i++){
            //   x[i].value = "";
            // }
          }

            this.seconds = this.question.preparation_time;
        }
    },
    methods: {
      ...mapActions("StudentExam", [
        "fetchSingleQuestion",
        "setAnswer",
        "saveAnswer",
        "resetQuestionState"
      ]),
      customdrop(ev){
            console.log("here drop in reading div");
            ev.preventDefault();
            var data = ev.dataTransfer.getData("value").trim();
            console.log("in Drop",data);
            this.addToSuggestions(data);    
      },
      drop(ev){
          console.log("here drop in reading");
        ev.preventDefault();
        var data = ev.dataTransfer.getData("value").trim();
        console.log("in Drop",data);
        this.addToSuggestions(data);    
        //alert(data);
        //this.updateAnswer(ev);
      },
      customallowDrop(ev){
          console.log("allowDrop in reading parent");
          ev.preventDefault()
      },
      allowDrop(ev){
          console.log("allowDrop in reading");
        ev.preventDefault()
      },
      beforeChange(){
          console.log("in before change in reading");
          //   ev.dataTransfer.setData("value", ev.target.value);
        //   ev.target.value = "";
      },
      updateFIBAnswer(index, value){
          console.log("updateFIBAnswer");
        this.fibAnswer[index] = value;
        if(this.question.question_details.fib_drag_drop){
            console.log(index, value);
            this.removeByAttr('text', value);
            
        }

        this.updateAnswer();
      },
      addToSuggestions(value){
         let vm = this;
        var exists = Object.keys(vm.suggestionArray).some(function(k) {
            return vm.suggestionArray[k].text === value;
        });
        if(value && !exists)
          this.suggestionArray.push({'chosen':false, 'text':value});
      
       },
      removeByAttr(attr, value){
          console.log("in remove By ");
            var i = this.suggestionArray.length;        
            while(i--){
                //console.log(this.suggestionArray[i]);
                //console.log("has prop", this.suggestionArray[i].hasOwnProperty(attr));                
            if( this.suggestionArray[i] && this.suggestionArray[i].hasOwnProperty(attr) && this.suggestionArray[i][attr].trim() == value.trim() ){
                    console.log("yes its coming here"); 
                    this.suggestionArray.splice(i,1);
                }
            }            
      },

      drag(ev){
          console.log('drag in reading');
            ev.dataTransfer.setData("value", ev.target.innerHTML);
      },
      updateAnswer(event){
        console.log("in update answer")
        if(this.question.question_details.mcq_multiple_option){
          this.setAnswer(JSON.stringify(this.checkedNames));
          return
        }
        if(this.question.question_details.mcq_single_option){
          this.setAnswer(event.target.value);
          return
        }
        if(this.question.question_details.fib_drag_drop){
          this.setAnswer(JSON.stringify(this.fibAnswer));
          return
        }
        if(this.question.question_details.fib_dropdown){
          this.setAnswer(JSON.stringify(this.fibAnswer));
          return
        }

      },
        orderTextUpdated(value) {
            console.log("orderTextUpdated value: ", value);
            this.setAnswer(JSON.stringify(value));
        },
        endSection() {
            this.sectionCompleted = true
            this.$router.push({
                name: "exam.optionalbreak"
            });
        },
        next() {
            this.saveAnswer();
            this.$router.push({
                name: "exam.reading.questions",
                params: { id: parseInt(this.$route.params.id) + 1 }
            });
        },
        getData() {},
        callback(msg) {}
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
.custom-blue-background {
    background-color: #ddf2ff;
    color: black;
    height:200px;
}
.custom-blue-background span{
    font-size: 15px;
    border: 1px solid black !important;
    background: white;
    line-height: 35px;
}
.dragdrop{
    line-height: 20px;
}
select.custom-dropdown{
color: #000000;
background: #f8f8f8;
border-style: solid;
}
input{
    color: #000000;
    border-style: groove;
}

</style>


