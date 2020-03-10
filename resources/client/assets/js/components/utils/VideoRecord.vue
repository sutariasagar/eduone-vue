<template>
    <video id="myVideo" class="video-js"></video>
</template>

<script>
  import 'video.js/dist/video-js.css'
  import 'videojs-record/dist/css/videojs.record.css'

  import videojs from 'video.js'
  import Record from 'videojs-record/dist/videojs.record.js'
  export default {
    data() {
      return {
        player: '',
        options: {
          controls: false,
          autoplay: false,
          fluid: false,
          loop: false,
          width: 320,
          height: 240,
          maxLength:20,
          controlBar: {
            volumePanel: true
          },
          plugins: {
            // configure videojs-record plugin
            record: {
              audio: true,
              video: true,
              debug: true
            }
          }
        }
      };
    },
    mounted() {
      /* eslint-disable no-console */
      let vm = this;
      this.player = videojs('#myVideo', this.options, () => {
        // print version information at startup
        var msg = 'Using video.js ' + videojs.VERSION +
          ' with videojs-record ' + videojs.getPluginVersion('record') +
          ' and recordrtc ' + RecordRTC.version;
        videojs.log(msg);
      });
      //this.player.start();
      // device is ready
      this.player.on('deviceReady', () => {
        vm.player.record().start();
      });

      // user clicked the record button and started recording
      this.player.on('startRecord', () => {
        console.log('started recording!');
      });

      // user completed recording and stream is available
      this.player.on('finishRecord', () => {
        // the blob object contains the recorded data that
        // can be downloaded by the user, stored on server etc.
        console.log('finished recording: ', this.player.recordedData);
      });

      // error handling
      this.player.on('error', (element, error) => {
        console.warn(error);
      });

      this.player.on('deviceError', () => {
        console.error('device error:', this.player.deviceErrorCode);
      });
    },
    beforeDestroy() {
      if (this.player) {
        this.player.dispose();
      }
    }
  }
</script>