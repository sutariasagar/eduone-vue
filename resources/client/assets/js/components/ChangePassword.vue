<template>

    <div class="">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Change Password </strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form @submit.prevent="submitForm">
                                            <div class="box">

                                                <div class="box-body">

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['current_password'] }">
                                                        <label for="current_password" class="col-md-3 col-form-label">Current Password <span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                           <div class="input-group">
                                                            <input
                                                                type="password"
                                                                class="form-control password-group"
                                                                name="current_password"
                                                                style="width:80%"
                                                                :value="current_password"
                                                                @input="updateCurrentPassword"
                                                            >
                                                            <div class="input-group-append" v-on:click="switchVisibility">
                                                                <span class="input-group-text">
                                                                <i  class="fa fa-eye"></i>
                                                                </span>
                                                            </div>
                                                            <bootstrap-error :name="'current_password'" v-if="errors && errors['current_password']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['new_password'] }">
                                                        <label for="new_password" class="col-md-3 col-form-label">New Password <span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                            <input
                                                                type="password"
                                                                class="form-control password-group"
                                                                name="new_password"
                                                                style="width:80%"
                                                                :value="new_password"
                                                                @input="updateNewPassword"
                                                            >
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                <i v-on:click="switchVisibility" class="fa fa-eye"></i>
                                                                </span>
                                                            </div>
                                                            <bootstrap-error :name="'new_password'" v-if="errors && errors['new_password']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['new_password_confirmation'] }">
                                                        <label for="new_password_confirmation" class="col-md-3 col-form-label">Confirm New Password </label>
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                            <input
                                                                type="password"
                                                                class="form-control password-group"
                                                                name="new_password_confirmation"
                                                                :value="new_password_confirmation"
                                                                @input="updateNewPasswordConfirmation"
                                                            >
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                <i v-on:click="switchVisibility" class="fa fa-eye"></i>
                                                                </span>
                                                            </div>
                                                            <bootstrap-error :name="'new_password_confirmation'" v-if="errors && errors['new_password_confirmation']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer mt-5">
                                                    <vue-button-spinner
                                                        class="btn btn-purple mr-2 mb-2"
                                                        :isLoading="loading"
                                                        :disabled="loading"
                                                    >
                                                        SAVE
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
        </div>
    </div>

</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
            type: 'password',
        }
    },
    computed: {
        ...mapGetters('ChangePassword', ['current_password', 'new_password', 'new_password_confirmation', 'loading']),
        ...mapGetters('Alert', ['errors'])
    },
    created() {
        // Code...
    },
    destroyed() {
        this.resetState();
    },
    methods: {
        ...mapActions('ChangePassword', ['storeData', 'resetState', 'setCurrentPassword', 'setNewPassword', 'setNewPasswordConfirmation']),
        updateCurrentPassword(e) {
            this.setCurrentPassword(e.target.value)
        },
        updateNewPassword(e) {
            this.setNewPassword(e.target.value)
        },
        updateNewPasswordConfirmation(e) {
            this.setNewPasswordConfirmation(e.target.value)
        },
        switchVisibility(e){
            (e.target.closest('.input-group').querySelector('.password-group'))
            let element = e.target.closest('.input-group').querySelector('.password-group');
            if(e.target.closest('.input-group').querySelector('.password-group').type == 'password'){
                e.target.closest('.input-group').querySelector('.password-group').type = 'text';
            }else{
                e.target.closest('.input-group').querySelector('.password-group').type = 'password';
            }
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$eventHub.$emit('update-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>


<style scoped>

</style>
