<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Update User</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form-skeleton v-if="!loadTables"></form-skeleton>
                                            <form v-else @submit.prevent="submitForm" novalidate>
                                                <div class="box">

                                                    <div class="box-body">

                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['name'] }">
                                                            <label for="name" class="col-md-3 col-form-label">Name *</label>
                                                            <div class="col-md-9">
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="name"
                                                                    placeholder="Enter Name *"
                                                                    :value="item.name"
                                                                    @input="updateName"
                                                                    autocomplete="off"
                                                                >
                                                                <bootstrap-error :name="'name'" v-if="errors && errors['name']"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['email'] }">
                                                            <label for="email" class="col-md-3 col-form-label">Email *</label>
                                                            <div class="col-md-9">
                                                                <input
                                                                    type="email"
                                                                    class="form-control"
                                                                    name="email"
                                                                    placeholder="Enter Email *"
                                                                    :value="item.email"
                                                                    @input="updateEmail"
                                                                    autocomplete="off"
                                                                >
                                                                <bootstrap-error :name="'email'" v-if="errors && errors['email']"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['password'] }">
                                                            <label for="password" class="col-md-3 col-form-label">Password *</label>
                                                            <div class="col-md-9">
                                                                <input
                                                                    type="password"
                                                                    class="form-control"
                                                                    name="password"
                                                                    placeholder="Enter Password *"
                                                                    @input="updatePassword"
                                                                    autocomplete="off"
                                                                >
                                                                <bootstrap-error :name="'password'" v-if="errors && errors['password']"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['role'] }">
                                                            <label for="role" class="col-md-3 col-form-label">Role *</label>
                                                            <div class="col-md-9">
                                                                <v-select
                                                                    name="role"
                                                                    label="title"
                                                                    @input="updateRole"
                                                                    :value="item.role"
                                                                    :options="rolesAll"
                                                                    autocomplete="off"
                                                                    multiple
                                                                />
                                                                <bootstrap-error :name="'role'" v-if="errors && errors['role']"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="box-footer mt-5">
                                                        <vue-button-spinner
                                                            class="btn btn-purple mr-2 mb-2"
                                                            :isLoading="loading"
                                                            :disabled="loading"
                                                        >
                                                            UPDATE
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
                <div class="card card-with-shadow custom-sidebar pt-3 p-3">
                    <item-changes :item="item"></item-changes>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
import { mapGetters, mapActions } from 'vuex';
import formSkeleton from '../../utils/skeleton/Form.vue';


export default {
    data() {
        return {
            // Code...
            showSummary: false,
            loadTables: false
        }
    },
    computed: {
        ...mapGetters('UsersSingle', ['item', 'loading', 'rolesAll']),
        ...mapGetters('Alert', ['errors'])
    },
    components:{
        formSkeleton
    },
    created() {
        this.$eventHub.$on('rules-update', this.showTable)
        this.fetchData(this.$route.params.id)
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            let app= this
            this.fetchData(this.$route.params.id).then(function(){
            app.loadTables = true;
            });
        }
    },
    methods: {
        ...mapActions('UsersSingle', ['fetchData', 'updateData', 'resetState', 'setName', 'setEmail', 'setPassword', 'setRole']),
        updateName(e) {
            this.setName(e.target.value)
        },
        updateEmail(e) {
            this.setEmail(e.target.value)
        },
        updatePassword(e) {
            this.setPassword(e.target.value)
        },
        updateRole(value) {
            this.setRole(value)
        },
        showTable(){
                let app = this
                this.fetchData(this.$route.params.id).then(function(){
                    app.loadTables = true;
            });
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'users.index' })
                    this.$eventHub.$emit('update-success')
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
