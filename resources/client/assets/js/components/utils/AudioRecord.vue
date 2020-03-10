<template>
    <div class="d-none">
        <audio-recorder :ref="'audio'" :upload-url="uploadUrl"
                        :attempts="3"
                        :time="timeLimit"
                        :headers="headers"
                        :before-recording="beforeRecording"
                        :pause-recording="callback"
                        :after-recording="recordingComplete"
                        :select-record="callback"
                        :before-upload="callback"
                        :successful-upload="callback"
                        :failed-upload="callback"
                        :show-download-button="false"
                        :show-upload-button="true"
        />
    </div>
</template>

<script>
    import Vue from 'vue';
    import axios from 'axios';
    Vue.prototype.$http = axios
    import AudioRecorder from 'vue-audio-recorder'
    import {mapActions, mapGetters} from "vuex";
    Vue.use(AudioRecorder);
  export default {
    mounted(){
      if(this.start){
        this.$refs.audio.recorder.start()
      }
      //
    },
    data(){
      return{
        isRecordingStarted:false,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        }
      }
    },
    props: ['uploadUrl','timeLimit','start','stop','questionID'],
    computed: {
      ...mapGetters('StudentExam', ['item', 'loading']),
      ...mapGetters('Alert', ['errors'])
    },
    watch:{
      start: function (val) {
        if(val){
          console.log("we are starting recording");
          this.isRecordingStarted = true;
          this.$refs.audio.recorder.start();
        }
      },
      stop: function (val) {
        console.log("checking data");
        if(val){

          if(this.isRecordingStarted){
            console.log("we are stoping recording");
            this.$refs.audio.recorder.stop();
          }

        }
      },
    },
    methods: {
      callback(event){
        console.log(event);
      },
      beforeRecording(){
        this.isRecordingStarted = true;
      },
       recordingComplete(event){
        console.log("we completed recording", event);
        if(this.uploadUrl != ""){
            this.uploadRecording(event);
        }else{
          this.$emit('recordingComplete', event)
        }
      },

      async uploadRecording(event){
         console.log("uploading ");
        this.isRecordingStarted = false;
        let vm = this;
        let URL = this.uploadUrl;

        const data = new FormData()
        data.append('audio', event.blob, `${event.id}.mp3`)
        data.append('exam_id', this.item.id);        
        data.append('question_id',this.questionID)        
        const headers = Object.assign(this.headers, {})
        //headers['Content-Type'] = `multipart/form-data; boundary=${data._boundary}`

        axios.post(URL, data, headers).then(response => {
          console.log('response', response)
        }).catch(error => {
          console.log('error', error)
        })
        vm.$emit('recordingComplete', event)
      }
    }
  };
</script>