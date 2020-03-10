<template>
    <div class="row">
        <div class="col-md-12 ">
            <p v-if="item.questions.reading_timer" class="float-right">
                <b>Time Remaining:</b> {{ readingTime }}
            </p>
        </div>
    </div>
</template>
<script>
  import Vue from 'vue'
  import QuestionCounter from './QuestionCounter.vue';
  export default {
    props: ['item', 'section','sectionCompleted'],
    data() {
      return {
        checkedNames: [],
        radioSuggestion:false,
        fibAnswer: {},
        suggestionArray: [],
        sectionTime: 0,
        counterMethod: null
      }
    },
    created(){
      this.sectionTime = this.item.questions[this.section+'_timer']
      this.counterMethod = setInterval(this.myTimer,1000);
    },
    destroyed(){
      clearInterval(this.counterMethod);
    },
    computed:{
      readingTime(){
        return new Date(this.sectionTime * 1000).toISOString().substr(14, 5);
      },
    },
    methods:{
      myTimer(){
        this.countDown();
      },
      countDown() {
        console.log("this is section time", this.sectionTime)        
        if (this.sectionTime > 0) {
          this.sectionTime = this.sectionTime - 1;
        }else{
          clearInterval(this.counterMethod);
          this.$emit("endSection", true);
        }
      },
    }
  }

</script>