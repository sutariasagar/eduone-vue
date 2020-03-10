<template>
    <div class="row row-alert" v-if="message">
        <div class="col-xs-6 col-md-12 col-">
            <div class="alert" :class="'alert-' + color">
                <p>
                    <i class="icon fa fa-check" v-if="color == 'success'"></i>
                    <i class="icon fa fa-ban" v-if="color == 'danger'"></i>
                    {{ message }}
                </p>
            </div>
        </div>
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
    prop:{
      name: ""
    },
    computed: {
        ...mapGetters('Alert', ['message', 'color'])
    },
    created() {
        // Code...
        this.resetState()
    },
    destroyed() {
        //this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
        }
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
.alert-danger p{
    margin-top: auto;
    margin-bottom: auto;
}
</style>
