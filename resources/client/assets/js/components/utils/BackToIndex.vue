<template>
   <div class='cl-3 pl-3' > 
    <button v-if="variant" type="button" :class="variant"  @click="routerBack">
         BACK
    </button>
    <button v-else type="button" class="btn btn-default"  @click="routerBack">
        BACK
    </button>
    </div>
</template>
<script>
export default {
    props: ['variant','linkname'],
    data() {
        return {
             count: 0
        }
    },
    created() {
        // Code...
    },
    methods: {
        routerBack() {
            console.log("in checking back to index",this.linkname);
            this.$router.push({name: this.linkname})
        }
    }
}
</script>
