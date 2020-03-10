<template>
    <div class="">
        <main role="main" class="container cstcontainer">
			<!-- <div class="shadow-sm p-4 bg-white rounded mt-4 mb-4 text-uppercase text-center w-100">
				<b>Home >></b> <span class="font-weight-lighter">Practice Questions</span>
			</div> -->
			<div class="cstquestion">
				<div class="card shadow-sm">
			  		<div class="card-body">
			  			<h6 class="text-uppercase font-weight-bold fontres14">View Practice Questions</h6>
			  			<div class="card shadow-sm mt-3">
						  	<h6 class="card-header text-uppercase bg-white font-weight-bold">Basic Information</h6>
					  		<div class="card-body">
					  			<form @submit.prevent="submitForm" novalidate style="min-height: 100px">
						  			<div class="form-group">
						  				<label class="cst-label font-weight-bolder">Subject <span class="text-danger">*</span></label>
						  				<v-select
                                                                label="title"
                                                                name="subject"
                                                                placeholder="Enter Subject *"
                                                                autocomplete="off"
                                                                :value="item.subject"
                                                                @input="updateSubject"
                                                                :options="subjectsAll"
                                                            />
						  			</div>
						  			<div class="form-group">
						  				<label class="cst-label font-weight-bolder">Chapter <span class="text-danger">*</span></label>
						  				 <v-select
                                                                label="title"
                                                                name="chapter"
                                                                placeholder="Enter Chapter *"
                                                                autocomplete="off"
                                                                :value="item.chapter"
                                                                @input="updateChapter"
                                                                :options="chaptersAll"
                                                            />
						  			</div>
						  			<div class="form-group">
						  				<label class="cst-label font-weight-bolder">Level <span class="text-danger">*</span></label>
						  				 <v-select
                                                                label="title"
                                                                name="level"
                                                                placeholder="Enter Level *"
                                                                autocomplete="off"
                                                                :value="item.level"
                                                                @input="updateLevel"
                                                                :options="levelsAll"
                                                            />
						  			</div>
						  			<div class="mt-4 text-right">
                                           <button
                                                            class="btn btn-sm bg-theme text-white cstbtnres" type="submit"
                                                        >
                                                            Start Practice Questions
                                           </button>
                                                        <back-buttton class="btn btn-sm btn-secondary cstbtnres"></back-buttton>
						  			</div>
					  			</form>
					  		</div>
						</div>
			  		</div>
				</div>
			</div>
		</main>
    </div>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
            showSummary: false,
        }
    },
    created() {
        this.$eventHub.$on('toggle-called', this.toggleColumns)
        //this.fetchCoursesAndChaptersPracticeQuestions()
    },
    mounted() {
        let context = this;
        this.resetState();
        context.fetchSubjectsAll();
        context.fetchChaptersAll();
    },
    destroyed() {
        //this.resetState();
    },
    components: {

    },
    computed: {
        //...mapGetters('StudentPanel', ['coursesAndChaptersPracticeQuestions'])
        ...mapGetters("PracticeQuestionsTest", [
                "item",
                'subjectsAll',
                'chaptersAll',
                'levelsAll'
            ])
    },
    watch: {

    },
    methods: {
        //...mapActions('StudentPanel', ['fetchCoursesAndChaptersPracticeQuestions', 'resetState']),
        ...mapActions("PracticeQuestionsTest", [
            "setSubject",
            "setChapter",
            "setLevel",
            "fetchData",
            "fetchSubjectsAll",
            "fetchChaptersAll",
            "resetState"
        ]),
        toggleColumns(){
            this.showSummary = !this.showSummary;
        },
        updateSubject(value) {
            this.setSubject(value);
        },
        updateLevel(value) {
            this.setLevel(value);
        },
        updateChapter(value) {
            this.setChapter(value);
        },
        submitForm() {
            //console.log(this.item.subject.id);

            let data = {};
            data.subject = this.item.subject.id;
            data.chapter = this.item.chapter.id;
            data.level = this.item.level;
            console.log(data);
            this.fetchData(data)
                    .then(()=>{
                        this.$router.push({name: "student.practicequestions.test", params:{id:'1'}});
                    });
            ;
            //this.$router.push({name:'student.practicequestions.test',params: { subjectid: this.item.subject.id, chapterid: this.item.chapter.id }})
            // this.storeData()
            //     .then(() => {
            //         //this.$router.push({name: "questions_banks.index"});
            //         this.$eventHub.$emit("create-success");
            //     })
            //     .catch(error => {
            //         console.error(error);
            //     });
        },
    }
}
</script>
