<template>

    <video-player  class="video-player-box"
                    ref="videoPlayer"
                    :options="playerOptions"
                    :playsinline="true"
                    customEventName="customstatechangedeventname"
                    @play="onPlayerPlay($event)"
                    @pause="onPlayerPause($event)"
                    @ended="onPlayerEnded($event)"
                    @waiting="onPlayerWaiting($event)"
                    @playing="onPlayerPlaying($event)"
                    @loadeddata="onPlayerLoadeddata($event)"
                    @timeupdate="onPlayerTimeupdate($event)"
                    @canplay="onPlayerCanplay($event)"
                    @canplaythrough="onPlayerCanplaythrough($event)"
                    @statechanged="playerStateChanged($event)"
                    @ready="playerReadied">
    </video-player>
    
</template>

<script>
import 'video.js/dist/video-js.css'

import { videoPlayer } from 'vue-video-player'
export default {
    data() {
        return {
            // Code...
            playerOptions: {
            // videojs options
            muted: true,
            height:190,
            width:200,
            language: 'en',
            sources:this.sources,
            playbackRates: [0.7, 1.0, 1.5, 2.0],            
            poster: "/cleanui/components/dummy-assets/common/img/left-menu-logo.png",
            }
        }
    },
    created() {               
    },
    props:['sources','customId'],
    components: {
        videoPlayer
    },
    mounted(){
        
        console.log('this is current player instance object', this.sources);
    },
    destroyed() {
        
    },
    computed: {  
        player() {
            return this.$refs.videoPlayer.player
        },        
    },
    watch: {
        
    },
    methods: {
        onPlayerPlay(event){            
            //console.log("hcekcing");
            this.$emit("play", this.customId);
        },
        onPlayerPause(event){

        },
        onPlayerEnded(event){

        },
        onPlayerWaiting(event){

        },
        onPlayerPlaying(event){

        },
        onPlayerLoadeddata(event){

        },
        onPlayerTimeupdate(event){

        },
        onPlayerCanplay(event){

        },
        onPlayerCanplaythrough(event){

        },
        playerStateChanged(event){

        },
        playerReadied(){

        }



    }

}
</script>
<style>
.video-js .vjs-big-play-button{
    top:35%;
    left:28%;
}
</style>

