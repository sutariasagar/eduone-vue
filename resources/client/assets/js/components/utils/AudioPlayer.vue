<template>
    <div>
        <vue-plyr ref="plyr" :options="options" class="d-none">
            <audio preload="none">
                <source :src="src" type="audio/mp3" />
            </audio>
        </vue-plyr>
        <VueSlideBar
                v-model="slider.value"
                :data="slider.data"
                :range="slider.range"
                :labelStyles="{ color: '#1066FD', backgroundColor: '#4a4a4a' }"
                :processStyle="{ backgroundColor: '#d8d8d8' }"
                @callbackRange="callbackRange"
                class="demo-demo">
            <template slot="tooltip" slot-scope="tooltip">
                <img src="/client/images/rectangle-slider.svg">
            </template>
        </VueSlideBar>        
        <b-progress v-if="maxSeconds > 0" :value="playerSeconds" :max="maxSeconds" class="mb-3"></b-progress>
    </div>
</template>

<script>
  import Vue from 'vue'
  import VuePlyr from 'vue-plyr'
  import 'vue-plyr/dist/vue-plyr.css' // only if your build system can import css, otherwise import it wherever you would import your css.
  import VueSlideBar from 'vue-slide-bar'

  Vue.use(VuePlyr)

  export default {
    props: {
      src      : { type: String },
      record   : { type: Object },
      filename : { type: String },
      start: {type: Boolean}
    },
    data() {
      return {
        // Code...
        counterMethod: null,
        playerSeconds: 0,
        maxSeconds: 0,
        options: {
          controls: ['progress', 'volume'],
        },
        audioDuration:0,
        rangeValue: {},
        slider: {
          value: 0.6,
          data: [
            0,
            0.20,
            0.40,
            0.60,
            0.80,
            1
          ],
          range: [
            {
              label: '0',
              isHide: true,
            },
            {
              label: '0.2',
              isHide: true,
            },
            {
              label: '0.4',
              isHide: true,
            },
            {
              label: '0.6',
              isHide: true,
            },
            {
              label: '0.8',
              isHide: true,
            },
            {
              label: '1',
              isHide: true,
            }
          ],
        }
      }
    },
    watch: {
      start: function (value) {
        if(value){
          console.log("starting player");
          this.startPlayer();
        }else{
          this.stopPlayer();
        }
      },
      src: function(value){
        this.maxSeconds = 0;
        this.player.source = {
          type: 'audio',
          title: 'Example title',
          sources: [
            {
              src: value,
              type: 'audio/mp3',
            },
          ],
        };
        //this.maxSeconds = this.player.duration;
      }
    },
    components: {
      VueSlideBar
    },
    computed: {
      player () { return this.$refs.plyr.player }
    },
    mounted(){
      //this.$refs.audioplayer.playNext();
      let vm = this;
      this.maxSeconds = 0;
      this.player.on('ended', function(event){
        // console.log("playing complete event called");
        clearInterval(vm.counterMethod);
        vm.$emit("playingComplete", true);
        // console.log("after emit");
        //clearInterval(this.counterMethod);

      });
      this.player.on("loadedmetadata", function(data){        
        vm.getDuration(data);
        
      });

    },
    methods: {
      myTimer(){
        this.countDown();
      },
      getDuration(data){
        console.log("fetting duration", data);
        this.audioDuration = parseInt(data.detail.plyr.media.duration);
        //this.audioDuration = parseInt(data.player.duration);
      },
      startPlayer(){
        let vm = this;
        this.counterMethod = setInterval(this.myTimer,1000);
        if(this.player){
          this.player.play()
        }        
        
        this.maxSeconds = this.playerSeconds = parseInt(this.audioDuration);
        //console.log("duration dcc", this.player.duration);
      },
      callbackRange (val) {
        this.player.volume = parseFloat(val.label);
      },
      countDown(){
        if(this.playerSeconds < 1) {
          this.playerSeconds = 0;
        }
        else{
          this.playerSeconds -= 1;
        }
        // console.log("player seconds in audio player", this.playerSeconds);
          //console.log(this.playerSeconds)
      },
      stopPlayer(){
        this.player.stop()
        this.maxSeconds = 0;
        this.playerSeconds = 0;
        window.clearInterval(this.counterMethod);
      }
    }
  }
</script>
