<template>
    <section class="container-fluid">
        <section class="content-header text-center">
            <h3 class="pt-5"><strong>Personal Introduction</strong></h3>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 mt-2">

                    <div v-if="item.instruction_type =='video'">
                        <p class="font-weight-bold font-italic">Read the prompt below. In 25 seconds, you must reply in your own words, as naturally and clearly as possible. You have 30 seconds to record your response. Your response will be sent together with your score report to the institutions selected by you.</p>
                        <video-record ></video-record>
                    </div>
                    <div v-if="item.instruction_type =='audio'">
                        <p class="font-weight-bold font-italic">Read the prompt below. In 25 seconds, you must reply in your own words, as naturally and clearly as possible. You have 30 seconds to record your response. Your response will be sent together with your score report to the institutions selected by you.</p>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        </div>
                        <div class="custom-blue-background col-md-4 border-blue p-2">
                        <div class>
                            <h5 class="text-center">Recorded Answer</h5>
                            <p>Current Status</p>
                            <p v-if="delay > 0">Beginning in {{delay}} seconds</p>
                            <p v-else-if="delay == 0 && disableNavigation ">Recording</p>
                            <p v-else="">Completed</p>
                            <div>
                                <b-progress v-if="delay > 0"
                                        :value="delay"
                                        :max="25"
                                        class="mb-3"
                                ></b-progress>
                                <b-progress v-else=""
                                            :value="recordingTime"
                                            :max="30"
                                            class="mb-3"
                                ></b-progress>
                              <audio-record :start='startRecording' :stop='stopRecording' :timeLimit="0.50" :uploadUrl="'/api/v1/introaudio'" @recordingComplete="onRecordingComplete"></audio-record>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <p>Please introduce yourself. For example, you could talk about one or more of the following:<br>
                            - Your interests<br>
                            - Your plans for future study<br>
                            - Why you want to study abroad<br>
                            - Why you need to learn English<br>
                            - Why you chose this test</p>
                    </div>

                    <div v-if="!disableNavigation">
                          <strong>Recording is finished. Kindly click on the "Next" button to proceed further.</strong> 
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="row pb-5">
                <div class="col-md-12 mt-4">
                    <div class="text-center">
                        <button :disabled="disableNavigation" type="button" class="btn btn-primary " @click="next"> Next </button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
  import Vue from 'vue';
  import {mapActions, mapGetters} from "vuex";  
  import VideoRecord from '../../utils/VideoRecord.vue';
  import AudioRecord from '../../utils/AudioRecord.vue';
  export default {
    data() {
      return {
        // Code...
        disableNavigation: true,
        startRecording:false,
        stopRecording:true,
        delay:25,
        recordingTime:30,
      }
    },
    components:{
      VideoRecord,
      AudioRecord
    },
    computed: {
      ...mapGetters('StudentExam', ['item', 'loading']),
      ...mapGetters('Alert', ['errors'])
    },
    mounted(){
      //this.startExam();
    },
    created() {
      // Code...
      this.$nextTick(function() {
        window.setInterval(() => {
          this.countDown();
        }, 1000);
      });
    },
    watch: {
    },
    methods: {
      ...mapActions("StudentExam", [
        "startExam"
      ]),
      next(){
        console.log("Let us target to complete till here");
        this.$router.push({name: 'exam.speaking'})
      },
      callback (msg) {
        console.debug('Event: ', msg)
      },
      onRecordingComplete(event){
        console.log("yes are getting event in parent", event);
        this.disableNavigation = false;
      },
      countDown() {
        if (this.delay > 0) {
          this.delay = this.delay - 1;
        }else{
          if(this.recordingTime > 0)
            this.recordingTime-= 1
        }
        if(this.delay == 0){
          this.startRecording = true;
        }
        if(this.recordingTime == 0){
          this.startRecording = false;
          this.stopRecording = true;
        }
      },

    }
  }
</script>

<style scoped>
.custom-blue-background {
    background-color: #ddf2ff;
    color: black;
}
.border-blue {
    border: 1px solid #8ebaff;
}

</style>
