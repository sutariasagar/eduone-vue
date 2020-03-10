<template>
    <div>
        <div class="border container-fluid min-vh-79 pb-5 ">
            <section-timer v-if="item.questions.speaking_timer" :item="item" :section="'speaking'"></section-timer>
            <div v-if="question">
                <div class="row" v-if="question.header">
                    <div class="col-md-12">
                        <p class="question-header" v-html="question.header"></p>
                    </div>
                </div>
                <!-- This is for Image -->
                <div
                        class="row mt-2 mb-5"
                        v-if="question.question_details && question.question_details.image_upload"
                >
                    <div class="col-md-6">
                        <img id="imagequestion" width="600px" height="450px" :src="$MAIN_APP_EXAM_URL+question.question_details.image_upload.data.file_link_url[0]">
                    </div>

                    <div class="col-md-6">
                        <div
                                class="row mt-5"
                                v-if="question.question_details && question.question_details.audio_upload"
                        >
                            <div
                                    class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                            >
                                <div class="col-md-8 border p-2">
                                    <div class>
                                        <p v-if="playerSeconds > 0">Status: Beginning in {{playerSeconds}} seconds</p>
                                        <p v-else-if="playerSeconds == 0 && !startRecordingCountDown">Status: Playing</p>
                                        <p v-else> Status: Completed</p>
                                        <audio-player
                                                :start="startPlaying"
                                                @playingComplete="onPlayingComplete"
                                                :src="verifyURL($MAIN_APP_EXAM_URL+question.question_details.audio_upload.data.file_link_url[0])"                                                
                                        ></audio-player>
                                        <div>
                                            <b-progress v-if="playerSeconds > 0" :value="playerSeconds" :max="question.preparation_time" class="mb-3"></b-progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-5" v-if="question.preparation_time && question.preparation_time > 0">
                            <div
                                    class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                            >
                                <div class="custom-blue-background col-md-8 border-blue p-2">
                                    <div class>
                                        <h5 class="text-center">Recorded Answer</h5>
                                        <p>Current Status</p>
                                        <div v-if="question.question_details && question.question_details.audio_upload">
                                          <p v-if="!startRecording"> Playing</p>
                                          <p v-else-if="seconds > 0">Beginning in {{seconds}} seconds</p>
                                          <p v-else>Recording</p>
                                        </div>
                                        <div v-else>                                          
                                          <p v-if="seconds > 0">Beginning in {{seconds}} seconds</p>
                                          <p v-else>Recording</p>
                                        </div>
                                        
                                        
                                        <div>
                                            <b-progress v-if="seconds > 0"
                                                        :value="seconds"
                                                        :max="question.preparation_time"
                                                        class="mb-3"
                                            ></b-progress>
                                            <b-progress v-else
                                                        :value="recordingSeconds"
                                                        :max="question.attempt_time"
                                                        class="mb-3"
                                            ></b-progress>
                                            <audio-record
                                                    :start="startRecording"
                                                    :stop="stopRecording"
                                                    :questionID="question.id"
                                                    :timeLimit="parseFloat((question.attempt_time/60).toFixed(2))"
                                                    :uploadUrl="'/api/v1/answers/speaking'"
                                                    @recordingComplete="onRecordingComplete"
                                            ></audio-record>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                                class="row mt-5"
                                v-if="question.question_details && question.question_details.html_text"
                        >
                            <div
                                    class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                            >
                                <div class="col-md-8 p-2">
                                    <div class="text-justify">
                                        <p v-html="question.question_details.html_text"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- this is for audio -->

                <div v-else>
                    <div
                            class="row mt-5 check"
                            v-if="question.question_details && question.question_details.audio_upload"
                    >
                        <div
                                class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                        >
                            <div class="col-md-4 border p-2">
                                <div class>
                                    <p v-if="playerSeconds > 0">Status: Beginning in {{playerSeconds}} seconds</p>
                                    <p v-else-if="playerSeconds == 0 && !startRecordingCountDown">Status: Playing</p>
                                    <p v-else> Status: Completed</p>
                                    <audio-player
                                            :start="startPlaying"
                                            @playingComplete="onPlayingComplete"
                                            :src="verifyURL($MAIN_APP_EXAM_URL+question.question_details.audio_upload.data.file_link_url[0])"                                                                                            
                                    ></audio-player>
                                    <div>
                                        <b-progress v-if="playerSeconds > 0" :value="playerSeconds" :max="question.preparation_time" class="mb-3"></b-progress>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div
                                class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                        >
                            <div class="custom-blue-background col-md-4 border-blue p-2">
                                <div class>
                                    <h5 class="text-center">Recorded Answer</h5>
                                    <p>Current Status</p>
                                    <p v-if="!startRecordingCountDown && playerSeconds == 0"> Playing</p>
                                    <p v-else-if="seconds > 0">Beginning in {{seconds}} seconds</p>
                                    <p v-else>Recording</p>
                                    <div>
                                        <b-progress v-if="seconds > 0"
                                                    :value="seconds"
                                                    :max="question.preparation_time"
                                                    class="mb-3"
                                        ></b-progress>
                                        <b-progress v-else
                                                    :value="recordingSeconds"
                                                    :max="question.attempt_time"
                                                    class="mb-3"
                                        ></b-progress>
                                        <audio-record
                                                :start="startRecording"
                                                :stop="stopRecording"
                                                :questionID="question.id"
                                                :timeLimit="parseFloat((question.attempt_time/60).toFixed(2))"
                                                :uploadUrl="'/api/v1/answers/speaking'"
                                                @recordingComplete="onRecordingComplete"
                                        ></audio-record>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                            class="row mt-5"
                            v-if="question.question_details && question.question_details.html_text"
                    >
                        <div
                                class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                        >
                            <div class="col-md-6 p-2">
                                <div class="text-justify">
                                    <p v-html="question.question_details.html_text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <question-footer :section="'speaking'" :item="item" :lastQuestion="lastQuestion" v-on:next="next" v-on:endSection="endSection">
        </question-footer>
    </div>
</template>

<script>
  import Vue from "vue";
  import { mapActions, mapGetters } from "vuex";
  import VideoRecord from "../../utils/VideoRecord.vue";
  import AudioRecord from "../../utils/AudioRecord.vue";
  import AudioPlayer from "../../utils/AudioPlayer.vue";
  import QuestionFooter from "./QuestionFooter.vue";
  import SectionTimer from './SectionTimer.vue';

  export default {
    data() {
      return {
        counterMethod: null,
        playerCounterMethod: null,
        startRecording: false,
        stopRecording: true,
        timeLimit: 10,
        seconds: 0,
        playerSeconds: 0,
        startPlaying: false,
        startRecordingCountDown: true,
        recordingEvent: false,
        recordingSeconds: 0,
      };
    },
    components: {
      VideoRecord,
      AudioRecord,
      AudioPlayer,
      QuestionFooter,
      SectionTimer
    },
    computed: {
      ...mapGetters("StudentExam", [
        "item",
        "loading",
        "question",
        "lastQuestion"
      ]),
      ...mapGetters("Alert", ["errors"])
    },
    created() {
      // Code...
      console.log("checking its coming in created everytime");
      this.fetchSingleQuestion({
        id: this.$route.params.id,
        section: "speaking"
      });
      this.recordingEvent = false;
      this.seconds = this.question.preparation_time;
      if(this.question.question_details.audio_upload){
        this.playerSeconds = this.question.preparation_time;
        this.startRecordingCountDown = false;
      }
      else
        this.playerSeconds = 0;

      //this.recordingSeconds = parseFloat((this.question.attempt_time/60).toFixed(2))
    },
    mounted() {
      this.recordingSeconds = 0;
      //if(this.question.question_details && this.question.question_details.audio_upload)
      this.recordingSeconds = this.question.attempt_time;

      this.counterMethod = setInterval(this.myTimer,1000);
      this.playerCounterMethod = setInterval(this.myPlayerTimer,1000);
    },
    watch: {
      "$route.params.id": function() {
        this.resetQuestionState();
        if(document.getElementById('imagequestion'))
          document.getElementById('imagequestion').setAttribute('src','');
        this.fetchSingleQuestion({
          id: this.$route.params.id,
          section: "speaking"
        });
        console.log("chcking last question in questions",this.lastQuestion);
        //this.recordingSeconds = parseFloat((this.question.attempt_time/60).toFixed(2))
        this.seconds = this.question.preparation_time;
        if(this.question.question_details.audio_upload){
          this.playerSeconds = this.question.preparation_time;
          this.startRecordingCountDown = false;
          this.startPlaying = false;
          this.startRecording = false;
          this.recordingEvent = false;
          //if(this.playerCounterMethod == null)
          console.log(typeof this.playerCounterMethod);
            this.playerCounterMethod = setInterval(this.myPlayerTimer,1000);
        }
        else{
          this.playerSeconds = 0;
          this.startRecordingCountDown = true;
          //this.startPlaying = false;
        }
        //if(this.question.question_details && this.question.question_details.audio_upload)
        this.recordingSeconds = this.question.attempt_time;
        this.counterMethod = setInterval(this.myTimer,1000);

        //this.counterMethod = setInterval(this.myTimer,1000);

      }
    },
    destroyed() {
      console.log("checking its coming in destroyed everytime");
      this.resetQuestionState();
    },
    methods: {
      ...mapActions("StudentExam", [
        "startExam",
        "fetchSingleQuestion",
        "resetQuestionState",
        "saveAnswer",
        "setAnswer",
        "setLastQuestion"
      ]),
      verifyURL(url){
            return url.replace('.com//','.com/');
        },
      myTimer(){              
        if (this.startRecordingCountDown) {
          this.countDown();
        }
      },
      myPlayerTimer(){
        if (this.question.question_details && this.question.question_details.audio_upload && this.playerSeconds > 0) {
          console.log("in my player time")
          this.playerCountDown();
        }else if(this.question.question_details && this.question.question_details.audio_upload && this.playerSeconds == 0){
          this.startPlayer();
        }else{
          //console.log("clearing player counter");
          //clearInterval(this.playerCounterMethod)
        }
      },
      handleCountdownEnd() {
        console.log("handle countdown end");
      },
      onRecordingComplete() {
        this.recordingEvent = true;
        this.startRecording = false;
        this.next();
      },
      next() {
        // console.log("checking start recording", this.startRecording);
        if(!this.startRecording){
          this.stopQuestion();
//            this.saveAnswer();
          window.clearInterval(this.playerCounterMethod);
          window.clearInterval(this.counterMethod);
          if(this.lastQuestion){
            this.$router.push({name: 'exam.writing.questions', params: {'id': 1}})
          }else{
            this.$router.push({
              name: "exam.speaking.questions",
              params: { id: parseInt(this.$route.params.id) + 1 }
            });
          }

        }else{
          this.stopQuestion();
        }

      },
      countDown() {
        let tempSeconds = this.seconds;
        if (this.seconds >= 0) {
          if (this.seconds == 0) {
//            if(this.lastQuestion){
//              this.endSection();
//            }else{
              this.startQuestion();
            //}
          }
          this.seconds = this.seconds - 1;
        }else{
              console.log("checking recording seconds", this.recordingSeconds);
//              console.log("checking attempt time", this.question.attempt_time)
          if(this.recordingSeconds > 0){
            this.recordingSeconds -= 1;
            //console.log("checking recording seconds increment", this.recordingSeconds);
          }
        }
      },
      playerCountDown() {
        if (this.playerSeconds == 0) {
          this.startPlayer();
        }
        this.playerSeconds = this.playerSeconds - 1;
      },
      startPlayer() {
        this.startAudioPlayer();
      },
      startQuestion() {
        this.startAudioRecording();
      },
      stopQuestion() {
        this.stopAudioRecording();
      },
      startAudioPlayer() {
        this.startPlaying = true;
      },
      startAudioRecording() {
        console.log("before",this.startRecording);
        this.startRecording = true;
        this.stopRecording = false;
        console.log(this.startRecording);
      },
      stopAudioRecording() {
        this.startRecording = false;
        this.stopRecording = true;
      },
      onPlayingComplete(value) {
        console.log("on playing complete event for paretnt");
        if(value){
          this.startRecordingCountDown = true;

        }

      },
      endSection() {
        console.log("in end question");
        this.saveAnswer();
        //this.$router.push({ name: "exam.writing" });
        //this.setLastQuestion();
        this.$router.push({name: 'exam.writing.questions', params: {'id': 1}})
      }
    }
  };
</script>

<style scoped>
    .border{
        border: 2px solid black !important;
    }
    .myQuestion.active {
        display: block;
    }
    .custom-blue-background {
        background-color: #ddf2ff;
        color: black;
    }
    .border-blue {
        border: 1px solid #8ebaff;
    }
    .question-header {
        font-style: italic;
        font-weight: bold;
    }
</style>