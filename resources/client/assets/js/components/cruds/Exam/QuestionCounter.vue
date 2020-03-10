<template>
    <p class="">Item: {{current}} of {{total}}</p>
</template>
<script>
  import Vue from 'vue'
  export default {
    props: ['item','section'],
    methods:{
    },
    computed: {
      total () {
        if(this.section == 'speaking')
            return this.item.questions[this.section].length + this.item.questions.writing.length
        else if(this.section == 'writing')
          return this.item.questions[this.section].length + this.item.questions.speaking.length
        else if(this.section == 'listeningsst')
          return this.item.questions[this.section].length + this.item.questions.listeningrol.length
        else if(this.section == 'listeningrol')
          return this.item.questions[this.section].length + this.item.questions.listeningsst.length
        else
          return this.item.questions[this.section].length
      },
      current (){
        if(this.section == 'writing')
          return this.item.questions.speaking.length + parseInt(this.$route.params.id)
        else if(this.section == 'listeningrol')
          return this.item.questions.listeningsst.length + parseInt(this.$route.params.id)
        else
            return parseInt(this.$route.params.id)
      }
    },
  }
</script>