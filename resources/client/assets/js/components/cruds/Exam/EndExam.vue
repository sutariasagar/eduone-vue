<template>
    <section class="container">
        <section class="content-header text-center">
            <h3>You have successfully completed the mock test!</h3>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 mt-5 ">
                    <p>We hope you had a pleasant experience with us and wish that you build upon this experience while taking the real PTE. 
                    </p>
                    <p>You can expect your PTE result to be delivered on your registered E-mail ID within 1 to 5 business days.
                    </p>
                    <p>You can even share your feedback by writing to us at: <a href = "mailto: support@ptetopper.com">support@ptetopper.com </a>
                    </p>
                    <br>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </section>
    </section>
</template>
<script>
  import Vue from 'vue';
  import {mapActions, mapGetters} from "vuex";
  export default {
      data() {
        return {            
            seconds: 5,
            counterMethod: null
        };
    },
    methods:{      
      clearSession(){
            this.$router.push({name: 'dashboard.index'})
        },
        myTimer(){
            this.countDown();
        },
        countDown() {            
            if(this.seconds == 0){
              this.clearSession();
            }else{
              this.seconds = this.seconds - 1;
            }
          },
    },
    destroyed(){
        clearInterval(this.counterMethod);
    },
    mounted(){
      localStorage.clear();
      this.seconds = 5;
      this.counterMethod = setInterval(this.myTimer,1000);      
    },
    created() {
      // Code...
      
    }    
  }
</script>