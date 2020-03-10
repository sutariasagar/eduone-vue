<template>
    <button v-if="variant" type="button" :class="variant"  @click="routerBack">
         BACK
    </button>
    <button v-else type="button" class="btn btn-default"  @click="routerBack">
        BACK
    </button>
</template>


<script>
export default {
    props: ['variant'],
    data() {
        return {
            // Code...
        }
    },
    created() {
        // Code...
    },
    methods: {
        routerBack() {
            this.$router.go(-1)
        }
    }
}
</script>


<style scoped>

</style>
