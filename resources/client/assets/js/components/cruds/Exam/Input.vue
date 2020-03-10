<template>
    <input v-on:drop="drop" class="dragdrop text-center" v-on:dragstart="drag" draggable="true" v-on:focus="beforeChange" v-on:dragover="allowDrop" :id='id' type="text" @change="updateAnswer"/>
</template>
<script>
  export default {
    props: ['id'],
    mounted() {
      console.log("in mounted");
    },
    methods:{
      updateAnswer(event){
        this.$emit("change", this.id, event.target.value);
      },
      drop(ev){
        ev.preventDefault();
        let currentValue = ev.target.value;
        if(currentValue !== ""){
          this.$emit('addToSuggestion', currentValue);
        }
        var data = ev.dataTransfer.getData("value").trim();
        //console.log(data);
        ev.target.value = data;
        this.updateAnswer(ev);
      },
      allowDrop(ev){
        ev.preventDefault()
      },
      drag(ev){
        console.log("started dragging", ev.target);
        ev.dataTransfer.setData("value", ev.target.value);
        ev.target.value = "";
      },
      beforeChange(ev){
        console.log("in beforeChange");
        // ev.dataTransfer.setData("value", ev.target.value);
        // ev.target.value = "";
      }
    }
  }
</script>
<style scoped="">
.dragdrop{
    height: 20px;
}
</style>