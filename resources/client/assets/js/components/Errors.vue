<template>
    <div>
        <span v-if="errors && errors[name]" class="text-danger">
            {{ errors[name][0] }}
        </span>
        <span v-else>

        </span>
    </div>

</template>


<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data() {
            return {
                // Code...
            }
        },
        props: ['name'],
        computed: {
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            // Code...
//            this.resetState();
        },
        destroyed() {
            this.resetState();
        },
        methods: {
            ...mapActions('Alert', ['resetState'])
        }
    }
</script>


<style scoped>
    .row-alert {
        padding: 10px;
    }
</style>
