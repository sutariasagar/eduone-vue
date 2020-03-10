<template>
    <div>
    <section class="border container-fluid min-vh-79">
        <div class="row p-2">
            <div class="col-md-9">
                <h3><b>Headset Check</b></h3>
                <p>This is an opportunity to check whether your headset is working correctly or not.</p>
                <p>Keep this in mind while you test your headset:</p>
                <p>1. Put your headset on and adjust so that it so that it is comfortably placed over your ears.</p>
                <p>2. When you are ready, click on the <strong>Play</strong> button. You will hear a short recording.</p>
                <p>3. If you do not hear anything in your headset while the status reads <strong>Playing,</strong> raise your hand to get the attention of the test administrator.</p>
                <div class="col-md-5 border p-5 mt-3">
                    <div class>
                        <p v-if="!startPlaying">Status: Click play to begin</p>
                        <p v-else="">Status: Click stop to stop player</p>
                        <div>
                        <audio-player
                                :start="startPlaying"
                                :src="'/private-audio/welcome-to-our-mock-test.mp3'"
                        ></audio-player>
                        <div>
                            <!--<b-progress :value="playerSeconds" :max="15" class="mb-3"></b-progress>-->
                            <button @click="startPlayer" class="btn btn-primary float-left">Start</button>
                            <button @click="stopPlayer" class="btn btn-primary float-right">Stop</button>
                        </div>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <li>During the test, you will not have <strong style="color:red">Play</strong> and <strong style="color:red">Stop</strong> buttons. The audio recording will start playing automatically.</li>
                    <li>Please do not remove your headset. You should wear it throughout the test.</li>
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
  import { mapActions, mapGetters } from "vuex";
  import AudioPlayer from "../../utils/AudioPlayer.vue";
  export default {
    data() {
      return {
        // Code...
        playerSeconds: 0,
        startPlaying: false,
      };
    },
    components: {
      AudioPlayer,
    },
    computed: {
    },
    created() {
      // Code...
    },
    watch: {},
    methods: {
        startPlayer(){
            this.startPlaying = true;
        },
        stopPlayer(){
          this.startPlaying = false;
        },
        nextQuestion(){
          this.$router.push({
            name: "microphones",
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
