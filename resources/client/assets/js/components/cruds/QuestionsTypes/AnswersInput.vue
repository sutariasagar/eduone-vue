<template>
    <div>
        <!-- HTML Text Starts -->
        <div v-if="id == 'html_text'" class="row">
            <div class="col-md-3">
                <label :for="name">
                    {{ label }}
                    <span v-if="require" class="text-danger">*</span>
                </label>
            </div>
            <div :class="contentClass">

                <div>
                    This is will dispayed while giving answer;
                </div>
            </div>
        </div>
        <!-- HTML Text Ends -->
    
        <!-- HTML Text Starts -->
        <div v-if="id == 'html_text_2'" class="row">
            <div class="col-md-3">
                <label :for="name">
                    {{ label }}
                    <span v-if="require" class="text-danger">*</span>
                </label>
            </div>
            <div :class="contentClass">
                <div>
                    This is will dispayed while giving answer;
                </div>
            </div>
        </div>
        <!-- HTML Text Ends -->

        <!-- Image upload starts -->
        <div class="row" v-if="id == 'image_upload'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <div>
                    This is will dispayed while giving answer;
                </div>
            </div>
        </div>
        <!-- Image upload ends -->

        <!-- Audio upload starts -->
        <div class="row" v-if="id == 'audio_upload'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <div>
                    This is will dispayed while giving answer;
                </div>
            </div>
        </div>
        <!-- Audio upload ends -->

        <!-- Youtube video code start -->
        <div class="row" v-if="id == 'youtube_video'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <div>
                    This is will dispayed while giving answer;
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



        <!-- FIB with DropDown starts -->
        <div class="row" v-if="id == 'fib_dropdown'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <answer-f-i-b-dropdown></answer-f-i-b-dropdown>
            </div>
        </div>
        <!-- FIB with DropDown ends -->

        <!-- FIB with Drag and Drop starts -->
        <div class="row" v-if="id == 'fib_drag_drop'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">
                <answer-f-i-b-drag-drop />
            </div>
        </div>
        <!-- FIB with Drag and Drop ends -->

        <!-- FIB with No options starts -->
        <div class="row" v-if="id == 'fib_no_options'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">
                <answer-f-i-b-no-options />
            </div>
        </div>
        <!-- FIB with No options ends -->

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

        <!-- Select text start -->
        <div class="row" v-if="id == 'select_text'">
            <label :for="name" :class="labelClass">
                {{ label }}
                <span v-if="require" class="text-danger">*</span>
            </label>
            <div :class="contentClass">

                <answer-select-text
                        v-if="id == 'select_text'"
                ></answer-select-text>
            </div>
        </div>
        <!-- Select text ends -->

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
    import OrderedText from "../AnswersTypes/AnswerOrderedText.vue";
    import OrderedImages from "../AnswersTypes/AnswerOrderedImages.vue";
    import MCQSingleOption from "../AnswersTypes/AnswerMCQSingleOption.vue";
    import MCQMultipleOption from "../AnswersTypes/AnswerMCQMultipleOption.vue";
    import AnswerFIBDropdown from "../AnswersTypes/AnswerFIBDropdown.vue";
    import AnswerFIBDragDrop from "../AnswersTypes/AnswerFIBDragDrop";
    import AnswerFIBNoOptions from "../AnswersTypes/AnswerFIBNoOptions";
    import AnswerSelectText from "../AnswersTypes/AnswerSelectText.vue";

    export default {
        name: "AnswerTypeInput",

        components: {
            OrderedText,
            OrderedImages,
            MCQSingleOption,
            MCQMultipleOption,
            AnswerFIBDropdown,
            AnswerFIBDragDrop,
            AnswerFIBNoOptions,
            AnswerSelectText
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

        mounted() {
            let context = this;
            context.htmlTextChanges(this.id);
            context.htmlText2Changes(this.id);
            context.imageUploaded(this.id);
            context.audioUploaded(this.id);
        },

        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setBlankCount",
                "setAnswerDetailsByKey",
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
                        //this.destroyUploadedFile(id);
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
            // imageUploaded: function (file, result) {
            //     this.$emit("change", this.id, result);
            // },
            // audioUploaded: function (file, result) {
            //     this.$emit("change", this.id, result);
            // },
            orderedTextChanged: function (list) {
                this.$emit("change", this.id, list, this.type);
            },
            addOrderedText: function (list) {
                console.log("in input for orderee dtext");
                //this.$emit("add", this.id, list);
            },
            ordereImagesChanged: function (list) {
                this.$emit("change", this.id, list);
            },
            MCQSingleOptionChanged: function (list) {
                this.$emit("change", this.id, list);
            },
            MCQMultipleOptionChanged: function (list) {
                this.$emit("change", this.id, list);
            },
            htmlTextChanges: function(id) {
                console.log("outer if in htmlTextChanges");
                if(id == "html_text"){
                    console.log("in htmlTextChanges");
                    this.setAnswerDetailsByKey({key: 'html_text', value: ''});
                }
            },
            htmlText2Changes: function(id){
                console.log("outer if in htmlText2Changes");
                if(id == "html_text_2"){
                    console.log("in htmlText2Changes");
                    this.setAnswerDetailsByKey({key: 'html_text_2', value: ''});
                }
            },
            imageUploaded: function (id) {
                console.log("outer if in imageUploaded");
                if(id == "image_upload"){
                    console.log("in imageUploaded");
                    this.setAnswerDetailsByKey({key: 'image_upload', value: ''});
                }
            },
            audioUploaded: function (id) {
                console.log("outer if in audioUploaded");
                if(id == "audio_upload"){
                    console.log("in audioUploaded");
                    this.setAnswerDetailsByKey({key: 'audio_upload', value: ''});
                }
            },
        }
    };
</script>
