<template>
    <section style="min-height: 700px;" class="container-fluid">
        <section class="content-header text-center">
            <h3 class="pt-5">Exam Instructions</h3>
        </section>

        <section class="content">
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center">
                    <div v-html="item.start_instructions">
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                <div class="text-center">
                    <button type="button" class="btn btn-primary " @click="startTest"> Continue </button>
                </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
  import {mapActions, mapGetters} from "vuex";
  export default {
    data() {
      return {
        // Code...
        checked: false
      }
    },
    computed: {
      ...mapGetters('StudentExam', ['item', 'loading']),
      ...mapGetters('Alert', ['errors'])
    },
    created() {
      // Code...
    },
    watch: {
    },
    methods: {
      ...mapActions("StudentExam", [
        "startExam"
      ]),
      startTest(){
        this.$router.push({name: 'exam.introduction'})
      }
    }
  }
</script>

<style scoped>

</style>
