<template>
    <b-collapse :id="uniqueId" class="mt-1" :visible="visible" >
        <div class="mt-3 p-3">
            <slot></slot>
        </div>
    </b-collapse>
</template>

<script>
    export default {
        data() {
            return {
                // Code...
            }
        },
        props: {
            uniqueId:{
                type: String
            },
            visible: {
                type: Boolean,
                default: true,
                required: false
            },
            chapterId:{
                type:Number,
                required: false
            },
            subjectId:{
                type:Number,
                required: false
            }
        },
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
