<template>
    <section class="container-fluid">
        <section class="content-header text-center">
            <h3>Optional Break</h3>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <p>You may now take a break of up to 10 minutes. If you want to take a break you must leave the testing room. You should allow up to 5 minutes to sign back in and be seated. If you spend more than 10 minutes in total on the break, the time is taken from the next part.
                    </p>
                      <li class="pl-3">If you want to take a break, raise your hand to get the attention of the test administrator.</li>
                      <li class="pl-3">If you do not want to take a break, click on the Next button below to continue the test.</li>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 mt-3">
                    <div class="text-center">

                        <button type="button" class="btn btn-primary mb-3" @click="startSection"> Restart Exam </button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
  import Vue from 'vue';
  import {mapActions, mapGetters} from "vuex";
  export default {
    methods:{
      ...mapActions("StudentExam", [
        "setLastQuestion",
      ]),
      startSection(){
        this.setLastQuestion();
        this.$router.push({name: 'exam.listeningsst.questions', params: {'id': 1}})
      }
    }
  }
</script>