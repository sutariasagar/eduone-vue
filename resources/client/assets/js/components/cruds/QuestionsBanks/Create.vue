<template xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class>
        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong>Add A New Question</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <form @submit.prevent="submitForm" novalidate>
                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading heading="Question Details"
                                                                 to="basic"></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="basic">
                                            <div class="box">
                                                <div class="box-body">
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Title<span
                                                            class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="title"
                                                                placeholder="Enter Title *"
                                                                :value="item.title"
                                                                @input="updateTitle"
                                                            >
                                                            <bootstrap-error :name="'title'"
                                                                             v-if="errors && errors['title']"/>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="form-group row"
                                                        v-bind:class="{ 'has-danger': errors && errors['course'] }"
                                                    >
                                                        <label
                                                            for="course"
                                                            class="col-md-3 col-form-label"
                                                        >
                                                            Course
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="course"
                                                                placeholder="Enter Course *"
                                                                :value="item.course"
                                                                @input="updateCourse"
                                                                :options="coursesAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error
                                                                :name="'course'"
                                                                v-if="errors && errors['course']"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="form-group row"
                                                        v-bind:class="{ 'has-danger': errors && errors['subject'] }"
                                                    >
                                                        <label
                                                            for="subject"
                                                            class="col-md-3 col-form-label"
                                                        >
                                                            Subject
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="subject"
                                                                placeholder="Enter Subject *"
                                                                :value="item.subject"
                                                                @input="updateSubject"
                                                                :options="subjectsAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error
                                                                :name="'subject'"
                                                                v-if="errors && errors['subject']"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="form-group row"
                                                        v-bind:class="{ 'has-danger': errors && errors['chapter'] }"
                                                    >
                                                        <label
                                                            for="chapter"
                                                            class="col-md-3 col-form-label"
                                                        >
                                                            Chapter
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="chapter"
                                                                placeholder="Enter Chapter *"
                                                                :value="item.chapter"
                                                                @input="updateChapter"
                                                                :options="chaptersAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error
                                                                :name="'chapter'"
                                                                v-if="errors && errors['chapter']"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="form-group row"
                                                        v-bind:class="{ 'has-danger': errors && errors['topic'] }"
                                                    >
                                                        <label
                                                            for="topic"
                                                            class="col-md-3 col-form-label"
                                                        >Topic</label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="topic"
                                                                placeholder="Enter Topic "
                                                                :value="item.topic"
                                                                @input="updateTopic"
                                                                :options="topicsAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'topic'"/>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="form-group row"
                                                        v-bind:class="{ 'has-danger': errors && errors['subtopic'] }"
                                                    >
                                                        <label
                                                            for="subtopic"
                                                            class="col-md-3 col-form-label"
                                                        >Sub Topic</label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="subtopic"
                                                                placeholder="Enter Sub Topic "
                                                                :value="item.subtopic"
                                                                @input="updateSubTopic"
                                                                :options="subTopicsAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'subtopic'"/>
                                                        </div>
                                                    </div>
                                                    <div
                                                            class="form-group row"
                                                            v-bind:class="{ 'has-danger': errors && errors['tags'] }"
                                                    >
                                                        <label
                                                                for="tags"
                                                                class="col-md-3 col-form-label"
                                                        >
                                                            Tags

                                                        </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                    label="tag_name"
                                                                    name="tags"
                                                                    placeholder="Enter Tags"
                                                                    :value="item.tagged"
                                                                    @input="updateTags"
                                                                    :options="tagsAll"
                                                                    autocomplete="off"
                                                                    :taggable="true"
                                                                    :multiple="true"
                                                            />
                                                            <bootstrap-error
                                                                    :name="'tags'"
                                                                    v-if="errors && errors['tags']"
                                                            />
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['question_level'] }">
                                                        <label for="question_level" class="col-md-3 col-form-label">Question Level <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="question_level"
                                                                placeholder="Enter Question Level  *"
                                                                :value="item.question_level"
                                                                @input="updateSubTopic"
                                                            >
                                                            <bootstrap-error :name="'question_level'" v-if="errors && errors['question_level']"/>
                                                        </div>
                                                    </div>-->
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['header'] }">
                                                        <label for="header" class="col-md-3 col-form-label">Header<span
                                                            class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <vue-ckeditor
                                                                :id="'header'"
                                                                name="header"
                                                                placeholder="Enter Header *"
                                                                :value="item.header"
                                                                @input="updateHeader"
                                                                :config="config"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'header'"
                                                                             v-if="errors && errors['header']"/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['max_score'] }">
                                                                <label for="max_score" class="col-md-6 col-form-label">Total
                                                                    Max score<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="number"
                                                                        max="10000"
                                                                        min="0"
                                                                        class="form-control w-100"
                                                                        name="max_score"
                                                                        placeholder="Enter Max score *"
                                                                        :value="item.max_score"
                                                                        @input="updateMax_score"
                                                                    >
                                                                    <bootstrap-error
                                                                        :name="'max_score'"
                                                                        v-if="errors && errors['max_score']"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div
                                                                class="form-group row"
                                                                v-bind:class="{ 'has-danger': errors && errors['status'] }"
                                                            >
                                                                <label
                                                                    for="status"
                                                                    class="col-md-6 col-form-label"
                                                                >
                                                                    Status
                                                                    <span
                                                                        class="text-danger"
                                                                    >*</span>
                                                                </label>
                                                                <div class="col-md-6">
                                                                    <v-select
                                                                        name="status"
                                                                        @input="updateStatus"
                                                                        :value="item.status"
                                                                        :options="statusEnum"
                                                                    />
                                                                    <bootstrap-error
                                                                        :name="'status'"
                                                                        v-if="errors && errors['status']"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['include_in_free_package'] }">
                                                                <label for="include_in_free_package" class="col-md-6 col-form-label">Include In Free Pacakage<span class="text-danger">*</span></label>
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

                                                        <div class="col-md-6">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['include_in_practice_set'] }">
                                                                <label for="include_in_practice_set" class="col-md-6 col-form-label">Include In Practice Set<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="checkbox"                                                                        
                                                                        class="form-control w-100"
                                                                        name="include_in_practice_set"                                                                        
                                                                        :checked="item.include_in_practice_set"
                                                                        @change="updateInclude_in_practice_set"
                                                                    >
                                                                    <bootstrap-error
                                                                        :name="'include_in_practice_set'"
                                                                        v-if="errors && errors['include_in_practice_set']"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['attempt_time'] }">
                                                                <label for="attempt_time"
                                                                       class="col-md-6 col-form-label"> Attempt Time (in
                                                                    seconds)<span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="number"
                                                                        max="100000"
                                                                        min="0"
                                                                        class="form-control w-100"
                                                                        name="attempt_time"
                                                                        placeholder="Enter Attempt time *"
                                                                        :value="item.attempt_time"
                                                                        @input="updateAttempt_time"
                                                                    >
                                                                    <bootstrap-error :name="'attempt_time'"
                                                                                     v-if="errors && errors['attempt_time']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['preparation_time'] }">
                                                                <label for="preparation_time"
                                                                       class="col-md-6 col-form-label"> Preparation Time
                                                                    (in seconds)<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="number"
                                                                        max="1000"
                                                                        min="0"
                                                                        class="form-control w-100"
                                                                        name="preparation_time"
                                                                        placeholder="Enter Preparation time *"
                                                                        :value="item.preparation_time"
                                                                        @input="updatePreparation_time"
                                                                    >
                                                                    <bootstrap-error :name="'preparation_time'"
                                                                                     v-if="errors && errors['preparation_time']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['section_type'] }">
                                                                <label for="section_type"
                                                                       class="col-md-3 col-form-label">Section Type<span
                                                                    class="text-danger">*</span></label>
                                                                <div class="col-md-9">
                                                                    <v-select
                                                                        name="section_type"
                                                                        @input="updateSection_type"
                                                                        :value="item.section_type"
                                                                        :options="section_typeEnum"
                                                                    />
                                                                    <bootstrap-error :name="'section_type'"
                                                                                     v-if="errors && errors['section_type']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row"
                                                         v-if="item.section_type && item.section_type.value == 'writing'">
                                                        <div class="col-md-6">
                                                            <div
                                                                class="form-group row"
                                                                v-bind:class="{ 'has-danger': errors && errors['min_words'] }"
                                                            >
                                                                <label
                                                                    for="min_words"
                                                                    class="col-md-6 col-form-label"
                                                                >Answer Word Count From</label>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="number"
                                                                        class="form-control w-100"
                                                                        name="min_words"
                                                                        placeholder="Enter Min # of words"
                                                                        :value="item.min_words"
                                                                        @input="updateMin_words"
                                                                        min="0"
                                                                    >
                                                                    <bootstrap-error
                                                                        :name="'min_words'"
                                                                        v-if="errors && errors['min_words']"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div
                                                                class="form-group row"
                                                                v-bind:class="{ 'has-danger': errors && errors['max_words'] }"
                                                            >
                                                                <label
                                                                    for="max_words"
                                                                    class="col-md-6 col-form-label"
                                                                >Answer Word Count To</label>
                                                                <div class="col-md-6">
                                                                    <input
                                                                        type="number"
                                                                        class="form-control w-100"
                                                                        name="max_words"
                                                                        placeholder="Enter Max # of words"
                                                                        :value="item.max_words"
                                                                        @input="updateMax_words"
                                                                        min="0"
                                                                    >
                                                                    <bootstrap-error
                                                                        :name="'max_words'"
                                                                        v-if="errors && errors['max_words']"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['question_type'] }">
                                                                <label for="question_type"
                                                                       class="col-md-3 col-form-label">Question
                                                                    Type<span class="text-danger">*</span> </label>
                                                                <div class="col-md-9">
                                                                    <v-select
                                                                        name="question_type"
                                                                        label="title"
                                                                        @input="updateQuestion_type"
                                                                        :value="item.question_type"
                                                                        :options="questionstypesAll"
                                                                    />
                                                                    <bootstrap-error
                                                                        :name="'question_type'"
                                                                        v-if="errors && errors['question_type']"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['answer_type'] }">
                                                                <label for="answer_type"
                                                                       class="col-md-3 col-form-label">Answer Type<span
                                                                    class="text-danger">*</span></label>
                                                                <div class="col-md-9">
                                                                    <v-select
                                                                        name="answer_type"
                                                                        label="title"
                                                                        @input="updateAnswer_type"
                                                                        :value="item.answer_type"
                                                                        :options="answertypesAll"
                                                                    />
                                                                    <bootstrap-error :name="'answer_type'"
                                                                                     v-if="errors && errors['answer_type']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading heading="Skills Bifurcation"
                                                                 to="skills_bifurcation"></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="skills_bifurcation">
                                            <div class="box">
                                                <div class="box-footer mt-5">
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['skills'] }">
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <label for="skills" class="col-md-12 col-form-label">Skill</label>
                                                                <div class="col-md-12">
                                                                    <v-select
                                                                            label="title"
                                                                            name="skills"
                                                                            placeholder="Enter Skill *"
                                                                            :value="item.skills"
                                                                            :options="skillsAll"
                                                                            @input="updateSkill"
                                                                            autocomplete="off"
                                                                    />
                                                                    <bootstrap-error :name="'skills'"
                                                                                     v-if="errors && errors['skills']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <label for="skill_max_score" class="col-md-12 col-form-label">Max Score</label>
                                                                <div class="col-md-12">
                                                                    <input
                                                                            type="number"
                                                                            class="form-control"
                                                                            name="max_score"
                                                                            placeholder="Enter Title *"
                                                                            :value="item.skill_max_score"
                                                                            @input="updateMaxScore"
                                                                            min="0"

                                                                    >
                                                                    <bootstrap-error :name="'skill_max_score'"
                                                                                     v-if="errors && errors['skill_max_score']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <label for="have_negative_marks" class="text-center col-md-12 col-form-label">Negative Marking</label>
                                                                <div class="col-md-12 text-center">
                                                                    <input
                                                                            type="checkbox"
                                                                            class=""
                                                                            name="have_negative_marks"
                                                                            :value="item.have_negative_marks"
                                                                            @input="updateHasNegativeMarks"

                                                                    >
                                                                    <bootstrap-error :name="'have_negative_marks'"
                                                                                     v-if="errors && errors['have_negative_marks']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <label for="count_in_overall_score" class="text-center col-md-12 col-form-label">Count In Communicative Skill Score</label>
                                                                <div class="col-md-12 text-center">
                                                                    <input
                                                                            type="checkbox"
                                                                            name="count_in_overall_score"
                                                                            :value="item.count_in_overall_score"
                                                                            @input="updateCountInOverallScore"

                                                                    >
                                                                    <bootstrap-error :name="'count_in_overall_score'"
                                                                                     v-if="errors && errors['count_in_overall_score']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <label for="count_in_skill_score" class="col-md-12 col-form-label text-center">Count In Enabling Skill Score</label>
                                                                <div class="col-md-12 text-center">
                                                                    <input
                                                                            type="checkbox"
                                                                            name="count_in_skill_score"
                                                                            :value="item.count_in_skill_score"
                                                                            @input="updateCountInSkillScore"

                                                                    >
                                                                    <bootstrap-error :name="'count_in_skill_score'"
                                                                                     v-if="errors && errors['count_in_skill_score']"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button
                                                                    type="button"
                                                                    class="form-control vue-btn btn btn-purple btn-rounded mt-3 p-0"
                                                                    name="saveSkills"
                                                                    @click="updateQuestionSkills"
                                                            >Save</button>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row" v-if="item.question_skills">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Skill</th>
                                                                <th>Max Score</th>
                                                                <th>Negative Marking</th>
                                                                <th>Count in Communicative Skill Score</th>
                                                                <th>Count in Enabling Skill Score</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="(qskill,index) in item.question_skills" :key="index">
                                                                <!--<td>{{ qskill }}</td>-->
                                                                <!--<td>{{ index }}</td>-->
                                                                <td>{{ qskill.skill.title }}</td>
                                                                <td>{{ qskill.max_score }}</td>
                                                                <td>{{ qskill.have_negative_marks }}</td>
                                                                <td>{{ qskill.count_in_overall_score }}</td>
                                                                <td>{{ qskill.count_in_skill_score }}</td>
                                                                <td><button type="button" @click="deleteQuestionSkill(index)">Delete</button></td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" v-if="item.question_type">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading heading="Add Question Details"
                                                                 to="question_details"></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="question_details">
                                            <div class="box">
                                                <div class="box-footer mt-5">
                                                    <div
                                                        class="form-group"
                                                        v-for="question_type_configuration in item.question_type.configurations"
                                                        v-if="item.question_type && item.question_type.configurations"
                                                        v-bind:class="{ 'has-danger': errors && errors['question_details_'+question_type_configuration.key] }"
                                                    >
                                                        <question_type_input
                                                            v-if="question_type_configuration.chosen"
                                                            class="w-100"
                                                            :label="question_type_configuration.title"
                                                            :id="question_type_configuration.key"
                                                            :name="'question_details_'+question_type_configuration.key"
                                                            labelClass="col-md-3 col-form-label"
                                                            contentClass="col-md-9"
                                                            :required="true"
                                                            :type="'question'"
                                                            :fibOption="fibOption"
                                                            :isFib="question_type_configuration && question_type_configuration.isFib"
                                                            :fibDetails="question_type_configuration && question_type_configuration.isFib ? item.question_details[question_type_configuration.key] : null"
                                                        ></question_type_input>
                                                        <bootstrap-error
                                                            :name="'question_details_'+question_type_configuration.key"
                                                            v-if="errors && errors['question_details_'+question_type_configuration.key]"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" v-if="item.answer_type">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading heading="Add Answer Details"
                                                                 to="answer_details"></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="answer_details">
                                            <div class="box">
                                                <div class="box-footer mt-5">
                                                    <div
                                                        class="form-group"
                                                        v-for="answer_type_configuration in item.answer_type.configurations"
                                                        v-if="item.answer_type && item.answer_type.configurations"
                                                        v-bind:class="{ 'has-danger': errors && errors['answer_details_'+answer_type_configuration.key] }"
                                                    >
                                                        <answer_type_input
                                                            v-if="answer_type_configuration.chosen"
                                                            class="w-100"
                                                            :label="answer_type_configuration.title"
                                                            :id="answer_type_configuration.key"
                                                            :name="'answer_details_'+answer_type_configuration.key"
                                                            labelClass="col-md-3 col-form-label"
                                                            contentClass="col-md-9"
                                                            :required="true"
                                                            :fibOption="fibOption"
                                                            :type="'answer'"
                                                            :fibDetails="answer_type_configuration && answer_type_configuration.isFib ? item.answer_details[answer_type_configuration.key] : null"
                                                            :isFib="answer_type_configuration && answer_type_configuration.isFib"
                                                        ></answer_type_input>
                                                        <bootstrap-error
                                                            :name="'answer_details_'+answer_type_configuration.key"
                                                            v-if="errors && errors['answer_details_'+answer_type_configuration.key]"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="w-100">
                                    <div class="mb-5">
                                        <custom-collapse-heading heading="Add Solution"
                                                                 to="question_details"></custom-collapse-heading>
                                        <custom-collapse-body uniqueId="question_details">
                                            <div class="box">
                                                <div class="box-footer mt-5">
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['learning_material'] }">
                                                        <label for="learning_material" class="col-md-3 col-form-label">Learning
                                                            Material Set <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="learning_material"
                                                                placeholder="Enter Learning Material Set *"
                                                                :value="item.learning_material"
                                                                @input="updateLearningMaterial"
                                                                :options="learningMaterialsAll"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error :name="'learning_material'"
                                                                             v-if="errors && errors['learning_material']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['learning_material_documents'] }">
                                                        <label for="learning_material_documents"
                                                               class="col-md-3 col-form-label">Learning Material
                                                            Documents <span class="text-danger">*</span> </label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="learning_material_documents"
                                                                placeholder="Enter Learning Material Documents *"
                                                                :value="item.learning_material_documents"
                                                                @input="updateLearningMaterialDocuments"
                                                                :options="learningMaterialDocumentsAll"
                                                                autocomplete="off"
                                                                :multiple="true"
                                                            />
                                                            <bootstrap-error :name="'learning_material_documents'"
                                                                             v-if="errors && errors['learning_material_documents']"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['solution_html'] }">
                                                        <label for="solution_html" class="col-md-3 col-form-label">Solution
                                                            HTML</label>
                                                        <div class="col-md-9">
                                                            <vue-ckeditor
                                                                :id="'solution_html'"
                                                                name="solution_html"
                                                                placeholder="Enter Solution HTML *"
                                                                :value="item.solution_html"
                                                                @input="updateSolution_html"
                                                                :config="config"
                                                                autocomplete="off"
                                                            />
                                                            <bootstrap-error
                                                                :name="'solution_html'"
                                                                v-if="errors && errors['solution_html']"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['file'] }">
                                                        <label for="file" class="col-md-3 col-form-label">File </label>
                                                        <div class="col-md-9">
                                                            <input
                                                                type="file"
                                                                name="file"
                                                                @change="input"
                                                                autocomplete="off"
                                                                class="d-none"
                                                            />
                                                            <vue-transmit
                                                                ref="uploader"
                                                                :url='uploadUrl'
                                                                :headers="headers"
                                                                paramName="file"
                                                                @success="fileUploaded"
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
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row card-with-shadow pt-3 custom-shadow">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mb-5">
                                        <custom-collapse-body uniqueId="action_buttons">
                                            <div class="box">
                                                <div class="box-footer mt-5">
                                                    <vue-button-spinner
                                                        class="btn btn-purple mr-2 mb-2"
                                                        :isLoading="loading"
                                                        :disabled="loading"
                                                    >CREATE
                                                    </vue-button-spinner>
                                                    <back-buttton></back-buttton>
                                                </div>
                                            </div>
                                        </custom-collapse-body>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
    import {mapActions, mapGetters} from "vuex";
    import ckeditorConfig from "../../../config/ckeditor.json";

    import QuestionTypeInput from "../QuestionsTypes/Input.vue";
    import AnswerTypeInput from "../QuestionsTypes/AnswersInput.vue";

    export default {
        data() {
            return {
                // Code...
                config: ckeditorConfig,
                fibOption: null,
                uploadUrl: '/api/v1/media',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                },
                showSummary: false
            };
        },
        components: {
            question_type_input: QuestionTypeInput,
            answer_type_input: AnswerTypeInput
        },
        computed: {
            ...mapGetters("QuestionsBanksSingle", [
                "item",
                "loading",
                "coursesAll",
                "subjectsAll",
                "chaptersAll",
                "topicsAll",
                "subTopicsAll",
                "questionstypesAll",
                "learningMaterialsAll",
                "learningMaterialDocumentsAll",
                "answertypesAll",
                "tagsAll",
                "statusEnum",
                "section_typeEnum",
                "skillsAll"
            ]),
            ...mapGetters("Alert", ["errors"])
        },
        created() {
            this.$eventHub.$on('toggle-called', this.toggleColumns)
            //this.fetchQuestionstypesAll()
        },
        mounted() {
            let context = this;
            context.fetchCoursesAll();
            context.fetchSubjectsAll();
            context.fetchChaptersAll();
            context.fetchTopicsAll();
            context.fetchSubTopicsAll();
            context.fetchQuestionstypesAll();
            context.fetchAnswertypesAll();
            context.fetchLearningMaterialsAll();
            context.fetchLearningMaterialDocumentsAll();
            context.fetchTagsAll();
            context.fetchSkillsAll();
        },
        watch: {
            'item.question_type': function () {
                for (let index in this.item.question_type.configurations) {
                    let config = this.item.question_type.configurations[index];
                    if (config.isFib) {
                        this.fibOption = config.key;
                    }
                }
            }
        },
        destroyed() {
            this.resetState();
        },
        methods: {
            ...mapActions("QuestionsBanksSingle", [
                "storeData",
                "resetState",
                "setTitle",
                "setCourse",
                "setSubject",
                "setChapter",
                "setTopic",
                "setSubTopic",
                "setHeader",
                "setMax_score",
                "setPreparation_time",
                "setAttempt_time",
                "setStatus",
                "setMin_words",
                "setMax_words",
                "setSection_type",
                "setQuestion_type",
                "setAnswer_type",
                "setLearningMaterial",
                "setLearningMaterialDocuments",
                "setQuestion_details",
                "setAnswer_details",
                "setSolution_html",
                "fetchCoursesAll",
                "fetchSubjectsAll",
                "fetchChaptersAll",
                "fetchTopicsAll",
                "fetchSubTopicsAll",
                "fetchLearningMaterialsAll",
                "fetchLearningMateriaquestion_detailslsAll",
                "fetchLearningMaterialDocumentsAll",
                "fetchQuestionstypesAll",
                "fetchAnswertypesAll",
                "fetchTagsAll",
                "fetchSkillsAll",
                "setTags",
                "addOrderedText",
                "setAnswerForKey",
                "setSolutionDocuments",
                "setBlankCount",
                "setQuestionSkills",
                "setSkill",
                "setMaxScore",
                "setHasNegativeMarking",
                "setCountInOverallScore",
                "setCountInSkillScore",
                "removeQuestionSkill",
                "setIncludeInPracticeSet",
                "setIncludeInFreePackage"
            ]),
            updateTitle(e) {
                this.setTitle(e.target.value);
            },
            updateMaxScore(e) {
                this.setMaxScore(e.target.value);
            },
            updateHasNegativeMarks(e) {
                this.setHasNegativeMarking(e.target.checked);
            },
            deleteQuestionSkill(index){
              this.removeQuestionSkill(index)
            },
            updateCountInOverallScore(e) {
                this.setCountInOverallScore(e.target.checked);
            },
            updateCountInSkillScore(e) {
                this.setCountInSkillScore(e.target.checked);
            },
            updateQuestionSkills() {
                this.setQuestionSkills();
            },
            updateBlankCount(value){
                this.setBlankCount(value);
            },
            updateTags(value){
                this.setTags(value);
            },
            updateCourse(value) {
                this.setCourse(value);
            },
            updateSubject(value) {
                this.setSubject(value);
            },
            updateChapter(value) {
                this.setChapter(value);
            },
            updateTopic(value) {
                this.setTopic(value);
            },
            updateSubTopic(value) {
                this.setSubTopic(value);
            },
            updateHeader(value) {
                this.setHeader(value);
            },
            updateMax_score(e) {
                this.setMax_score(e.target.value);
            },
            updatePreparation_time(e) {
                this.setPreparation_time(e.target.value);
            },
            updateAttempt_time(e) {
                this.setAttempt_time(e.target.value);
            },
            updateStatus(value) {
                this.setStatus(value);
            },
            updateMin_words(e) {
                this.setMin_words(e.target.value);
            },
            updateMax_words(e) {
                this.setMax_words(e.target.value);
            },
            updateSection_type(value) {
                this.setSection_type(value);
            },
            updateQuestion_type(value) {
                this.setQuestion_type(value);
                this.updateQuestionDetails();
            },
            updateAnswer_type(value) {
                this.setAnswer_type(value);
                this.updateAnswerDetails();
            },
            updateSkill(value) {
                this.setSkill(value);
            },
            updateLearningMaterial(value) {
                this.setLearningMaterial(value);
            },
            updateLearningMaterialDocuments(value) {
                this.setLearningMaterialDocuments(value);
            },
            updateSolution_html(value) {
                this.setSolution_html(value);
            },
            triggerBrowse() {
                this.$refs.uploader.triggerBrowseFiles();
            },
            fileUploaded: function (file, result) {
                this.setSolutionDocuments(result.data.media)

            },
            input(key, value) {
                let image = JSON.parse(JSON.stringify(this.item.image));
            },
            updateInclude_in_free_package(value){
                console.log("updateInclude_in_free_package",value.target.checked);
                this.setIncludeInFreePackage(value.target.checked);
            },
            updateInclude_in_practice_set(value){
                console.log("practice_Set",value.target.checked);
                this.setIncludeInPracticeSet(value.target.checked);
            },
            updateQuestionDetailValue(key, value) {
                key = JSON.parse(JSON.stringify(key));
                value = JSON.parse(JSON.stringify(value));
                let context = this;
                let question_details = JSON.parse(
                    JSON.stringify(this.item.question_details)
                );
                let answer_details = JSON.parse(
                    JSON.stringify(this.item.answer_details)
                );

                if (!question_details || _.isEmpty(question_details)) {
                    question_details = {};
                }

                if (!answer_details || _.isEmpty(answer_details)) {
                    answer_details = {};
                }

                if(key == "fibOption") {
                    let configurations = JSON.parse(JSON.stringify(context.item.question_type.configurations));
                    for (let config in configurations) {
                        config = configurations[config];
                        if (config.isFib && config.chosen) {
                            if (question_details) {
                                if (!question_details[config.key] || _.isEmpty(question_details[config.key])) {
                                    question_details[config.key] = {};
                                }
                                let existingValue = JSON.parse(JSON.stringify(question_details[config.key]));
                                question_details[config.key] = Object.assign(existingValue, value);
                                context.setQuestion_details(question_details);
                            }
                            if (answer_details) {
                                if (!answer_details[config.key] || _.isEmpty(answer_details[config.key])) {
                                    answer_details[config.key] = {};
                                }
                                let existingValue = JSON.parse(JSON.stringify(answer_details[config.key]));
                                answer_details[config.key] = Object.assign(existingValue, value);
                                context.setAnswer_details(answer_details);
                            }
                        }
                    }
                    return;
                }

                question_details[key] = value;
                this.setQuestion_details(question_details);
                if (key == 'ordered_text' || key == 'ordered_images') {
                    this.setAnswerForKey({'key': key, 'value': question_details});
                }
                if (this.fibOption && key == this.fibOption) {
                    if (!this.answer_details) {
                        this.answer_details = {};
                    }
                    if (!this.answer_details) {
                        this.answer_details = {};
                    }
                    if (!this.answer_details.fibDetails) {
                        this.answer_details.fibDetails = {};
                    }
                    if (!this.answer_details.fibDetails[key]) {
                        this.answer_details.fibDetails[key] = {};
                    }
                    if (
                        answer_details.count <
                        this.answer_details.fibDetails[key].count
                    ) {
                        if (!answer_details[key].answers) {
                            answer_details[key].answers = [];
                        }
                        answer_details[key].answers.length = answer_details.count;
                    } else if (
                        answer_details.count >
                        this.answer_details.fibDetails[key].count
                    ) {
                        if (!answer_details[key].answers) {
                            answer_details[key].answers = [];
                        }
                        answer_details[key].answers.length = answer_details.count;
                        answer_details[key].answers = Object.assign(
                            answer_details[key].answers,
                            this.answer_details.fibDetails[key].answers
                        );
                    } else {
                        if (!answer_details[key]) {
                            answer_details[key] = {};
                        }
                        if (!answer_details[key].answers) {
                            answer_details[key].answers = [];
                            answer_details[key].answers = Object.assign(
                                answer_details[key].answers,
                                this.answer_details.fibDetails[key].answers
                            );
                        }
                    }
                    answer_details[key] = Object.assign(answer_details[key], value);
                    this.setAnswer_details(answer_details);
                }
            },
            addOrderedText(key, value) {
                this.addOrderedText({'key': key, 'value': value});
            },
            updateQuestionDetails() {
                return;
                let context = this;
                if (context.item && !context.item.question_details) {
                    context.setQuestion_details({});
                }
                if (
                    context.item &&
                    context.item.question_type &&
                    context.item.question_type.configurations
                ) {
                    _.forEach(this.item.question_type.configurations, function (
                        config
                    ) {
                        if (!context.item.question_details[config.key]) {
                            let question_details = JSON.parse(JSON.stringify(context.item.question_details));
                            question_details[config.key] = null;
                            context.setQuestion_details(question_details);
                        }
                    });
                }
            },
            updateAnswerDetailValue(key, value) {
                return;
                let answer_details = JSON.parse(JSON.stringify(this.item.answer_details));
                answer_details[key] = value;
                this.setAnswer_details(answer_details);
            },
            updateAnswerDetails() {
                return;
                let context = this;
                if (this.item && !this.item.answer_details) {
                    this.setAnswer_details({});
                }
                if (
                    this.item &&
                    this.item.answer_type &&
                    this.item.answer_type.configurations
                ) {
                    _.forEach(this.item.answer_type.configurations, function (
                        config
                    ) {
                        if (!context.item.answer_details[config.key]) {
                            let answer_details = JSON.parse(JSON.stringify(context.item.answer_details));
                            answer_details[config.key] = null;
                            context.setAnswer_details(answer_details);
                        }
                    });
                }
            },

            blankCountChanged: function (count) {
                return;
                console.log("blankCountChanged count", count);
                let context = this;
                // let answer_details = JSON.parse(JSON.stringify(context.item.answer_details));
                // let question_details = JSON.parse(JSON.stringify(context.item.question_details));
                let answer_details = context.item.answer_details;
                let question_details = context.item.question_details;
                for (let config in context.item.question_type.configurations) {
                    if (config.isFib && config.chosen) {
                        if (answer_details) {
                            if (!answer_details[config.key]) {
                                answer_details[config.key] = {};
                            }
                            answer_details[config.key]['count'] = count;
                        }
                        if (question_details) {
                            if (!question_details[config.key]) {
                                question_details[config.key] = {};
                            }
                            question_details[config.key]['count'] = count;
                        }
                    }
                }
                context.setQuestion_details(question_details);
                context.setAnswer_details(answer_details);
            },
            submitForm() {
                this.storeData()
                    .then(() => {
                        this.$router.push({name: "questions_banks.index"});
                        this.$eventHub.$emit("create-success");
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            toggleColumns(){
                this.showSummary = !this.showSummary;
            }
        }
    };
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
