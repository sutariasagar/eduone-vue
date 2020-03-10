<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Create New Learning Material Document </strong>
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
                                                        <label for="title" class="col-md-3 col-form-label">Title <span class="text-danger">*</span></label>
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
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['learning_material'] }">
                                                        <label for="learning_material" class="col-md-3 col-form-label">Learning Material <span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                name="learning_material"
                                                                label="title"
                                                                @input="updateLearning_material"
                                                                :value="item.learning_material"
                                                                :options="learningmaterialsAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'learning_material'" v-if="errors && errors['learning_material']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['description'] }">
                                                        <label for="description" class="col-md-3 col-form-label">Description <span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <vue-ckeditor
                                                                name="description"
                                                                :id="'description'"
                                                                :value="item.description"
                                                                @input="updateDescription"
                                                                :config="config"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'description'" v-if="errors && errors['description']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['material_type'] }">
                                                        <label for="material_type" class="col-md-3 col-form-label">Material type <span class="text-danger">*</span></label>
                                                        <div class="col-md-9">

                                                            <v-select
                                                                    name="material_type"
                                                                    label="title"
                                                                    @input="updateMaterial_type"
                                                                    :value="item.material_type"
                                                                    :options="materialtypesAll"
                                                                    autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'material_type'" v-if="errors && errors['material_type']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['link'] }">
                                                        <label for="link" class="col-md-3 col-form-label">Link </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="url"
                                                                class="form-control"
                                                                name="link"
                                                                placeholder="https://example.com"
                                                                :value="item.link"
                                                                @input="updateLink"
                                                                autocomplete="off"
                                                                pattern="https://.*"
                                                            >
                                                            <bootstrap-error :name="'link'" v-if="errors && errors['link']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['priority'] }">
                                                        <label for="priority" class="col-md-3 col-form-label">Priority </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="number"
                                                                max="10000"
                                                                class="form-control"
                                                                name="priority"
                                                                placeholder="Enter Priority"
                                                                :value="item.priority"
                                                                @input="updatePriority"
                                                                autocomplete="off"
                                                                min="0"
                                                            >
                                                            <bootstrap-error :name="'priority'" v-if="errors && errors['priority']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <div class="col-md-3"><label for="mandatory">Must Read <span class="text-danger">*</span></label></div>
                                                        <div class="col-md-9">
                                                            <div class="container">
                                                                <div class="row">
                                                                <div class="col-md-2 pr-0" v-bind:class="{ 'has-danger': errors && errors['mandatory'] }">
                                                                    <label class="cui-utils-control cui-utils-control-radio mr-2">
                                                                        Yes
                                                                        <input
                                                                        type="radio"
                                                                        name="mandatory"
                                                                        :value="item.mandatory"
                                                                        :checked="item.mandatory === 'yes'"
                                                                        @change="updateMandatory('yes')"
                                                                        ><bootstrap-error :name="'mandatory'" v-if="errors && errors['mandatory']"/>
                                                                        <span class="cui-utils-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-2 pl-0" v-bind:class="{ 'has-danger': errors && errors['mandatory'] }">
                                                                    <label class="cui-utils-control cui-utils-control-radio  ml-3">
                                                                        No
                                                                        <input
                                                                        type="radio"
                                                                        name="mandatory"
                                                                        :value="item.mandatory"
                                                                        :checked="item.mandatory === 'no'"
                                                                        @change="updateMandatory('no')"
                                                                        ><bootstrap-error :name="'mandatory'" v-if="errors && errors['mandatory']"/>
                                                                        <span class="cui-utils-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <div class="col-md-3"><label for="include_in_free_package">Include In Free Pacakage <span class="text-danger">*</span></label></div>
                                                        <div class="col-md-9">
                                                            <div class="col-md-6">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-control w-100"
                                                                        name="include_in_free_package"
                                                                        :checked="item.include_in_free_package"
                                                                        @change="updateInclude_in_free_package"
                                                                    >
                                                                    <bootstrap-error
                                                                        :name="'include_in_free_package'"
                                                                        v-if="errors && errors['include_in_free_package']"
                                                                    />
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['file'] }">
                                                        <label for="file" class="col-md-3 col-form-label">File </label>
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
                                                                @success="imageUploaded"
                                                                :clickable="false"

                                                            >
                                                                <div class="uploadFileBox text-center pointer"
                                                                     @click="triggerBrowse">
                                                                    <i class="fa fa-cloud-upload fa-5x">&nbsp;</i>
                                                                    <p>Drag file or Click here to choose the file</p>
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
                                                                                <div class="progress"
                                                                                     style="width: 25vw;">
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
                                                            <bootstrap-error :name="'file'"
                                                                             v-if="errors && errors['file']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['credits'] }">
                                                        <label for="credits" class="col-md-3 col-form-label">Credits </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="number"
                                                                max="1000"
                                                                class="form-control"
                                                                name="credits"
                                                                placeholder="Enter Credits"
                                                                :value="item.credits"
                                                                @input="updateCredits"
                                                                autocomplete="off"
                                                                min="0"
                                                            >
                                                            <bootstrap-error :name="'credits'" v-if="errors && errors['credits']"/>
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
import ckeditorConfig from '../../../config/ckeditor.json';

export default {
    data() {
        return {
            // Code...
            config: ckeditorConfig,
            uploadUrl: '/api/v1/media',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            },
            showSummary: false
        }
    },
    computed: {
        ...mapGetters('LearningMaterialDocumentsSingle', ['item', 'loading', 'learningmaterialsAll','materialtypesAll']),
        ...mapGetters('Alert', ['errors'])
    },
    created() {
        this.fetchLearningmaterialsAll()
        this.fetchMaterialtypesAll()
        this.$eventHub.$on('toggle-called', this.toggleColumns)
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('LearningMaterialDocumentsSingle', ['storeData', 'resetState', 'setTitle', 'setDescription', 'setMaterial_type', 'setLink', 'setPriority', 'setMandatory', 'setFile', 'destroyFile', 'destroyUploadedFile', 'setCredits',  'setLearning_material', 'setUpload_file', 'fetchLearningmaterialsAll', 'fetchMaterialtypesAll',"setIncludeInFreePackage"]),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateDescription(value) {
            this.setDescription(value)
        },
        updateMaterial_type(value) {
            this.setMaterial_type(value)
        },
        updateLink(e) {
            this.setLink(e.target.value)
        },
        updatePriority(e) {
            this.setPriority(e.target.value)
        },
        updateMandatory(value) {
            this.setMandatory(value)
        },
        triggerBrowse() {
            this.$refs.uploader.triggerBrowseFiles();
        },
        imageUploaded: function (file, result) {
            this.setUpload_file(result.data.media)

        },
        input(key, value) {
            let image = JSON.parse(JSON.stringify(this.item.image));
        },
        removeFile(e, id) {
            this.$swal({
                title: 'Are you sure?',
                text: "To fully delete the file submit the form.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#dd4b39',
                focusCancel: true,
                reverseButtons: true
            }).then(result => {
                if (typeof result.dismiss === "undefined") {
                    this.destroyFile(id);
                }
            })
        },
        updateFile(e) {
            this.setFile(e.target.files);
            this.$forceUpdate();
        },
        removeUploadedFile (e, id) {
        this.$swal({
          title: 'Are you sure ? ',
          text: "To fully delete the file submit the form.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Delete',
          confirmButtonColor: '#dd4b39',
          focusCancel: true,
          reverseButtons: true
        }).
        then(result => {
            if (typeof result.dismiss === "undefined") {
                this.destroyUploadedFile(id);
            }
        })
        },
        updateCredits(e) {
            this.setCredits(e.target.value)
        },
        updateLearning_material(value) {
            this.setLearning_material(value)
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'learning_material_documents.index' })
                    this.$eventHub.$emit('create-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        },
        toggleColumns(){
            this.showSummary = !this.showSummary;
        },
        updateInclude_in_free_package(value){
            console.log("updateInclude_in_free_package",value.target.checked);
            this.setIncludeInFreePackage(value.target.checked);
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
