<template>
    <!--<input :id='id' type="text" @change="updateAnswer"/>-->
    <select @change="updateAnswer" class="custom-dropdown">
        <option value=""></option>
        <option v-for="suggestion in dropdownSuggestions" :value="suggestion.text">{{suggestion.text}}</option>
    </select>
</template>
<script>
  export default {
    props: ['id', 'suggestions','removeSelect'],
    data(){
      return {

      }
    },
    computed: {
      dropdownSuggestions: function () {
        let id = this.id.substring(3).trim();
        id = id.substring(0, id.length-1);
        //console.log("id", id, this.id);
        return this.suggestions[parseInt(id)-1]
      }
    },
    methods:{
      updateAnswer(event){
        if(event.target[0].value == "")
          event.target.remove(0);
        console.log(this.id.substring(0,5));
        this.$emit("change", this.id.substring(0,5), event.target.value);
      }
    }
  }
</script>