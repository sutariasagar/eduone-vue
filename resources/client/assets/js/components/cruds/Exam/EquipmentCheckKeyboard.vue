<template>
    <div>
        <section class="border container-fluid min-vh-79">
            <div class="row p-2">
                <div class="col-md-9">
                    <h3><b>Keyboard Check</b></h3>
                    <p>This is an opportunity to check that you have the correct keyboard</p>
                    <p>1. Look at the top row of letters on the Keyboard</p>
                    <p>2. The letters should appear in this order Q W E R T Y</p>
                    <p>3. If you do not have a QWERTY Keyboard, raise your hand to get the attention of the Test Administrator </p>
                    <div class="col-md-5 border p-5 mt-3">
                      <div class="text-center">
                          <h5>Checking Keyboard</h5>
                          <input type="text" class="keyboard-focus" autofocus>
                      </div>
                    </div>
                </div>

                <div class="col-md-3 float-left">
                    <h5>This screen is not timed</h5>
                    <div class=" mt-3">
                        <img src="/images/qwerty.png" width="250px">
                    </div>
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
    mounted(){
       // document.getElementsByClassName('keyboard-focus').focus();
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
          name: "home",
        });
      },
    }
  };
</script>

<style scoped>
    .border{
        border: 2px solid black !important;
    }
    .keyboard-focus{
        border-style: inset !important;
    }
</style>
