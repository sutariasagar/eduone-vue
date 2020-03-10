<template>
    <div>
        <!-- HTML Text Starts -->
        <div v-if="id == 'html_text' && type != 'answer'" class="row">
            <div class="col-md-3">
                <label :for="name">
                    {{ label }}
                    <span v-if="require" class="text-danger">*</span>
                </label>
            </div>
            <div :class="contentClass">

                <div>
                    <vue-ckeditor
                            :id="name"
                            :name="name"
                            @input="htmlTextChanges"
                            :config="config"
                            :value="item.question_details.html_text"
                            autocomplete="off"
                            v-if="id == 'html_text' && type != 'answer'"
                    />
                    <button
                            type="button"
                            class="btn btn-light btn-sm addBlankButton"
                            v-if="id == 'html_text' && type != 'answer' "
                            @click="addBlank"
                    >Add a blank
                    </button>
                </div>
            </div>
        </div>
        <!-- HTML Text Ends -->

        <!-- HTML Text Starts -->
        <div v-if="id == 'html_text_2' && type != 'answer'" class="row">
            <div class="col-md-3">
                <label :for="name">
                    {{ label }}
                    <span v-if="require" class="text-danger">*</span>
                </label>
            </div>
            <div :class="contentClass">

                <div>
                    <vue-ckeditor
                            :id="name"
                            :name="name"
                            @input="htmlText2Changes"
                            :config="config"
                            :value="item.question_details.html_text_2"
                            autocomplete="off"
                            v-if="id == 'html_text_2' && type != 'answer'"
                    />
                </div>
            </div>
        </div>
        <!-- HTML Text Ends -->

        <!-- Image upload starts -->
        <div class="row" v-if="id == 'image_upload' && type != 'answer'">
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
                    <template slot="files" slot-scope="image_props" v-if="item.question_details.image_upload && item.question_details.image_upload.data">
                        <div>
                            <ul v-if="item.question_details.image_upload" class="list-unstyled">
                                <li v-for="file in item.question_details.image_upload.data.media" v-if="item.question_details.image_upload.data.media">
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
        <div class="row" v-if="id == 'audio_upload' && type != 'answer'">
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
                    <template slot="files" slot-scope="audio_props" v-if="item.question_details.audio_upload && item.question_details.audio_upload.data">
                        <div>
                            <ul v-if="item.question_details.audio_upload" class="list-unstyled">
                                <li v-for="file in item.question_details.audio_upload.data.media" v-if="item.question_details.audio_upload.data.media">
                                    {{ file.file_name }}
                                    <button
                                            @click="removeUploadedAudioFile($event, file.id);"
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
                                    class="row" v-if="audio_props"
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
        <div class="row" v-if="id == 'youtube_video' && type != 'answer'">
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
        <div class="row" v-if="id == 'ordered_text'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <ordered-text
                        v-if="id == 'ordered_text'"
                ></ordered-text>
            </div>
        </div>
        <!-- Ordered text ends -->

        <!-- Ordered images start -->
        <div class="row" v-if="id == 'ordered_images'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <ordered-images
                        v-if="id == 'ordered_images'"
                ></ordered-images>
            </div>
        </div>
        <!-- Ordered images ends -->

        <!-- FIB without Options starts -->
        <div class="row" v-if="id == 'fib_no_options'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">
                <fib-no-options />
            </div>
        </div>
        <!-- FIB without Options ends -->

        <!-- FIB with DropDown starts -->
        <div class="row" v-if="id == 'fib_dropdown'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">
                <fib-drop-down />
            </div>
        </div>
        <!-- FIB with DropDown ends -->

        <!-- FIB with DropDown starts -->
        <div class="row" v-if="id == 'fib_drag_drop'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">
                <fib-drag-drop />
            </div>
        </div>
        <!-- FIB with DropDown ends -->

        <!-- MCQ Single Option text start -->
        <div class="row" v-if="id == 'mcq_single_option'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">
                <m-c-q-single-option
                        v-if="id == 'mcq_single_option'"
                ></m-c-q-single-option>
            </div>
        </div>
        <!-- MCQ Single Option text ends -->

        <!-- MCQ Multiple Option text start -->
        <div class="row" v-if="id == 'mcq_multiple_option'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">
                <m-c-q-multiple-option
                        v-if="id == 'mcq_multiple_option'"
                ></m-c-q-multiple-option>
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
    import {mapActions, mapGetters} from "vuex";

    import ckeditorConfig from "../../../config/ckeditor.json";
    import OrderedText from "./EditOrderedText.vue";
    import MCQSingleOption from "./EditMCQSingleOption.vue";
    import MCQMultipleOption from "./EditMCQMultipleOption.vue";
    import OrderedImages from "./EditOrderedImages.vue";
    import fibAnswers from "./FibAnswers.vue";
    import FibDropDown from "./FibDropDown.vue";
    import FibDragDrop from "./FibDragDrop.vue";
    import FibNoOptions from "./FibNoOptions.vue";

    export default {
        name: "EditQuestionTypeInput",

        components: {
            OrderedText,
            OrderedImages,
            fibAnswers,
            MCQSingleOption,
            MCQMultipleOption,
            FibDropDown,
            FibDragDrop,
            FibNoOptions
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
            "type",
            "isFib"
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
            };
        },

        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
            ])
        },





        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setQuestion_details",
                "setAnswer_details",
                "setBlankCount",
                "setQuestionDetailsByKey",
            ]),

            initializeCKEditorButton: function () {
                if (this.id != "html_text") return;
                let editor = CKEDITOR.instances[this.name]; // bind editor

                editor.addCommand("mySimpleCommand", {
                    // create named command
                    exec: function (edt) {
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
                        this.setQuestionDetailsByKey({key: 'image_upload', value: {}});
                    }
                });
            },
            removeUploadedAudioFile(e, id) {
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
                        this.setQuestionDetailsByKey({key: 'audio_upload', value: {}});
                    }
                });
            },
            addBlank: function () {
                if (this.blankCount == 10) {
                    alert("You've already added 10 blanks!");
                    return;
                }

                this.blankCount = this.updateCurrentBlankCount() + 1;
                console.log(this.blankCount);
                CKEDITOR.instances[this.name].insertHtml(
                    " #b_" + this.blankCount + "# "
                );
                this.setBlankCount(this.blankCount);
                //this.$emit("updateBlankCount", this.blankCount);
            },

            updateCurrentBlankCount: function () {
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
                return allMatches.length;
            },

            input: function () {
                this.$emit("change", this.id, this.detailValue);
                this.blankCount = this.updateCurrentBlankCount();
            },
            triggerBrowse(ref) {
                this.$refs[ref].triggerBrowseFiles();
            },
            imageUploaded: function (file, result) {
                console.log("in image uploaded");
                this.setQuestionDetailsByKey({key: 'image_upload', value: result});
            },
            audioUploaded: function (file, result) {
                console.log("in audio uploaded");
                this.setQuestionDetailsByKey({key: 'audio_upload', value: result});
            },
            htmlTextChanges: function(value) {
                console.log("in html text changes");
                this.setQuestionDetailsByKey({key: 'html_text', value: value});
            },
            htmlText2Changes: function(value){
                console.log("in html text 2 changes");
                this.setQuestionDetailsByKey({key: 'html_text_2', value: value});
            }
        }
    };
</script>
