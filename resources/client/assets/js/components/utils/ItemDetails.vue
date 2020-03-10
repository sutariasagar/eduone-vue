<template>
    <div class="row border-bottom-1 my-3">
            <div class="col-md-12 mt-1">
                <strong>{{ heading }} :</strong>
            </div>
            <div class="col-md-12 mb-1" v-if="value">
                <span> {{ value }}</span>
            </div>
            <div class="col-md-12 mb-1" v-else>
                <span class="text-muted"> ####### </span>
            </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                // Code...
            }
        },
        props: ['heading','value'],
        created() {
            // Code...
        },
        watch: {

        },
        methods: {

        }
    }
</script>


<style scoped>

</style>
