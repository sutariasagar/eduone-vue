<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> Create New Student </strong>
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

                                                    <input type="hidden" name="type">
                                                      <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['registration_id'] }">
                                                        <label for="registration_id" class="col-md-3 col-form-label">Registration Id <span class="text-danger">*</span> </label>
                                                        <div class="col-md-3">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="registration_id"
                                                                placeholder="Enter Registration Id *"
                                                                :value="item.registration_id"
                                                                @input="updateRegistration_id"
                                                                autocomplete="off"
                                                                min="0"
                                                            >
                                                            <bootstrap-error :name="'registration_id'" v-if="errors && errors['registration_id']"/>
                                                        </div>
                                                    </div>

                                                     <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['test_taker_id'] }">
                                                        <label for="test_taker-id" class="col-md-3 col-form-label">Test Taker Id <span class="text-danger">*</span> </label>
                                                        <div class="col-md-3">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="test_taker_id"
                                                                placeholder="Enter Test Taker Id *"
                                                                :value="item.test_taker_id"
                                                                @input="updateTest_taker_id"
                                                                autocomplete="off"
                                                                min="0"
                                                            >
                                                            <bootstrap-error :name="'test_taker_id'" v-if="errors && errors['test_taker_id']"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['first_name'] }">
                                                        <label for="first_name" class="col-md-3 col-form-label">First Name  <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="first_name"
                                                                placeholder="Enter First Name *"
                                                                :value="item.first_name"
                                                                @input="updateFirst_name"
                                                                autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'first_name'" v-if="errors && errors['first_name']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['middle_name'] }">
                                                        <label for="middle_name" class="col-md-3 col-form-label">Middle Name </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="middle_name"
                                                                placeholder="Enter Middle Name "
                                                                :value="item.middle_name"
                                                                @input="updateMiddle_name"
                                                                autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'middle_name'" v-if="errors && errors['middle_name']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['last_name'] }">
                                                        <label for="last_name" class="col-md-3 col-form-label">Last Name  <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="last_name"
                                                                placeholder="Enter Last Name *"
                                                                :value="item.last_name"
                                                                @input="updateLast_name"
                                                                autocomplete="off"
                                                            >   
                                                            <bootstrap-error :name="'last_name'" v-if="errors && errors['last_name']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['email'] }">
                                                        <label for="email" class="col-md-3 col-form-label">Email <span class="text-danger">*</span></label>
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
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['phone'] }">
                                                        <label for="phone" class="col-md-3 col-form-label">Phone<span class="text-danger">*</span> </label>
                                                        <div class="col-md-3">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="phone"
                                                                placeholder="Enter Phone *"
                                                                :value="item.phone"
                                                                @input="updatePhone"
                                                                autocomplete="off"
                                                                min="0"
                                                            >
                                                            <bootstrap-error :name="'phone'" v-if="errors && errors['phone']"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['date_of_birth'] }">
                                                        <label for="date_of_birth" class="col-md-3 col-form-label">Date Of Birth <span class="text-danger">*</span> </label>
                                                        <div class="col-md-3">
                                                            <input
                                                                type="date"
                                                                class="form-control"
                                                                name="date_of_birth"
                                                                placeholder="Enter date_of_birth *"
                                                                :value="item.date_of_birth"
                                                                @input="updateDate_of_birth"
                                                                autocomplete="off"
                                                                min="0"
                                                            >
                                                            <bootstrap-error :name="'date_of_birth'" v-if="errors && errors['date_of_birth']"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['gender'] }">
                                                        <label for="gender" class="col-md-3 col-form-label">Gender <span class="text-danger">*</span> </label>
                                                        <div class="col-md-3">
                                                            <input
                                                                class="mr-3"
                                                                type="radio"
                                                                name="gender"
                                                                :value="item.gender"
                                                                :checked="item.gender === 'male'"
                                                                @change="updateGender('male')"
                                                                autocomplete="off"
                                                                min="0"
                                                            >Male
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input
                                                                class="mr-3"
                                                                type="radio"
                                                                name="gender"
                                                                :value="item.gender"
                                                                :checked="item.gender === 'female'"
                                                                @change="updateGender('female')"
                                                                autocomplete="off"
                                                                min="0"
                                                            >Female
                                                            <bootstrap-error :name="'gender'" v-if="errors && errors['gender']"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['country'] }">
                                                        <label for="country" class="col-md-3 col-form-label">Country<span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="country"
                                                                placeholder="Enter Country *"
                                                                :value="item.country"
                                                                @input="updateCountry"
                                                                autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'country'" v-if="errors && errors['country']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['state'] }">
                                                        <label for="state" class="col-md-3 col-form-label">State</label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="state"
                                                                placeholder="Enter State "
                                                                :value="item.state"
                                                                @input="updateState"
                                                                autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'state'" v-if="errors && errors['state']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['city'] }">
                                                        <label for="city" class="col-md-3 col-form-label">City<span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="city"
                                                                placeholder="Enter City *"
                                                                :value="item.city"
                                                                @input="updateCity"
                                                                autocomplete="off"
                                                            >
                                                            <bootstrap-error :name="'city'" v-if="errors && errors['city']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['package'] }">
                                                        <label for="package" class="col-md-3 col-form-label">Package <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="package"
                                                                placeholder="Enter Package *"
                                                                :value="item.package"
                                                                @input="updatePackage"
                                                                :options="packagesAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'package'" v-if="errors && errors['package']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['image'] }">
                                                        <label for="file" class="col-md-3 col-form-label">Image <span class="text-danger">*</span></label>
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
                                                            </vue-transmit>
                                                            <bootstrap-error :name="'image'" v-if="errors && errors['image']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <image-capture                                                                                                                      
                                                                @upload="captureUploaded">
                                                        </image-capture>
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
                    <div>
                        <b-modal ref="student" :hide-footer='false' header-class='custom-sidebar-no-hover' title="Login Information" ok-only >
                            <div class="d-block text-center pt-5 pb-5">
                                <h4>Email : {{item.email}} </h4>
                                <h4>Password : {{password}} </h4>
                                <h4 v-if="item.terminal">Terminal : {{item.terminal.title}} </h4>
                                <h4 v-else>No Terminals are vacant, kindy let students to complete test</h4>
                            </div>
                            <!-- <div class="d-block text-center pt-5 pb-5" v-else>
                                <h4>No Terminals are vacant, kindy let students to complete test </h4>
                            </div> -->
                        </b-modal>  
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
    import {mapGetters, mapActions} from 'vuex'
    import ImageCapture from './../../utils/ImageCapture'

    export default {
        data() {
            return {
                // Code...
                showSummary: false,
                uploadUrl: '/api/v1/media',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                }
            }
        },
        components: { ImageCapture },
        computed: {
            ...mapGetters('StudentsSingle', ['item', 'loading', 'packagesAll','password']),
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            this.$eventHub.$on('toggle-called', this.toggleColumns)
        },
        mounted() {
            let context = this;
            console.log(this.item.terminal);
            context.fetchPackagesAll();
        },
        destroyed() {
            this.resetState()
        },
        methods: {
            ...mapActions('StudentsSingle', ['setItem','setRegistration_id','setTest_taker_id', 'setFirst_name', 'setLast_name', 'setMiddle_name','setEmail','setPhone','setDate_of_birth','setGender','setCountry','setState', 'setCity','setType','setPackage', 'fetchPackagesAll', 'storeData', 'resetState','setPassword','setStudentImage','setCaptureImage']),
            updateRegistration_id(e) {
                this.setRegistration_id(e.target.value)
            },
            updateTest_taker_id(e) {
                this.setTest_taker_id(e.target.value)
            },
          updateFirst_name(e) {
                this.setFirst_name(e.target.value)
            },
            updateMiddle_name(e) {
                this.setMiddle_name(e.target.value)
            },
            updateLast_name(e) {
                this.setLast_name(e.target.value)
            },
            updateEmail(e) {
                this.setEmail(e.target.value)
            },
            updatePhone(e) {
                this.setPhone(e.target.value)
            },
            updateDate_of_birth(e) {
            this.setDate_of_birth(e.target.value)
            },
            updateGender(value) {
                this.setGender(value)
            },
            updateCountry(e) {
                this.setCountry(e.target.value)
            },
            updateState(e) {
                this.setState(e.target.value)
            },
            updateCity(e) {
                this.setCity(e.target.value)
            },
            updateType(e) {
                this.setType(e.target.value)
            },
            updatePackage(value) {
                this.setPackage(value)
            },
            submitForm() {
                this.storeData()
                    .then(() => {
                        //this.$router.push({name: 'students.index'})
                        this.$eventHub.$emit('create-success')
                        this.$refs.student.show();
                    })
                    .catch((error) => {
                        console.error(error)
                    })
            },
            toggleColumns(){
                this.showSummary = !this.showSummary;
            },
            triggerBrowse() {
                this.$refs.uploader.triggerBrowseFiles();
            },
            imageUploaded: function(file, result) {
                console.log("imageUploaded file: ", file);
                console.log("imageUploaded result: ", result);
                this.setStudentImage(result.data.media[0].id);
            },
            captureUploaded: function(file, result) {
                console.log("captureUploaded file: ", file);
                console.log("imageUploaded result: ", result);
                this.setCaptureImage(file);
            },
            input(key, value) {
                console.log("updateQuestionDetailValue key: ", key);
                console.log("updateQuestionDetailValue value: ", value);
                let image = JSON.parse(JSON.stringify(this.item.image));
            }
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
