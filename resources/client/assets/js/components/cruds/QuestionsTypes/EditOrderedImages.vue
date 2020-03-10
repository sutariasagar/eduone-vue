<template>
    <draggable tag="ul" :list="item.question_details.ordered_images.suggestions" class="list-group">
        <li class="list-group-item" v-for="(suggestions, index) in item.question_details.ordered_images.suggestions" :key="index">
            <vue-transmit
                    :ref="'uploader_' + index"
                    :url="uploadUrl"
                    :headers="headers"
                    paramName="file"
                    :maxFiles="Number(1)"
                    :acceptedFileTypes="['image/*']"
                    @success="imageUploaded"
                    @drop="dropped(index)"
                    :clickable="true"
            >
                <div class="uploadFileBox text-center pointer" @click="triggerBrowse(index)">
                    <i class="fa fa-cloud-upload fa-5x">&nbsp;</i>
                    <p>Drag file or Click here to choose the image</p>
                </div>


            </vue-transmit>
            <div class="input-group-append">
                <div class="media">
                    <img :src="suggestions.url" class="img-fluid d-flex mr-3">
                </div>
                <span class="input-group-text">
                        <span class="pull-right">
                            <i class="fa fa-trash-o" @click="removeItem(index)">&nbsp;</i>
                        </span>
                    </span>
            </div>
        </li>
        <div
                slot="footer"
                class="btn-group list-group-item"
                role="group"
                aria-label="Basic example"
                key="footer"
        >
            <button class="btn btn-secondary" @click="addItemInList()" type="button">Add</button>
        </div>
    </draggable>
</template>
<style scoped="">
</style>
<script>
    import {mapActions, mapGetters} from "vuex";
    import draggable from "vuedraggable";

    export default {
        name: "EditOrderedImages",

        components: { draggable },

        props: [],

        data() {
            return {
                list: [
                    {
                        url: "",
                        chosen: false
                    }
                ],
                uploadUrl: "/api/v1/media",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },
                results: [],
                files: [],
                currentIndex: 0
            };
        },
        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
            ])

        },
        watch: {
            list: function () {
                //this.setQuestionDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
            }
        },

        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "setQuestionDetailsByKey",
            ]),
//            addItemInList: function () {
//                let list = JSON.parse(JSON.stringify(this.list));
//                list.push({chosen: "", url: ''});
//                this.$set(this, "list", list);
//                this.currentIndex = this.currentIndex + 1
//            },
//            removeItem: function (index) {
//                let list = JSON.parse(JSON.stringify(this.list));
//                if (list && list[index]) {
//                    list.splice(index, 1);
//                }
//                this.$set(this, "list", list);
//            },
//            suggestionsChanged: function() {
//                this.setQuestionDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
//            },

            addItemInList: function () {
                let list = JSON.parse(JSON.stringify(this.item.question_details.ordered_images.suggestions));
                list.push({url: "", chosen: false});
                console.log(list);
                //this.$set(this, "list", list);
                this.setQuestionDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(list))}})
            },
            removeItem: function (index) {
                let list = JSON.parse(JSON.stringify(this.item.question_details.ordered_images.suggestions));
                if (list && list[index]) {
                    list.splice(index, 1);
                }
                this.setQuestionDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(list))}})
                //this.$set(this, "list", list);
            },
            triggerBrowse(index) {
                this.currentIndex = index;
            },
            imageUploaded: function(file, result) {

                console.log("image update", this.item.question_details.ordered_images.suggestions);
                let list = JSON.parse(JSON.stringify(this.item.question_details.ordered_images.suggestions));
                list[this.currentIndex].url = result.data.file_link_url[0];

                this.setQuestionDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(list))}})
            },
            dropped: function(index) {
                this.currentIndex = index;
            }
        }
    };
</script>
