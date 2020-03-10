<template>
    <div>
        <!-- HTML Text Starts -->
        <div v-if="id == 'html_text'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <div>
                    <vue-ckeditor
                            :id="name"
                            :name="name"
                            v-model="detailValue"
                            @input="input"
                            :config="config"
                            autocomplete="off"
                            v-if="id == 'html_text'"
                    />
                    <button
                            type="button"
                            class="btn btn-light btn-sm addBlankButton"
                            v-if="id == 'html_text' && type != 'answer' "
                            @click="addBlank"
                    >Add a blank</button>
                </div>
            </div>
        </div>
        <!-- HTML Text Ends -->

        <!-- Image upload starts -->
        <div v-if="id == 'image_upload' && type != 'answer'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <input
                        type="file"
                        :id="name"
                        :name="name"
                        :value="''"
                        @change="input"
                        autocomplete="off"
                        class="d-none"
                        :ref="id"
                        v-if="id == 'image_upload'"
                >

                <vue-transmit
                        v-if="id == 'image_upload'"
                        ref="image_uploader"
                        :url="uploadUrl"
                        :headers="headers"
                        paramName="file"
                        :maxFiles="Number(1)"
                        :acceptedFileTypes="['image/*']"
                        @success="imageUploaded"
                        :clickable="false"
                >
                    <div
                            class="uploadFileBox text-center pointer"
                            @click="triggerBrowse('image_uploader')"
                    >
                        <i class="fa fa-cloud-upload fa-5x">&nbsp;</i>
                        <p>Drag file or Click here to choose the image</p>
                    </div>

                    <!-- Scoped slot -->
                    <template slot="files" slot-scope="image_props">
                        <div>
                            <ul v-if="detailValue" class="list-unstyled">
                                <li v-for="file in detailValue.data.media">
                                    {{ file.file_name }}
                                    <button
                                            @click="removeUploadedFile($event, file.id);"
                                            type="button"
                                            class="btn btn-sm btn-icon btn-danger btn-rounded ml-2"
                                    >
                                        <i class="icmn-cross" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>
                            <div
                                    v-for="(file, i) in image_props.files"
                                    :key="file.id"
                                    :class="{'mt-5': i === 0}"
                                    class="row"
                            >
                                <div class="media">
                                    <img :src="file.dataUrl" class="img-fluid d-flex mr-3">
                                    <div class="media-body">
                                        <h3>{{ file.name }}</h3>
                                        <div class="progress col-md-12">
                                            <div
                                                    class="progress-bar bg-success"
                                                    :style="{width: file.upload.progress + '%'}"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </vue-transmit>
            </div>
        </div>
        <!-- Image upload ends -->

        <!-- Audio upload starts -->
        <div v-if="id == 'audio_upload' && type != 'answer'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <input
                        type="file"
                        :id="name"
                        :name="name"
                        :value="detailValue"
                        @change="input"
                        autocomplete="off"
                        class="d-none"
                        :ref="id"
                        v-if="id == 'audio_upload'"
                >

                <vue-transmit
                        v-if="id == 'audio_upload'"
                        ref="audio_uploader"
                        :url="uploadUrl"
                        :headers="headers"
                        paramName="file"
                        :maxFiles="Number(1)"
                        :acceptedFileTypes="['audio/*']"
                        @success="audioUploaded"
                        :clickable="false"
                >
                    <div
                            class="uploadFileBox text-center pointer"
                            @click="triggerBrowse('audio_uploader')"
                    >
                        <i class="fa fa-file-audio-o fa-5x">&nbsp;</i>
                        <p>Drag file or Click here to choose the audio</p>
                    </div>

                    <!-- Scoped slot -->
                    <template slot="files" slot-scope="audio_props">
                        <div>
                            <ul v-if="detailValue" class="list-unstyled">
                                <li v-for="file in detailValue.data.media">
                                    {{ file.file_name }}
                                    <button
                                            @click="removeUploadedFile($event, file.id);"
                                            type="button"
                                            class="btn btn-sm btn-icon btn-danger btn-rounded ml-2"
                                    >
                                        <i class="icmn-cross" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>
                            <div
                                    v-for="(file, i) in audio_props.files"
                                    :key="file.id"
                                    :class="{'mt-5': i === 0}"
                                    class="row"
                            >
                                <div class="media">
                                    <img :src="file.dataUrl" class="img-fluid d-flex mr-3">
                                    <div class="media-body">
                                        <h3>{{ file.name }}</h3>
                                        <div class="progress col-md-12">
                                            <div
                                                    class="progress-bar bg-success"
                                                    :style="{width: file.upload.progress + '%'}"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </vue-transmit>
            </div>
        </div>
        <!-- Audio upload ends -->

        <!-- Youtube video code start -->
        <div v-if="id == 'youtube_video' && type != 'answer'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <input
                        type="text"
                        :id="name"
                        :name="name"
                        v-model="detailValue"
                        autocomplete="off"
                        class="form-control"
                        placeholder="Enter youtube video code here. Ex. qTSDL94_Y7M"
                        :ref="id"
                        @change="input"
                        v-if="id == 'youtube_video'"
                >

                <div v-if="(id == 'youtube_video') && detailValue" class="row mt-10">
                    <youtube :video-id="detailValue" player-width="auto" player-height="auto"></youtube>
                </div>
            </div>
        </div>
        <!-- Youtube video code ends -->

        <!-- Ordered text start -->
        <div v-if="id == 'ordered_text'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <ordered-text
                        @change="orderedTextChanged"
                        v-model="detailValue"
                        v-if="id == 'ordered_text'"
                        :list="value"
                ></ordered-text>
            </div>
        </div>
        <!-- Ordered text ends -->

        <!-- Ordered images start -->
        <div v-if="id == 'ordered_images'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <ordered-images
                        @change="ordereImagesChanged"
                        v-model="detailValue"
                        v-if="id == 'ordered_images'"
                ></ordered-images>
            </div>
        </div>
        <!-- Ordered images ends -->

        <!-- FIB details starts -->
        <div v-if="type == 'answer'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <fib-answers
                        :fibOption="fibOption"
                        :fibDetails="fibDetails"
                        v-if="type == 'answer'"
                        @answersUpdated="fibAnswerChanged"
                        @suggestionsUpdated="fibSuggestionChanged"
                ></fib-answers>
            </div>
        </div>
        <!-- FIB details ends -->

        <!-- MCQ Single Option text start -->
        <div v-if="id == 'mcq_single_option' && type == 'answer'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <m-c-q-single-option
                        @change="MCQSingleOptionChanged"
                        v-model="detailValue"
                        v-if="id == 'mcq_single_option' && type=='answer'"
                        :list="value"
                ></m-c-q-single-option>
            </div>
        </div>
        <!-- MCQ Single Option text ends -->

        <!-- MCQ Multiple Option text start -->
        <div v-if="id == 'mcq_multiple_option' && type=='answer'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <m-c-q-single-option
                        @change="MCQMultipleOptionChanged"
                        v-model="detailValue"
                        v-if="id == 'mcq_multiple_option' && type=='answer'"
                        :list="value"
                ></m-c-q-single-option>
            </div>
        </div>
        <!-- MCQ Multiple Option text ends -->
    </div>
</template>
<style scoped="">
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

    .mt-10 {
        margin-top: 10px !important;
    }

    .addBlankButton {
        position: absolute;
        top: 6px;
        right: 25px;
    }
</style>
<script>
    import ckeditorConfig from "../../../config/ckeditor.json";
    import OrderedText from "./OrderedText.vue";
    import MCQSingleOption from "./MCQSingleOption.vue";
    import MCQMultipleOption from "./MCQMultipleOption.vue";
    import OrderedImages from "./OrderedImages.vue";
    import fibAnswers from "./fibAnswers.vue";

    export default {
        name: "QuestionTypeInput",

        components: {
            OrderedText,
            OrderedImages,
            fibAnswers,
            MCQSingleOption,
            MCQMultipleOption
        },

        props: [
            "id",
            "name",
            "value",
            "labelClass",
            "contentClass",
            "required",
            "label",
            "fibOption",
            "fibDetails",
            "type"
        ],

        data() {
            return {
                config: ckeditorConfig,
                detailValue: this.value,
                options: {},
                uploadUrl: "/api/v1/media",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },
                blankCount: 0,
                fibAnswers: [],
                fibSuggestions: []
            };
        },

        mounted: function() {
            console.log("Input fibDetails: ", this.fibDetails);
            if (this.id == "image_upload") {
                console.log(this.detailValue);
            }
        },

        methods: {
            initializeCKEditorButton: function() {
                if (this.id != "html_text") return;
                let editor = CKEDITOR.instances[this.name]; // bind editor

                console.log("editor: ", editor);

                editor.addCommand("mySimpleCommand", {
                    // create named command
                    exec: function(edt) {
                        alert(edt.getData());
                    }
                });

                editor.ui.addButton("SuperButton", {
                    // add new button and bind our command
                    label: "Click me",
                    command: "mySimpleCommand",
                    toolbar: "basicstyles",
                    icon:
                        "https://avatars1.githubusercontent.com/u/5500999?v=2&s=16"
                });
            },
            removeUploadedFile(e, id) {
                this.$swal({
                    title: "Are you sure ? ",
                    text: "To fully delete the file submit the form.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    confirmButtonColor: "#dd4b39",
                    focusCancel: true,
                    reverseButtons: true
                }).then(result => {
                    if (typeof result.dismiss === "undefined") {
                        //this.destroyUploadedFile(id);
                    }
                });
            },
            addBlank: function() {
                if (this.blankCount == 10) {
                    alert("You've already added 10 blanks!");
                    return;
                }
                let re = /(#b_[1-9]#)/g;
                let s = CKEDITOR.instances[this.name].getData();
                let m;

                let allMatches = [];

                do {
                    m = re.exec(s);
                    if (m) {
                        allMatches.push(m[1]);
                    }
                } while (m);

                this.blankCount = allMatches.length + 1;

                CKEDITOR.instances[this.name].insertHtml(
                    " #b_" + this.blankCount + "# "
                );
            },
            input: function() {
                this.$emit("change", this.id, this.detailValue);
                if (this.id == "html_text") {
                    let fibDetails = {
                        count: this.blankCount
                    };
                    if (this.type && this.type == "answer") {
                        fibDetails.answers = this.fibAnswers;
                        fibDetails.suggestions = this.fibSuggestions;
                    }
                    this.$emit("change", this.fibOption, fibDetails);
                }
            },
            triggerBrowse(ref) {
                this.$refs[ref].triggerBrowseFiles();
            },
            imageUploaded: function(file, result) {
                this.$emit("change", this.id, result);
            },
            audioUploaded: function(file, result) {
                this.$emit("change", this.id, result);
            },
            orderedTextChanged: function(list) {
                this.$emit("change", this.id, list);
            },
            ordereImagesChanged: function(list) {
                this.$emit("change", this.id, list);
            },
            MCQSingleOptionChanged: function(list) {
                this.$emit("change", this.id, list);
            },
            MCQMultipleOptionChanged: function(list) {
                this.$emit("change", this.id, list);
            },
            fibAnswerChanged: function(fibDetails) {
                this.$emit("change", this.fibOption, fibDetails);
            },
            fibSuggestionChanged: function(fibDetails) {
                this.$emit("change", this.fibOption, fibDetails);
            }
        }
    };
</script>
