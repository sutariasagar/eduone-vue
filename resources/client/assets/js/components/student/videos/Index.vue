<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> View Videos</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    
                    <b-tabs content-class="mt-3 p-3" class="p-3 cardvideo">
                        <b-tab :title="subject.title" v-for="subject in coursesAndChapters" v-bind:key="'subject_'+subject.id">
                            <div class="card-body " v-for="chapter in subject.chapters" v-bind:key="'chapter_'+chapter.id" v-if="chapter.learning_materials.length > 0">
                                <div class="row card-with-shadow pt-3 custom-shadow">
                                    <div class="w-100">                            
                                        <div class="mb-5" >                                    
                                            <custom-collapse-heading :heading="chapter.title" :to="'chapter_course_'+subject.id+'_'+chapter.id" ></custom-collapse-heading>
                                            <custom-collapse-body :uniqueId="'chapter_course_'+subject.id+'_'+chapter.id" :visible='true' :chapterId="chapter.id" :subjectId="subject.id">       

                                            <div class="cui-video-page-feeds">
                                                <div class="cui-video-page-feed-partition">

                                                
                                                <ul class="cui-video-page-partition-content" v-for="learning_materials in chapter.learning_materials" v-bind:key="learning_materials.id">
                                                    <li class="cui-video-page-next-item cui-video-page-next-item-feed col-md-3" v-for="learning_materials_documents in learning_materials.learning_material_videos" v-bind:key="learning_materials_documents.id">
                                                        <div class="card shadow mt-3">
                                                        <h6 class="cst-header card-header text-uppercase bg-white font-weight-bold">{{learning_materials_documents.title}}</h6>
                                                        <div class="card-body">
                                                            <div class="cstslides">
                                                                <div class="slidercn position-relative">
                                                                    <video-player :sources="learning_materials_documents.file_tag" :customId="learning_materials_documents.id" @play="documentPlayed"></video-player>
                                                                    <!-- <video controls width="100%" height="100%"  poster="images/slide.png">
                                                                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" />
                                                                        <source src="https://www.w3schools.com/html/mov_bbb.ogg" type="video/ogg" />
                                                                    </video> -->
                                                                </div>
                                                                <div class="cstcontent">
                                                                    <!-- <h6 class="fg-theme py-2 m-0">{{learning_materials_documents.title}}</h6> -->
                                                                    <p class="font13 cst888" v-html="learning_materials_documents.description"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                        
                                                    </li>                                                    
                                                </ul>  
                                                </div>
                                            </div>                                                                                                                
                                            </custom-collapse-body>                                                
                                        </div>                        
                                    </div>
                                </div>
                            </div>
                        </b-tab>
                    </b-tabs>
                </div>                        
            </div>        
        </div>
    </div>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'
import videoPlayer from '../../utils/VideoPlayer.vue';
export default {
    data() {
        return {
            // Code...
            showSummary: false
        }
    },
    created() {
        
        this.$eventHub.$on('toggle-called', this.toggleColumns)
        this.fetchCoursesAndChapters()
    },
    destroyed() {
        
    },
    components: {
        videoPlayer
    },
    computed: {
        ...mapGetters('StudentPanel', ['coursesAndChapters'])
    },
    watch: {
        
    },
    methods: {
        ...mapActions('StudentPanel', ['fetchCoursesAndChapters', 'resetState','fetchLearningVideos','setPlayedDocument']),
        toggleColumns(){
            this.showSummary = !this.showSummary;
        },
        documentPlayed(documentId){
            this.setPlayedDocument(documentId);
        }           
    }
}
</script>


<style scoped>
/*  STYLES FOR "YOUTUBE" MODULE */
.cui-video-page {
    max-width: 76.92rem;
    margin: 0 auto;
}

.cui-video-page-content img {
    max-width: 100%;
    height: auto;
    width: 100%;
}

.cui-video-page-feeds {
    max-width: 96.15rem;
    margin: 0 auto;
}

.cui-video-page .card {
    padding: 1.23rem;
}

.cui-video-page-main-content {
    float: left;
    width: calc(100% - 365px);
}

@media (max-width: 1199px) {
    .cui-video-page-main-content {
        width: 100%;
    }
}

.cui-video-page-descr {
    margin-top: 1.53rem;
}

.cui-video-page-add-comment {
    margin-bottom: 0.76rem;
    padding-bottom: 1.53rem;
    border-bottom: 1px solid #e4e9f0;
}

.cui-video-page-comment-user {
    float: left;
    padding-top: 1.38rem;
}

.cui-video-page-comment-form {
    margin-top: 0.61rem;
    margin-left: 5.38rem;
}

.cui-video-page-comment-send {
    padding-top: 0.76rem;
    padding-left: 5.38rem;
}

.cui-video-page-comment-time {
    font-size: 80%;
    font-weight: normal;
}

.cui-video-page-comment-like {
    padding-top: 0.23rem;
}

.cui-video-page-sidebar {
    float: right;
    width: 350px;
}

@media (max-width: 1199px) {
    .cui-video-page-sidebar {
        display: none;
    }
}

.cui-video-page-sidebar-head {
    padding-bottom: 0.53rem;
}

.cui-video-page-sidebar-title {
    display: inline-block;
}

.cui-video-page-autoplay-text {
    color: #74708d;
    font-weight: bold;
    cursor: pointer;
    position: relative;
    -webkit-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
    padding-right: 26px;
}

.cui-video-page-autoplay-text:before {
    content: '';
    position: absolute;
    right: 0;
    top: 3px;
    width: 15px;
    height: 15px;
    border: 1px solid #d2d9e5;
    border-radius: 2px;
    -webkit-transition: all 0.4s ease-in-out;
    transition: all 0.4s ease-in-out;
}

.cui-video-page-autoplay-text:after {
    content: '';
    position: absolute;
    right: 4.2px;
    top: 4.3px;
    width: 5px;
    height: 9px;
    border-right: 2px solid #fff;
    border-bottom: 2px solid #fff;
    -webkit-transform: rotate(25deg) scale(0.2);
            transform: rotate(25deg) scale(0.2);
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}

.cui-video-page-autoplay-text:hover:before {
    border-color: #08f;
}

.cui-video-page-autoplay-checkbox {
    display: none;
}

.cui-video-page-autoplay-checkbox:checked + .cui-video-page-autoplay-text:before {
    background: #08f;
    border-color: #08f;
}

.cui-video-page-autoplay-checkbox:checked + .cui-video-page-autoplay-text:after {
    -webkit-transform: rotate(40deg) scale(1);
            transform: rotate(40deg) scale(1);
}

.cui-video-page-watch-next {
    list-style: none;
    margin: 0;
    padding: 0;
}

.cui-video-page-next-item-link {
    display: block;
}

.cui-video-page-next-item-link:hover .cui-video-page-item-name {
    color: #08f;
}

.cui-video-page-next-item-link:hover .cui-video-page-item-author {
    color: #74708d;
}

.cui-video-page-next-item {
    display: block;
    padding-top: 0.92rem;
    padding-bottom: 0.92rem;
    border-top: 1px solid #e4e9f0;
}

.cui-video-page-item-thumb {
    float: left;
}

.cui-video-page-item-thumb-img {
    width: 170px;
}

.cui-video-page-item-descr {
    cursor: pointer;
    display: block;
    margin-left: 180px;
}

.cui-video-page-item-name {
    font-weight: bolder;
    display: block;
    color: #0e0b20;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}

.cui-video-page-item-author {
    display: block;
    color: #74708d;
    font-size: 0.92rem;
}

.cui-video-page-item-views {
    display: block;
    font-size: 0.92rem;
}

.cui-video-page-item-status {
    display: block;
}

.cui-video-page-feed-partition {
    padding-bottom: 0.76rem;
    margin-bottom: 2.3rem;
    position: relative;
}

.cui-video-page-feed-partition:after {
    content: '';
    position: absolute;
    display: block;
    bottom: 0;
    left: 0;
    right: 0.92rem;
    height: 1px;
    background-color: rgba(14, 11, 32, 0.1);
}

.cui-video-page-partition-content {
    display: -webkit-box;
    display: flex;
    flex-wrap: wrap;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
            flex-direction: row;
    align-content: flex-start;
    -webkit-box-align: start;
            align-items: flex-start;
    margin: 0;
    padding: 0;
    margin-right: -0.77rem;
}

@media (max-width: 1199px) {
    .cui-video-page-partition-content {
        justify-content: space-around;
    }
}

.cui-video-page-partition-title {
    font-size: 1.84rem;
    font-weight: bold;
    margin-bottom: 0;
    border-radius: 5px;
}

.cui-video-page-partition-thumb {
    display: inline-block;
    vertical-align: middle;
    margin-top: -0.16rem;
    width: 28px;
    height: 28px;
    border-radius: 5px;
}

.cui-video-page-next-item-feed {
    width: auto;
    border-top: none;
    margin-right: 0.76rem;
}

.cui-video-page-next-item-feed .cui-video-page-item-thumb {
    float: none;
}

.cui-video-page-next-item-feed .cui-video-page-item-thumb-img {
    width: 100%;
}

.cui-video-page-next-item-feed .cui-video-page-item-descr {
    margin-left: 0;
}

.cui-video-page-next-item-feed .cui-video-page-item-name {
    font-size: 1.07rem;
    color: #74708d;
    margin: 0.76rem 0 0.38rem;
    display: block;
}
.cardvideo .card .cst-header {
    border-top: 3px solid #c5446a;
    font-size: 14px;
}
.p-3{
    padding: .6rem !important;
}
</style>
