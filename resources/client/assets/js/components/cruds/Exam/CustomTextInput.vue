<template>
    <input class="dragdrop text-center"  :id='id' type="text" @change="updateAnswer"/>
</template>
<script>
  export default {
    props: ['id'],
    mounted() {
      console.log("in mounted");
    },
    methods:{
      updateAnswer(event){
        let value = event.target.value;
        this.$emit("change", this.id.substring(0,5), event.target.value);
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