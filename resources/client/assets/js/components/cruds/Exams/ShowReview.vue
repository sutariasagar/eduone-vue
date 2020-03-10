<template>
    <section class="card">
        <section class="box">
            <b-tabs content-class="mt-3">
                <b-tab title="Speaking">
                    <div v-for="question in item.speaking" v-bind:key="question.id">
                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading :heading='question.question.title' :to="question.question.title"></custom-collapse-heading>
                                        <custom-collapse-body :uniqueId="question.question.title">
                                            <div class="box">
                                                <div class="box-footer mt-2">
                                                    <div class="question-header">Question:</div>
                                                    <div class=" mt-2" v-if="question.question.question_details.html_text" v-html="question.question.question_details.html_text"> </div>

                                                    <div class=" mt-2" v-if="question.question.question_details.image_upload">
                                                        <img width="200" :src="question.question.question_details.image_upload.data.file_link_url">
                                                    </div>
                                                    <audio controls v-if="question.question.question_details.audio_upload">
                                                        <source :src="question.question.question_details.audio_upload.data.file_link_url" type="audio/mp3">
                                                    </audio>
                                                    <div class="question-header">Answer:</div>
                                                    <!-- <div class="question-header mt-2" v-html="question.user_answer">

                                                    </div> -->
                                                    <audio controls v-if="question.user_answer">
                                                        <source :src="$APP_EXAM_URL+question.user_answer" type="audio/mp3">
                                                    </audio>
                                                    <div class="question-header" v-if="question.question.question_skills.length > 0"> Skills:
                                                    </div>

                                                    <form @submit.prevent="submitForm(question.id)" :id="'skill-score-'+question.id" :name="'skill-score-'+question.id" novalidate>
                                                        <div class=" mt-2">
                                                            <div class="form-group row" v-if="question.question.question_skills.length > 0">
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Skill</th>
                                                                            <th>Max Score</th>
                                                                            <th>Negative Marking</th>
                                                                            <th>Count in Communicative Skill Score</th>
                                                                            <th>Count in Enabling Skill Score</th>
                                                                            <th>Score</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        <tr v-for="(qskill,index) in question.question.question_skills" :key="index">
                                                                            <!--<td>{{ qskill }}</td>-->
                                                                            <!--<td>{{ index }}</td>-->
                                                                            <td>{{ qskill.skill.title }}</td>
                                                                            <td>{{ qskill.max_score }}</td>
                                                                            <td>{{ qskill.have_negative_marks }}</td>
                                                                            <td>{{ qskill.count_in_overall_score }}</td>
                                                                            <td>{{ qskill.count_in_skill_score }}</td>
                                                                            <td>
                                                                                <input type="number" class="border-1 form-control" :value="checkAnswerInScore(qskill.skill.title, question.score)" :data-skill="qskill.skill.title"
                                                                                       :data-maxScore="qskill.max_score" :data-negativeMarking="qskill.have_negative_marks" :data-overAllScore="qskill.count_in_overall_score"
                                                                                       :data-skillScore="qskill.count_in_skill_score" :max="qskill.max_score" :min="-1" :data-answerid="question.id">
                                                                            </td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-sm btn-primary" @click="saveFormAsDraft(question.id)">Save As Draft</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-tab>
                <b-tab title="Writing">
                    <div v-for="question in item.writing" v-bind:key="question.id">
                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading :heading='question.question.title+": "+question.id' :to="question.question.title"></custom-collapse-heading>
                                        <custom-collapse-body :uniqueId="question.question.title">
                                            <div class="box">
                                                <div class="box-footer mt-2">
                                                    <div class="question-header">Question:</div>
                                                    <div class=" mt-2" v-html="question.question.question_details.html_text">

                                                    </div>
                                                    <div class="question-header">Answer:</div>
                                                    <div class=" mt-2" v-html="question.user_answer">

                                                    </div>
                                                    <div class="question-header" v-if="question.question.question_skills.length > 0"> Skills:
                                                    </div>

                                                    <form @submit.prevent="submitForm(question.id)" :id="'skill-score-'+question.id" :name="'skill-score-'+question.id" novalidate>
                                                        <div class=" mt-2">
                                                            <div class="form-group row" v-if="question.question.question_skills.length > 0">
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Skill</th>
                                                                            <th>Max Score</th>
                                                                            <th>Negative Marking</th>
                                                                            <th>Count in Communicative Skill Score</th>
                                                                            <th>Count in Enabling Skill Score</th>
                                                                            <th>Score</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        <tr v-for="(qskill,index) in question.question.question_skills" :key="index">
                                                                            <!--<td>{{ qskill }}</td>-->
                                                                            <!--<td>{{ index }}</td>-->
                                                                            <td>{{ qskill.skill.title }}</td>
                                                                            <td>{{ qskill.max_score }}</td>
                                                                            <td>{{ qskill.have_negative_marks }}</td>
                                                                            <td>{{ qskill.count_in_overall_score }}</td>
                                                                            <td>{{ qskill.count_in_skill_score }}</td>
                                                                            <td>
                                                                                <input type="number" class="border-1 form-control" :value="checkAnswerInScore(qskill.skill.title, question.score)" :data-skill="qskill.skill.title"
                                                                                       :data-maxScore="qskill.max_score" :data-negativeMarking="qskill.have_negative_marks" :data-overAllScore="qskill.count_in_overall_score"
                                                                                       :data-skillScore="qskill.count_in_skill_score" :max="qskill.max_score" :min="-1" :data-answerid="question.id">
                                                                            </td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-sm btn-primary" @click="saveFormAsDraft(question.id)">Save As Draft</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-tab>               
                <b-tab title="Listening SST">
                    <div v-for="question in item.listeningsst" v-bind:key="question.id">
                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading :heading='question.question.title+": "+question.id' :to="question.question.title"></custom-collapse-heading>
                                        <custom-collapse-body :uniqueId="question.question.title">
                                            <div class="box">
                                                <div class="box-footer mt-2">
                                                    <div class="question-header">Question:</div>
                                                    <div class=" mt-2" v-if="question.question.question_details.html_text" v-html="question.question.question_details.html_text"></div>
                                                    <audio controls v-if="question.question.question_details.audio_upload">
                                                        <source :src="question.question.question_details.audio_upload.data.file_link_url" type="audio/mp3">
                                                    </audio>
                                                    <div class="question-header">Answer:</div>
                                                    <div class=" mt-2" v-html="question.user_answer"></div>
                                                    <div class="question-header" v-if="question.question.question_skills.length > 0"> Skills:
                                                    </div>

                                                    <form @submit.prevent="submitForm(question.id)" :id="'skill-score-'+question.id" :name="'skill-score-'+question.id" novalidate>
                                                        <div class=" mt-2">
                                                            <div class="form-group row" v-if="question.question.question_skills.length > 0">
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Skill</th>
                                                                            <th>Max Score</th>
                                                                            <th>Negative Marking</th>
                                                                            <th>Count in Communicative Skill Score</th>
                                                                            <th>Count in Enabling Skill Score</th>
                                                                            <th>Score</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        <tr v-for="(qskill,index) in question.question.question_skills" :key="index">
                                                                            <!--<td>{{ qskill }}</td>-->
                                                                            <!--<td>{{ index }}</td>-->
                                                                            <td>{{ qskill.skill.title }}</td>
                                                                            <td>{{ qskill.max_score }}</td>
                                                                            <td>{{ qskill.have_negative_marks }}</td>
                                                                            <td>{{ qskill.count_in_overall_score }}</td>
                                                                            <td>{{ qskill.count_in_skill_score }}</td>
                                                                            <td>
                                                                                <input type="number" class="border-1 form-control" :value="checkAnswerInScore(qskill.skill.title, question.score)" :data-skill="qskill.skill.title"
                                                                                       :data-maxScore="qskill.max_score" :data-negativeMarking="qskill.have_negative_marks" :data-overAllScore="qskill.count_in_overall_score"
                                                                                       :data-skillScore="qskill.count_in_skill_score" :max="qskill.max_score" :min="-1" :data-answerid="question.id">
                                                                            </td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-sm btn-primary" @click="saveFormAsDraft(question.id)">Save As Draft</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-tab>
                <b-tab title="Listening ROL">
                    <div v-for="question in item.listeningrol" v-bind:key="question.id">
                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading :heading='question.question.title+": "+question.id' :to="question.question.title"></custom-collapse-heading>
                                        <custom-collapse-body :uniqueId="question.question.title">
                                            <div class="box">
                                                <div class="box-footer mt-2">
                                                    <div class="question-header">Question:</div>
                                                    <div class=" mt-2" v-if="question.question.question_details.html_text" v-html="question.question.question_details.html_text"></div>
                                                    <audio controls v-if="question.question.question_details.audio_upload">
                                                        <source :src="question.question.question_details.audio_upload.data.file_link_url" type="audio/mp3">
                                                    </audio>
                                                    <div class="question-header">Answer:</div>
                                                    <div class=" mt-2" v-if="question.user_answer && !question.user_answer.startsWith('[')" v-html="question.user_answer"></div>
                                                    <div class=" mt-2" v-else>
                                                        <ul v-if="question.user_answer">
                                                            
                                                            <li v-for="user_answer in JSON.parse(question.user_answer)" v-bind:key='user_answer'>
                                                                {{user_answer}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="question-header" v-if="question.question.question_skills.length > 0"> Skills:
                                                    </div>

                                                    <form @submit.prevent="submitForm(question.id)" :id="'skill-score-'+question.id" :name="'skill-score-'+question.id" novalidate>
                                                        <div class=" mt-2">
                                                            <div class="form-group row" v-if="question.question.question_skills.length > 0">
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Skill</th>
                                                                            <th>Max Score</th>
                                                                            <th>Negative Marking</th>
                                                                            <th>Count in Communicative Score</th>
                                                                            <th>Count in Enabling Skill Score</th>
                                                                            <th>Score</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        <tr v-for="(qskill,index) in question.question.question_skills" :key="index">
                                                                            <!--<td>{{ qskill }}</td>-->
                                                                            <!--<td>{{ index }}</td>-->
                                                                            <td>{{ qskill.skill.title }}</td>
                                                                            <td>{{ qskill.max_score }}</td>
                                                                            <td>{{ qskill.have_negative_marks }}</td>
                                                                            <td>{{ qskill.count_in_overall_score }}</td>
                                                                            <td>{{ qskill.count_in_skill_score }}</td>
                                                                            <td>
                                                                                <input type="number" class="border-1 form-control" :value="checkAnswerInScore(qskill.skill.title, question.score)" :data-skill="qskill.skill.title"
                                                                                       :data-maxScore="qskill.max_score" :data-negativeMarking="qskill.have_negative_marks" :data-overAllScore="qskill.count_in_overall_score"
                                                                                       :data-skillScore="qskill.count_in_skill_score" :max="qskill.max_score" :min="-1" :data-answerid="question.id">
                                                                            </td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-sm btn-primary" @click="saveFormAsDraft(question.id)">Save As Draft</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-tab>
                <b-tab title="Generate Result">
                    <div class="card-body">
                        <div class="row card-with-shadow pt-3 custom-shadow">
                            <div class="w-100">
                                <div class="mb-5 text-center">
                                    <b-button v-b-modal.exammodal @click="fetchResult">Get Result</b-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-tab>
            </b-tabs>
        </section>
        <b-modal  ref="student" id="exammodal" :hide-footer='false' header-class='custom-sidebar-no-hover' title="Result Information" ok-only>
            <div class="d-block pt-5 pb-5" v-if="resultData">
                <p>Overall Score:  {{resultData.overall_communicative_skills}}</p>
                <p>Communicative Skill</p>
                <!--{{resultData}}-->
                <!--{{resultData.communicative_skill}}-->
                <p v-for="(cks, index) in resultData.communicative_skills" v-bind:key="index">
                    {{index}} - {{cks.skill_score}}
                </p>

                <p>Enabling Skill</p>

                <p v-for="(eks,index) in resultData.enabling_skills" v-bind:key="index">
                    {{ index }} - {{eks.skill_score}}
                </p>
                <a :href="resultData.result_url" target="_blank" class="btn btn-default">Download PDF</a>
            </div>
        </b-modal>
        <div class="mb-5">
            <back-to-index :linkname="'exams.index'"></back-to-index>
        </div>
    </section>
</template>


<script>
  import { mapGetters, mapActions } from 'vuex'
  var context;


  export default {
    data() {
      return {
      }
    },
    created() {
      console.log("route params", this.$route.params.exam_id , this.$route.params.id );
      this.fetchData(this.$route.params)
      this.$root.relationships = this.relationships
    },
    mounted() {
      context = this;
     // console.log("section",this.section);
    },
    destroyed() {
      this.resetState()
    },
    computed: {
      ...mapGetters('ExamsReview', ['item','resultData']),
    },
    watch: {
      "$route.params.id": function() {
        this.resetState()
        console.log("in wath");
        this.fetchData(this.$route.params)
      }
    },
    methods: {
      ...mapActions('ExamsReview', ['fetchData', 'resetState','setScore','getResult']),
      checkAnswerInScore(skillName, score){
        if(score){

          let skills = score.skills;
          for(var skill in skills){
            console.log("skils", skills[skill])
            if(skills[skill].skill == skillName){
              return skills[skill].value;
            }
          }
        }else{
          return 0;
        }
      },
      submitForm(questionId){
        let form = document.getElementById('skill-score-'+questionId);

        let elements = form.getElementsByTagName('input');
        let scoreArray = [];
        let totalScore = 0;
        let scoreObject = {};
        for(var i=0; i<elements.length; i++){
          let element = elements[i];
          let score = {
            value : element.value,
            skill : element.getAttribute('data-skill'),
            max_score : element.getAttribute('data-maxScore'),
            negative_marking : element.getAttribute('data-negativeMarking'),
            over_all_Score : element.getAttribute('data-overAllScore'),
            skill_score : element.getAttribute('data-skillScore'),
            id : element.getAttribute('data-answerid')
          }
          scoreArray.push(score);
          totalScore += parseInt(element.value);
        }
        scoreObject.skills = scoreArray;
        scoreObject.total_score = totalScore;
        scoreObject.answer_id = questionId;
        scoreObject.status = 'submitted';
        //console.log(scoreObject);
        this.setScore(scoreObject);
//        temporary commenting
        let parentDiv = form.closest(".card-body").parentNode;
        parentDiv.parentNode.removeChild(parentDiv);
        //        temporary commenting ends here
      },
      saveFormAsDraft(questionId){
        let form = document.getElementById('skill-score-'+questionId);
        let elements = form.getElementsByTagName('input');
        let scoreArray = [];
        let totalScore = 0;
        let scoreObject = {};
        for(var i=0; i<elements.length; i++){
          let element = elements[i];
          let score = {
            value : element.value,
            skill : element.getAttribute('data-skill'),
            max_score : element.getAttribute('data-maxScore'),
            negative_marking : element.getAttribute('data-negativeMarking'),
            over_all_Score : element.getAttribute('data-overAllScore'),
            skill_score : element.getAttribute('data-skillScore'),
            id : element.getAttribute('data-answerid')
          }
          scoreArray.push(score);
          totalScore += parseInt(element.value);
        }
        scoreObject.skills = scoreArray;
        scoreObject.total_score = totalScore;
        scoreObject.answer_id = questionId;
        scoreObject.status = 'draft';
        //console.log(scoreObject);
        this.setScore(scoreObject);
      },
      saveScore(){
        this.setScore(score);
      },
      fetchResult(){
        this.getResult(this.$route.params);
      }
    }
  }
</script>


<style scoped>
    .question-header {
        font-weight: bold;
    }
    .text {
        font-weight: normal;
    }
</style>
