<template>
    <section style="min-height: 700px;" class="container-fluid">
        <section class="content-header text-center">
            <h3 class="pt-5"> Part I: Speaking and writing </h3>
        </section>

        <section class="content">
            <div class="row">
               <div class="col-md-2">
                </div>
                <div class="col-md-8 mt-5">
                    <p v-if="item.speakingsection.timer == 'section_wise'">Time allowed for speaking section is {{item.speakingsection.min_time}} - {{item.speakingsection.min_time}}</p>
                    <p>You are about to start the Speaking and writing part of the PTE Academic.</p>
                    <p>This part may be 77 minutes to 93 minutes long.</p>
                    <p>Please note the following:</p>
                    <p>1. Read the instructions carefully before answering any question.</p>
                    <p>2. If you do not speak for 3 seconds, the microphone will automatically close and whatever you speak into the microphone will not be recorded. So, make sure that you keep speaking while answering the speech-based questions.</p>
                    <p>3. You will get an overall 0 on a writing task for which you get a 0 score on either Form or Content parameters.</p>
                    <p>4. For any questions or difficulties during the test, please raise your hand and try to get the attention of the test administrator.</p>
                    <p>5. Kindly do not shout at the top of your voice and cause distraction to other test takers while answering speech-based questions.</p>
                </div>
                 <div class="col-md-2">
                  </div>
            </div>


        </section>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <button type="button" class="btn btn-primary " @click="next"> Next </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
  import {mapActions, mapGetters} from "vuex";

  export default {
    data() {
      return {
        // Code...
        disableNavigation: true
      }
    },
    components:{

    },
    computed: {
      ...mapGetters('StudentExam', ['item', 'loading']),
      ...mapGetters('Alert', ['errors'])
    },
    mounted(){
    },
    created() {
      // Code...
    },
    watch: {
    },
    methods: {
      ...mapActions("StudentExam", [
        "startExam"
      ]),
      next(){
        //{ name: 'user', params: { userId } }
        let questionId = 1;
        this.$router.push({name: 'exam.speaking.questions', params:{'id': questionId }})
      },
      callback (msg) {
        console.debug('Event: ', msg)
      },
      onRecordingComplete(event){
        console.log("yes are getting event in parent", event);
        this.disableNavigation = false;
      }
    }
  }
</script>

<style scoped>

</style>
