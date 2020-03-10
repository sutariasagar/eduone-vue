<template>
    <draggable tag="ul" :list="list" class="list-group">
        <li class="list-group-item" v-for="(suggestions, index) in list" :key="index">
            <vue-transmit
                :ref="'uploader_' + index"
                :url="uploadUrl"
                :headers="headers"
                paramName="file"
                v-model="list[index].url"
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

                <!-- Scoped slot -->
                <template slot="files" slot-scope="image_props">
                    <div
                        v-for="(file, i) in image_props.files"
                        :key="file.id"
                        :class="{'mt-5': i === 0}"
                    >
                        <div class="media">
                            <img :src="file.dataUrl" class="img-fluid d-flex mr-3">
                            <div class="media-body">
                                <h3>{{ file.name }}</h3>
                                <div class="progress" style="width: 50%;">
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
    name: "OrderedImages",

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
            this.setQuestionDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
        }
    },

    methods: {
        ...mapActions("QuestionsBanksSingle", [
            "setQuestionDetailsByKey",
        ]),
        addItemInList: function () {
            let list = JSON.parse(JSON.stringify(this.list));
            list.push({chosen: "", url: ''});
            this.$set(this, "list", list);
            this.currentIndex = this.currentIndex + 1
        },
        removeItem: function (index) {
            let list = JSON.parse(JSON.stringify(this.list));
            if (list && list[index]) {
                list.splice(index, 1);
            }
            this.$set(this, "list", list);
        },
        suggestionsChanged: function() {
            this.setQuestionDetailsByKey({key: 'ordered_images', value: {suggestions: JSON.parse(JSON.stringify(this.list))}})
        },
        triggerBrowse(index) {
            this.currentIndex = index;
        },
        imageUploaded: function(file, result) {

            console.log("image update", this.list);
            let list = JSON.parse(JSON.stringify(this.list));
            list[this.currentIndex].url = result.data.file_link_url[0];
            this.$set(this, "list", list);
        },
        dropped: function(index) {
            this.currentIndex = index;
        }
    }
};
</script>
