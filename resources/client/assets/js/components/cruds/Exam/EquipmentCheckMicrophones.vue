<template>
    <div>
        <section class="border container-fluid min-vh-79">
            <div class="row p-2">
                <div class="col-md-9">
                    <h3><b>Microphone Check</b></h3>
                    <p>This is an opportunity to check that your microphone is working correctly</p>
                    <p>1. Make sure your headset is on and the microphone is in the downward position near your mouth</p>
                    <p>2. When you are ready, click on the <strong style="color :red">Record</strong> button and say 'Testing,testing,one,two,three' into the microphone</p>
                    <p>3. After you have spoken,click on the <strong style="color :red">Stop</strong> button. Your recording is now complete </p>
                    <p>4. Now click on the <strong style="color :red">Playback</strong> button. You should clearly hear yourself speaking</p>
                    <p>5. If you can not hear your voice clearly,please raise your hand to get the attention of the Test Administrator</p>
                    <div class="col-md-5 border p-5 mt-3">
                        <div class="custom-blue-background col-md-12 border-blue p-2">
                            <div class>
                                <h5 class="text-center">Recorded Answer</h5>
                                <p>Current Status: {{status}}</p> 

                                <div class="row">
                                    <audio-record
                                            :start="startRecording"
                                            :stop="stopRecording"
                                            :timeLimit="1"
                                            :uploadUrl="''"
                                            @recordingComplete="onRecordingComplete"
                                    ></audio-record>
                                    
                                    <div class="col-md-12">
                                        <button @click="startAudioRecording" class="btn btn-primary mr-3">Record</button>
                                        <button @click="stopAudioRecording" class="btn btn-primary mr-3">Stop</button>
                                        <button @click="startPlayer" class="btn btn-primary mr-3">Playback</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                      <li>During the test, you will not have <strong style="color :red">Record, Playback</strong> and <strong style="color :red">Stop</strong> buttons. The voice recording will start automatically</li>
                    </div>
                    
                </div>

                <div class="col-md-3 float-left">
                    <h5>This screen is not timed</h5>
                    <img src="/images/headphones.png" width="250px">
                </div>
            </div>
        </section>
        <div class="row mt-2 border-top pt-2 bg-light">
            <div class="col-md-2">
                <div class="float-left ml-4">
                </div>
            </div>
            <div class="col-md-10">
                <div class="float-right mr-4">
                    <button type="button" class="btn btn-primary mb-1" @click="nextQuestion">Next</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
  import { mapActions, mapGetters } from "vuex";
  import AudioPlayer from "../../utils/AudioPlayer.vue";
  import AudioRecord from '../../utils/AudioRecord.vue';
  import AudioRecorder from 'vue-audio-recorder'
Vue.use(AudioRecorder)
  export default {
    data() {
      return {
        // Code...
        playerSeconds: 0,
        startPlaying: false,
        startRecording:false,
        stopRecording:true,
        audioURL: "",
        audio:null,
        status: "Not recording"
      };
    },
    components: {
      AudioPlayer,
      AudioRecord
    },
    computed: {
    },
    created() {
      // Code...
    },
    watch: {},
    methods: {
      callback (data) {
        //console.debug(data)
      },
      startAudioRecording(){
        this.status = "Recording";
        this.startRecording = true;
        this.stopRecording = false;

      },
      stopAudioRecording(){
        this.startRecording = false;
        this.stopRecording = true;
        this.status = "Recorded";
      },
      onRecordingComplete(event){
          console.log("recording complete");
          console.log(event);
          this.audioUrl = URL.createObjectURL(event.blob);
          console.log(this.audioURL);
      },
      startPlayer(){
        this.status = "Playing";                          
        this.audio = new Audio(this.audioUrl);
        console.log("displaying audio", this.audio.getAttribute('src'));
        if(this.audio.getAttribute('src') == null){
            alert("please record audio first");
        }else{
            let vm = this;
            this.audio.play();
            this.audio.onended = function() {
                vm.status = "Playing Complete";
            };
        }        
      },
      stopPlayer(){
        this.startPlaying = false;
      },
      nextQuestion(){
        this.$router.push({
          name: "keyboard",
        });
      },
    }
  };
</script>

<style scoped>
    .border{
        border: 2px solid black !important;
    }
</style>
