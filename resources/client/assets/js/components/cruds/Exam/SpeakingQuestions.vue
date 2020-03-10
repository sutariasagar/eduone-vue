<template>
    <div>
        <questions></questions>
    </div>
</template>

<script>
  import Vue from 'vue';
  import {mapActions, mapGetters} from "vuex";
  import Questions from './Questions.vue';
  import SectionTimer from './SectionTimer.vue';
  export default {
    data() {
      return {
        // Code...
        question: null
      }
    },
    components:{
      Questions,
      SectionTimer
    },
    computed: {
      ...mapGetters('StudentExam', ['item', 'loading']),
      ...mapGetters('Alert', ['errors'])
    },
    created() {
      console.log("speaking questions created");
    },
    destroyed() {
      console.log("destroyed called in speaking section");
    },
    methods: {
      ...mapActions("StudentExam", [
        "startExam"
      ]),
      getData(){
        this.forceUpdate = true;
        this.questionID = this.$route.params.id;
        this.question = this.item.questions.speaking[this.questionID - 1];
        this.timeLimit = parseFloat((this.question.attempt_time/60).toFixed(2))
      },
      next(){
        this.$router.push({name: 'exam.speaking.questions', params: {'id': this.$route.params.id + 1}})
      },
      callback (msg) {

      },
      onRecordingComplete(event){
        console.log("yes are getting event in parent", event);
        this.disableNavigation = false;
      },
      handleCountdownEnd(){
        console.log("countdown ended");
        this.startRecording = true;
      }
    }
  }
</script>
<style scoped="">
    .border{
        border: 2px solid black !important;
    }
</style>


