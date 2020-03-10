<template>
    <div>

    </div>
</template>


<script>
import { mapGetters } from 'vuex'

export default {
    data() {
        return {
            // Code...
        }
    },
    computed: {
        ...mapGetters('Rules', ['rules'])
    },
    created() {
        this.$eventHub.$on('create-success', this.itemCreated)
        this.$eventHub.$on('update-success', this.itemUpdated)
        this.$eventHub.$on('delete-success', this.itemDeleted)
        this.$eventHub.$on('rules-update', this.rulesUpdate)
        this.$eventHub.$on('update-password-success', this.passwordUpdated)
    },
    methods: {
        itemCreated() {
            this.$awn.success('Your item has been successfully saved.')
        },
        itemUpdated() {
            this.$awn.success('Your item has been successfully updated.')
        },
        itemDeleted() {
            this.$awn.success('Your item has been successfully deleted.')
        },
        rulesUpdate() {
            this.$ability.update([{ subject: 'all', actions: this.rules }])
        },
        passwordUpdated(){
            this.$awn.success('your-password-successfully-updated')
        }
    }
}
</script>


<style scoped>
    .btn-link{
        color:#00d78c;
    }
</style>
