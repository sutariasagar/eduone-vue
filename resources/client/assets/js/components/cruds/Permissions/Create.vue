<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Create New Permission</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form @submit.prevent="submitForm" novalidate style="min-height: 100px">
                                            <div class="box">
                                                <div class="box-body">

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Title <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="title"
                                                                placeholder="Enter Title *"
                                                                :value="item.title"
                                                                @input="updateTitle"
                                                                 autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'title'" v-if="errors && errors['title']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['label'] }">
                                                        <label for="label" class="col-md-3 col-form-label">Label <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="label"
                                                                    placeholder="Enter Label *"
                                                                    :value="item.label"
                                                                    @input="updateLabel"
                                                                     autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'label'" v-if="errors && errors['label']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['group'] }">
                                                        <label for="group" class="col-md-3 col-form-label">Group <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="group"
                                                                    placeholder="Enter Group *"
                                                                    :value="item.group"
                                                                    @input="updateGroup"
                                                                     autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'group'" v-if="errors && errors['group']"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer mt-5">
                                                    <vue-button-spinner
                                                        class="btn btn-purple mr-2 mb-2"
                                                        :isLoading="loading"
                                                        :disabled="loading"
                                                    >
                                                        CREATE
                                                    </vue-button-spinner>
                                                    <back-buttton></back-buttton>
                                                </div>
                                            </div>
                                        </form>
                                    </custom-collapse-body>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div v-bind:class="{'d-none':!showSummary,'col-md-3':showSummary}">
                <div class="card card-with-shadow custom-sidebar">
                    <item-changes :item="item"></item-changes>
                </div>

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
            showSummary: false
        }
    },
    components: {

    },
    computed: {
        ...mapGetters('PermissionsSingle', ['item', 'loading']),
        ...mapGetters('Alert', ['errors'])
    },
    created() {
        // Code ...
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    mounted(){
        
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('PermissionsSingle', ['storeData', 'resetState', 'setTitle', 'setLabel', 'setGroup']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateGroup(e) {
            this.setGroup(e.target.value)
        },
        updateLabel(e) {
            this.setLabel(e.target.value)
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'permissions.index' })
                    this.$eventHub.$emit('create-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }   
    }
}
</script>


<style scoped>

</style>
