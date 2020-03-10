<template>
    <div class="">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> User Profile</strong>
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
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['email'] }">
                                                        <label for="file" class="col-md-3 col-form-label">Image *</label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="file"
                                                                name="image"
                                                                @change="input"
                                                                autocomplete="off"
                                                                class="d-none"
                                                            />
                                                            <vue-transmit
                                                            ref="uploader"
                                                            :url='uploadUrl'
                                                            :headers="headers"
                                                            paramName="file"
                                                            :maxFiles='Number(1)'
                                                            :acceptedFileTypes="['image/*']"
                                                            @success="imageUploaded"
                                                            :clickable="false"

                                                        >
                                                            <div class="uploadFileBox text-center pointer" @click="triggerBrowse">
                                                                <i class="fa fa-cloud-upload fa-5x">&nbsp;</i>
                                                                <p>Drag file or Click here to choose the image</p>
                                                            </div>
                                                        
                                                            <!-- Scoped slot -->
                                                            <template slot="files" slot-scope="image_props">
                                                                <div
                                                                    v-for="(file, i) in image_props.files"
                                                                    :key="file.id"
                                                                    :class="{'mt-5': i === 0}"
                                                                >
                                                                    <div class="media">
                                                                        <img
                                                                            :src="file.dataUrl"
                                                                            class="img-fluid d-flex mr-3"
                                                                        />
                                                                        <div class="media-body">
                                                                            <h3>{{ file.name }}</h3>
                                                                            <div class="progress" style="width: 25vw;">
                                                                                <div
                                                                                    class="progress-bar bg-success"
                                                                                    :style="{width: file.upload.progress + '%'}"
                                                                                ></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </template>

                                                                <div
                                                                    v-if="item.profile_image">
                                                                    <div class="media">
                                                                        <img
                                                                            :src="'/storage/'+item.profile_image.id+'/'+item.profile_image.file_name"
                                                                            class="img-fluid d-flex mr-3"
                                                                        />
                                                                        <div class="media-body">
                                                                            <h3>{{ item.profile_image.file_name }}</h3>                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                    </vue-transmit>
                                                            <bootstrap-error :name="'email'" v-if="errors && errors['email']"/>
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
        </div>
    </div>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
            uploadUrl: '/api/v1/media',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            }
        }
    },
    computed: {
        ...mapGetters('Profile', ['item', 'loading']),
        ...mapGetters('Alert', ['errors'])
    },
    created() {
        this.fetchData()
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData()
        }
    },
    methods: {
        ...mapActions('Profile', ['fetchData', 'updateData', 'resetState', 'setName', 'setEmail','setProfileImage', 'setPassword', 'setRole']),
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
        submitForm() {
            this.updateData()
                .then(() => {                    
                    this.$eventHub.$emit('update-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
        triggerBrowse() {
            this.$refs.uploader.triggerBrowseFiles();
        },
        imageUploaded: function(file, result) {
            //this.setQuestionDetailsByKey({key: 'image_upload', value: result});
            //this.updateProfileImage(value);
            this.setProfileImage(result.data.media[0].id);
            console.log("imageUploaded file: ", file);
            console.log("imageUploaded result: ", result);
        },
        input(key, value) {
            console.log("updateQuestionDetailValue key: ", key);
            console.log("updateQuestionDetailValue value: ", value);
            let image = JSON.parse(JSON.stringify(this.item.image));
        },
    }
}
</script>


<style scoped>
.uploadFileBox {
    border: 1px solid #eeeeee;
    height: 200px;
    line-height: 50px;
    width: 100%;
    border-radius: 10px;
    position: relative;
    vertical-align: middle;
    padding-top: 50px;
    cursor: pointer;
}
</style>
