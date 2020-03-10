<template>
    <div class=" container-fluid mb-2 mt-3 border-top pt-2 pb-2 bg-light bg-white">
        <div class="row">
        <input type="hidden" class="settingfocus">
        <div class="col-md-4">
            <div class="float-left ml-4">
                <question-counter :item="item" :section="section"> </question-counter>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <check-online-office></check-online-office>
            </div>
        </div>
        <div class="col-md-4">
            <div class="float-right mr-4">
                <button type="button" class="btn btn-primary" @click="nextQuestion">Next</button>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
  import Vue from 'vue'
  import QuestionCounter from './QuestionCounter.vue';  
  import CheckOnlineOffice from './CheckOnlineOffline.vue'
  export default {
    props: ['item', 'lastQuestion', 'section'],
    components:{
      QuestionCounter,
      CheckOnlineOffice      
    },
    watch: {
        "$route.params": function() {
            console.log("route changed in footer");
            window.scrollTo(0,0);
        }
    },
    data: () => ({
        onLine: null,
        onlineSlot: 'online',
        offlineSlot: 'offline',
    }),
    updated(){
        console.log("footer called");
        window.scrollTo(0,0);
    },
    methods:{
        amIOnline(e) {
            this.onLine = e;
        },
      nextQuestion: function(event){
        console.log("chcking in footer", this.lastQuestion);        
        event.target.blur();
        //document.getElementsByClassName('settingfocus')[0].focus();
        if(this.lastQuestion)
          this.$emit("endSection",true);
        else
          this.$emit("next", true);
      }
    }
  }

</script>
<style scoped="">
    .fixed-footer{
        position: fixed;
        bottom: 20px;
        width: 100%;
    }
    .bg-white {
        background-color: white !important;
    }
    /* .offline {
        background-color: #fc9842;
        background-image: linear-gradient(315deg, #fc9842 0%, #fe5f75 74%);
    }
    .online {
        background-color: #00b712;
        background-image: linear-gradient(315deg, #00b712 0%, #5aff15 74%);
    } */
</style>
