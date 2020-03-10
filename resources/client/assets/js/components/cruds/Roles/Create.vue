<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Create New Role</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form @submit.prevent="submitForm" novalidate>
                                            <div class="box">

                                                <div class="box-body">

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Title  <span class="text-danger">*</span></label>
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

                                                    <!--<div v-for="group, groupName in groups">-->
                                                        <!--<h2>{{groupName}}</h2>-->
                                                        <!--<span v-for="item in group">-->
                                                            <!--<input type="checkbox" :id="'permission_'+item.id" :value="item.title" :name="group"-->
                                                                   <!--@change="handleChange(item.id, $event.target.checked)">-->
                                                            <!--<label class="checkbox-label" :for="'permission_'+item.id"> {{item.label}} </label> <br>-->
                                                      <!--</span>-->

                                                    <!--</div>-->
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['permission'] }">
                                                        <label for="permission" class="col-md-3 col-form-label">Permissions  <span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <v-select 
                                                                v-model="selected"
                                                                name="permission"
                                                                label="title"
                                                                @input="updatePermission"
                                                                :value="item.permission"
                                                                :options="permissionsAll"
                                                                 autocomplete="off"
                                                                multiple
                                                            />
                                                            <bootstrap-error :name="'permission'" v-if="errors && errors['permission']"/>
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
import PermissionGroup from '../../utils/PermissionGroup.vue'
import groupBy from 'lodash/groupBy'

export default {
    data() {
        return {
            // Code...\
            selected: '',
            showSummary: false
        }
    },
    components: {
        PermissionGroup
    },
    computed: {
        ...mapGetters('RolesSingle', ['item', 'loading', 'permissionsAll']),
        ...mapGetters('Alert', ['errors']),
        groups(){
            return groupBy(this.permissionsAll, 'group')
        }
    },
    created() {
        this.fetchPermissionsAll()
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    
    mounted(){
       
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('RolesSingle', ['storeData', 'resetState', 'setTitle', 'setPermission', 'fetchPermissionsAll']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updatePermission(value) {
            this.setPermission(value)
        },
        groupBy(array, key){
            const result = {}
            array.forEach(item => {
                if (!result[item[key]]){
                    result[item[key]] = []
                }
                result[item[key]].push(item)
            })
            return result
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'roles.index' })
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
