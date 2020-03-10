<template>
    <div header-tag="div" class="accordion" role="tab">
        <div class="border-bottom-blue" role="tab" v-b-toggle="to">
            <div class="card-title pr-3 pl-3">
                            
              <span class="accordion-indicator pull-right">
                <i class="plus fa fa-plus text-primary"></i>
                <i class="minus fa fa-minus text-primary"></i>
              </span>

                <h5 class="text-black">
                    <strong>{{ heading }}</strong>
                </h5>
            </div>
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
        props: ['heading', 'to'],
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
