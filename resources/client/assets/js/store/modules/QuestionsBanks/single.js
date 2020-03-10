import Vue from "vue";

function initialState() {
    return {
        item: {
            id: null,
            title: null,
            course: null,
            subject: null,
            chapter: null,
            topic: null,
            subtopic: null,
            header: null,
            max_score: null,
            preparation_time: null,
            attempt_time: null,
            status: null,
            min_words: null,
            max_words: null,
            section_type: null,
            question_type: null,
            answer_type: null,
            question_details: {},
            answer_details: {},
            solution_html: null,
            learning_material: null,
            learning_material_documents: [],
            solution_documents: [],
            tags: [],
            blankCount: 0,
            question_skills:[],
            count_in_skill_score:false,
            count_in_overall_score:false,
            have_negative_marks:false,
            skill_max_score:0,
            skill:{},
            include_in_free_package:false,
            include_in_practice_set:false
        },
        coursesAll: [],
        subjectsAll: [],
        chaptersAll: [],
        topicsAll: [],
        learningMaterialsAll: [],
        learningMaterialDocumentsAll: [],
        staticLearningMaterialsAll: [],
        staticLearningMaterialDocumentsAll: [],
        staticCoursesAll: [],
        staticSubjectsAll: [],
        staticChaptersAll: [],
        staticTopicsAll: [],
        staticSubTopicsAll: [],
        subTopicsAll: [],
        questionstypesAll: [],
        answertypesAll: [],
        tagsAll: [],
        skillsAll: [],
        statusEnum: [{value: 'active', label: 'Active'}, {value: 'inactive', label: 'Inactive'},],
        section_typeEnum: [{value: 'speaking', label: 'Speaking'}, {
            value: 'writing',
            label: 'Writing'
        }, {value: 'reading', label: 'Reading'}, {
            value: 'listening_sst',
            label: 'Listening (SST)'
        }, {value: 'listening_rol', label: 'Listening (ROL)'},],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    coursesAll: state => state.coursesAll,
    subjectsAll: state => state.subjectsAll,
    chaptersAll: state => state.chaptersAll,
    topicsAll: state => state.topicsAll,
    subTopicsAll: state => state.subTopicsAll,
    questionstypesAll: state => state.questionstypesAll,
    answertypesAll: state => state.answertypesAll,
    statusEnum: state => state.statusEnum,
    section_typeEnum: state => state.section_typeEnum,
    learningMaterialsAll: state => state.learningMaterialsAll,
    learningMaterialDocumentsAll: state => state.learningMaterialDocumentsAll,
    tagsAll: state => state.tagsAll,
    skillsAll: state => state.skillsAll,
}

const actions = {
    storeData({commit, state, dispatch}) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, {root: true})

        return new Promise((resolve, reject) => {
            let params = new FormData();

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {

                    if (fieldValue && typeof fieldValue == 'object') {
                        params.set(fieldName, JSON.stringify(fieldValue));
                    }
                    else if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {

                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.subject)) {
                params.set('subject_id', '')
            } else {
                params.set('subject_id', state.item.subject.id)
            }
            if (_.isEmpty(state.item.chapter)) {
                params.set('chapter_id', '')
            } else {
                params.set('chapter_id', state.item.chapter.id)
            }
            if (_.isEmpty(state.item.topic)) {
                params.set('topic_id', '')
            } else {
                params.set('topic_id', state.item.topic.id)
            }
            if (_.isEmpty(state.item.subtopic)) {
                params.set('sub_topic_id', '')
            } else {
                params.set('sub_topic_id', state.item.subtopic.id)
            }
            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            if (!_.isEmpty(state.item.section_type) && typeof state.item.section_type === 'object') {
                params.set('section_type', state.item.section_type.value)
            }
            if (_.isEmpty(state.item.question_type)) {
                params.set('question_type_id', '')
            } else {
                params.set('question_type_id', state.item.question_type.id)
            }
            if (_.isEmpty(state.item.answer_type)) {
                params.set('answer_type_id', '')
            } else {
                params.set('answer_type_id', state.item.answer_type.id)
            }
            if (_.isEmpty(state.item.learning_material)) {
                params.set('learning_material_id', '')
            } else {
                params.set('learning_material_id', state.item.learning_material.id)
            }
            if (_.isEmpty(state.item.learning_material_documents)) {
                params.set('learning_material_document_id', '')
            } else {
                params.set('learning_material_document_id', state.item.learning_material_documents.id)
            }

            axios.post('/api/v1/questions-banks', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        {message: message, errors: errors, color: 'danger'},
                        {root: true})

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({commit, state, dispatch}) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, {root: true})

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {

                    if (fieldValue && typeof fieldValue == 'object') {
                        params.set(fieldName, JSON.stringify(fieldValue));
                    }
                    else if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {

                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.subject)) {
                params.set('subject_id', '')
            } else {
                params.set('subject_id', state.item.subject.id)
            }
            if (_.isEmpty(state.item.chapter)) {
                params.set('chapter_id', '')
            } else {
                params.set('chapter_id', state.item.chapter.id)
            }
            if (_.isEmpty(state.item.topic)) {
                params.set('topic_id', '')
            } else {
                params.set('topic_id', state.item.topic.id)
            }
            if (_.isEmpty(state.item.subtopic)) {
                params.set('sub_topic_id', '')
            } else {
                params.set('sub_topic_id', state.item.subtopic.id)
            }
            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            if (!_.isEmpty(state.item.section_type) && typeof state.item.section_type === 'object') {
                params.set('section_type', state.item.section_type.value)
            }
            if (_.isEmpty(state.item.question_type)) {
                params.set('question_type_id', '')
            } else {
                params.set('question_type_id', state.item.question_type.id)
            }
            if (_.isEmpty(state.item.answer_type)) {
                params.set('answer_type_id', '')
            } else {
                params.set('answer_type_id', state.item.answer_type.id)
            }
            if (_.isEmpty(state.item.learning_material)) {
                params.set('learning_material_id', '')
            } else {
                params.set('learning_material_id', state.item.learning_material.id)
            }
            if (_.isEmpty(state.item.learning_material_documents)) {
                params.set('learning_material_document_id', '')
            } else {
                params.set('learning_material_document_id', state.item.learning_material_documents.id)
            }

            axios.post('/api/v1/questions-banks/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        {message: message, errors: errors, color: 'danger'},
                        {root: true})

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    cloneData({commit, state, dispatch}) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, {root: true})

        return new Promise((resolve, reject) => {
            let params = new FormData();

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {

                    if (fieldValue && typeof fieldValue == 'object') {
                        params.set(fieldName, JSON.stringify(fieldValue));
                    }
                    else if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {

                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.subject)) {
                params.set('subject_id', '')
            } else {
                params.set('subject_id', state.item.subject.id)
            }
            if (_.isEmpty(state.item.chapter)) {
                params.set('chapter_id', '')
            } else {
                params.set('chapter_id', state.item.chapter.id)
            }
            if (_.isEmpty(state.item.topic)) {
                params.set('topic_id', '')
            } else {
                params.set('topic_id', state.item.topic.id)
            }
            if (_.isEmpty(state.item.subtopic)) {
                params.set('sub_topic_id', '')
            } else {
                params.set('sub_topic_id', state.item.subtopic.id)
            }
            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            if (!_.isEmpty(state.item.section_type) && typeof state.item.section_type === 'object') {
                params.set('section_type', state.item.section_type.value)
            }
            if (_.isEmpty(state.item.question_type)) {
                params.set('question_type_id', '')
            } else {
                params.set('question_type_id', state.item.question_type.id)
            }
            if (_.isEmpty(state.item.answer_type)) {
                params.set('answer_type_id', '')
            } else {
                params.set('answer_type_id', state.item.answer_type.id)
            }
            if (_.isEmpty(state.item.learning_material)) {
                params.set('learning_material_id', '')
            } else {
                params.set('learning_material_id', state.item.learning_material.id)
            }
            if (_.isEmpty(state.item.learning_material_documents)) {
                params.set('learning_material_document_id', '')
            } else {
                params.set('learning_material_document_id', state.item.learning_material_documents.id)
            }

            axios.post('/api/v1/questions-banks', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        {message: message, errors: errors, color: 'danger'},
                        {root: true})

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({commit, dispatch}, id) {
        axios.get('/api/v1/questions-banks/' + id)
            .then(response => {
                commit('setItem', JSON.parse(JSON.stringify(response.data.data)))
                console.log("response.data.data: ", response.data.data);
                let blankCount = 0;
                if (response.data.data.question_details.blankCount) {
                    console.log(response.data.data.question_details.blankCount);
                    blankCount = JSON.parse(JSON.stringify(response.data.data.question_details.blankCount));
                    console.log(blankCount);
                } else {
                    if (response.data.data.answer_details.fib_no_options && response.data.data.answer_details.fib_no_options.answers) {
                        if (blankCount < response.data.data.answer_details.fib_no_options.answers.length) {
                            blankCount = response.data.data.answer_details.fib_no_options.answers.length;
                        }
                    } else if (response.data.data.answer_details.fib_drag_drop && response.data.data.answer_details.fib_drag_drop.answers) {
                        if (blankCount < response.data.data.answer_details.fib_drag_drop.answers.length) {
                            blankCount = response.data.data.answer_details.fib_drag_drop.answers.length;
                        }
                    } else if (response.data.data.answer_details.fib_dropdown && response.data.data.answer_details.fib_dropdown.answers) {
                        if (blankCount < response.data.data.answer_details.fib_dropdown.answers.length) {
                            blankCount = response.data.data.answer_details.fib_dropdown.answers.length;
                        }
                    }
                }
                commit('setBlankCount', blankCount)
            })
        dispatch('fetchCoursesAll')
        dispatch('fetchSubjectsAll')
        dispatch('fetchChaptersAll')
        dispatch('fetchTopicsAll')
        dispatch('fetchSubTopicsAll')
        dispatch('fetchQuestionstypesAll')
        dispatch('fetchAnswertypesAll')
        dispatch('fetchLearningMaterialsAll')
        dispatch('fetchLearningMaterialDocumentsAll')
        dispatch('fetchTagsAll')
        dispatch('fetchSkillsAll')
    },
    fetchCoursesAll({commit}) {
        axios.get('/api/v1/courses')
            .then(response => {
                commit('setCoursesAll', response.data.data)
            })
    },
    fetchLearningMaterialsAll({commit}) {
        axios.get('/api/v1/learning-materials')
            .then(response => {
                commit('setLearningMaterialsAll', response.data.data)
            })
    },
    fetchLearningMaterialDocumentsAll({commit}) {
        axios.get('/api/v1/learning-material-documents')
            .then(response => {
                commit('setLearningMaterialDocumentsAll', response.data.data)
            })
    },
    fetchSubjectsAll({commit}) {
        axios.get('/api/v1/subjects')
            .then(response => {
                commit('setSubjectsAll', response.data.data)
            })
    },
    fetchChaptersAll({commit}) {
        axios.get('/api/v1/chapters')
            .then(response => {
                commit('setChaptersAll', response.data.data)
            })
    },
    fetchTopicsAll({commit}) {
        axios.get('/api/v1/topics')
            .then(response => {
                commit('setTopicsAll', response.data.data)
            })
    },
    fetchSubTopicsAll({commit}) {
        axios.get('/api/v1/topics')
            .then(response => {
                commit('setSubTopicsAll', response.data.data)
            })
    },
    fetchQuestionstypesAll({commit}) {
        axios.get('/api/v1/questions-types')
            .then(response => {

                commit('setQuestionstypesAll', response.data.data)

            })
    },
    fetchAnswertypesAll({commit}) {
        axios.get('/api/v1/answers-types')
            .then(response => {

                commit('setAnswertypesAll', response.data.data)

            })
    },
    fetchSkillsAll({commit}) {
        axios.get('/api/v1/skills')
            .then(response => {

            commit('setSkillsAll', response.data.data)

    })
    },
    setTitle({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'title', {root: true});
        commit('setTitle', value)
    },
    setCourse({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'course', {root: true});
        commit('setCourse', value);
        commit('filterSubjects', value);
        commit('filterChapters', value);
        commit('filterTopics', value);
        commit('filterSubTopics', value);
        commit('filterLearningMaterials', value);
    },
    setSubject({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'subject', {root: true});
        commit('setSubject', value);
        commit('filterChapters', value);
        commit('filterTopics', value);
        commit('filterSubTopics', value);
        commit('filterLearningMaterials', value);
    },
    setChapter({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'chapter', {root: true});
        commit('setChapter', value),
        commit('filterTopics', value);
        commit('filterSubTopics', value);
        commit('filterLearningMaterials', value);
    },
    setTopic({commit}, value) {
        commit('setTopic', value);
        commit('filterSubTopics', value);
        commit('filterLearningMaterials', value);
    },
    setSubTopic({commit}, value) {
        commit('setSubTopic', value)
        commit('filterLearningMaterials', value);
    },
    setHeader({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'header', {root: true});
        commit('setHeader', value)
    },
    setMax_score({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'max_score', {root: true});
        commit('setMax_score', value)
    },
    setPreparation_time({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'preparation_time', {root: true});
        commit('setPreparation_time', value)
    },
    setAttempt_time({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'attempt_time', {root: true});
        commit('setAttempt_time', value)
    },
    setStatus({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'status', {root: true});
        commit('setStatus', value)
    },
    setMin_words({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'min_words', {root: true});
        commit('setMin_words', value)
    },
    setMax_words({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'max_words', {root: true});
        commit('setMax_words', value)
    },
    setSection_type({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'section_type', {root: true});
        commit('setSection_type', value)
    },
    setQuestion_type({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'question_type', {root: true});
        commit('setQuestion_type', value)
    },
    setAnswer_type({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'answer_type', {root: true});
        commit('setAnswer_type', value)
    },
    setQuestion_details({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'question_details', {root: true});
        commit('setQuestion_details', value)
    },
    setQuestionDetailsByKey({commit, dispatch}, value) {
        console.log("setQuestion_details value: ", value)
        dispatch('Alert/removeError', 'question_details', {root: true});
        commit('setQuestionDetailsByKey', value)
    },
    setAnswer_details({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'answer_details', {root: true});
        commit('setAnswer_details', value)
    },
    setAnswerDetailsByKey({commit, dispatch}, value) {
        console.log("setAnswer_details value: ", value)
        dispatch('Alert/removeError', 'answer_details', {root: true});
        commit('setAnswerDetailsByKey', value)
    },
    setLearningMaterial({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'learning_material', {root: true});
        commit('setLearningMaterial', value)
        commit('filterLearningMaterialDocuments', value)
    },
    setTags({commit, dispatch}, value) {
        console.log("in set tags", value);
        dispatch('Alert/removeError', 'tags', {root: true});
        commit('setTags', value)
    },
    setLearningMaterialDocuments({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'learning_material_documents', {root: true});
        commit('setLearningMaterialDocuments', value)
    },
    setSolutionDocuments({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'solution_documents', {root: true});
        commit('setSolutionDocuments', value)
    },
    setSolution_html({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'solution_html', {root: true});
        commit('setSolution_html', value)
    },
    setFile({commit, dispatch}, value) {
        dispatch('Alert/removeError', 'file', {root: true});
        commit('setFile', value)
    },
    destroyFile({commit}, value) {
        commit('destroyFile', value)
    },
    destroyUploadedFile({commit}, value) {
        commit('destroyUploadedFile', value)
    },
    addOrderedText({commit, dispatch}, value) {
        commit('addOrderedText', value);
    },

    setAnswerForKey({commit, dispatch}, value) {
        commit('setAnswerForKey', value);
    },
    setSkill({commit, dispatch}, value) {
        commit('setSkill', value);
    },
    setMaxScore({commit, dispatch}, value) {
        commit('setMaxScore', value);
    },
    setHasNegativeMarking({commit, dispatch}, value) {
        commit('setHasNegativeMarking', value);
    },
    setCountInOverallScore({commit, dispatch}, value) {
        commit('setCountInOverallScore', value);
    },
    setCountInSkillScore({commit, dispatch}, value) {
        commit('setCountInSkillScore', value);
    },
    setQuestionSkills({commit, dispatch}, value){
        commit('setQuestionSkills', value);
    },
    removeQuestionSkill({commit, dispatch}, value){
        commit('removeQuestionSkill', value);
    },
    removeSolutionDocuments({commit, dispatch}, value){
        commit('removeSolutionDocuments', value);
    },
    setIncludeInFreePackage({commit, dispatch}, value){
        commit('setIncludeInFreePackage', value);
    },
    setIncludeInPracticeSet({commit, dispatch}, value){
        commit('setIncludeInPracticeSet', value);
    },
    resetState({commit}) {
        commit('resetState')
    },
    setBlankCount({commit, dispatch}, value) {
        commit('setBlankCount', value);
    },
    fetchTagsAll({commit}) {
        axios.get('/api/v1/tags?type=questions')
            .then(response => {
                commit('setTagsAll', response.data.data)
            })
    },
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setTitle(state, value) {
        state.item.title = value
    },
    setBlankCount(state, value) {
        console.log("setting blank counts");
        state.item.blankCount = value;
        state.item.question_details.blankCount = value;
    },
    setCourse(state, value) {
        state.item.course = value
        state.item.subject = null
        state.item.chapter = null
        state.item.topic = null
        state.item.subtopic = null
        state.item.learning_material = null
    },
    setSubject(state, value) {
        state.item.subject = value
        state.item.chapter = null
        state.item.topic = null
        state.item.subtopic = null
        state.item.learning_material = null
    },
    setChapter(state, value) {
        state.item.chapter = value
        state.item.topic = null
        state.item.subtopic = null
        state.item.learning_material = null
    },
    setTopic(state, value) {
        state.item.topic = value
        state.item.subtopic = null
        state.item.learning_material = null
    },
    setSubTopic(state, value) {
        state.item.subtopic = value
        state.item.learning_material = null
    },
    setHeader(state, value) {
        state.item.header = value
    },
    setLearningMaterial(state, value) {
        state.item.learning_material = value
    },
    setLearningMaterialDocuments(state, value) {
        state.item.learning_material_documents = value
    },
    setMax_score(state, value) {
        state.item.max_score = value
    },
    setPreparation_time(state, value) {
        state.item.preparation_time = value
    },
    setAttempt_time(state, value) {
        state.item.attempt_time = value
    },
    setStatus(state, value) {
        state.item.status = value
    },
    setMin_words(state, value) {
        state.item.min_words = value
    },
    setMax_words(state, value) {
        state.item.max_words = value
    },
    setSection_type(state, value) {
        state.item.section_type = value
    },
    setQuestion_type(state, value) {
        state.item.question_type = value
    },
    setAnswer_type(state, value) {
        state.item.answer_type = value
    },
    setQuestion_details(state, value) {
        state.item.question_details = value
    },
    setQuestionDetailsByKey(state, value) {
        //state.item.question_details[value.key] = value.value;
        Vue.set(state.item.question_details, value.key, value.value)
        //this.$set(state.item.question_details,value.key,value.value)
    },
    setAnswerDetailsByKey(state, value) {
        Vue.set(state.item.answer_details, value.key, value.value)
    },
    setAnswer_details(state, value) {
        state.item.answer_details = value;
    },
    setSolution_html(state, value) {
        console.log("in mutation setsolution documents");
        //Vue.set(state.item.solution_documents, value.id)
        state.item.solution_html = value
    },
    setFile(state, value) {
        for (let i in value) {
            let file = value[i];
            if (typeof file === "object") {
                state.item.file.push(file);
            }
        }
    },
    destroyFile(state, value) {
        for (let i in state.item.file) {
            if (i == value) {
                state.item.file.splice(i, 1);
            }
        }
    },
    removeQuestionSkill(state, value){
        for (let i in state.item.question_skills) {
            if (i == value) {
                state.item.question_skills.splice(i, 1);
            }
        }
    },
    removeSolutionDocuments(state, value) {
        console.log("here remove solution docs",value);
        for (let i in state.item.solution_documents) {
            console.log(i,state.item.solution_documents);
            let data = state.item.solution_documents[i];
            console.log(data);
            if (data.id === value) {
                state.item.solution_documents.splice(i, 1);
            }
        }

    },
    destroyUploadedFile(state, value) {
        for (let i in state.item.uploaded_file) {
            let data = state.item.uploaded_file[i];
            if (data.id === value) {
                state.item.uploaded_file.splice(i, 1);
            }
        }
    },
    setCoursesAll(state, value) {
        state.coursesAll = value
        state.staticCoursesAll = value
    },
    setSkillsAll(state, value) {
        state.skillsAll = value
    },
    setTagsAll(state, value) {
        state.tagsAll = value
    },
    setAnswerForKey(state, value) {
        console.log("checking answers", value);
        console.log(state.item.answer_details);
        state.item.answer_details[value.key] = value.value[value.key];
        console.log(state.item.answer_details);
    },
    setSubjectsAll(state, value) {
        state.subjectsAll = value
        state.staticSubjectsAll = value
    },
    setChaptersAll(state, value) {
        state.chaptersAll = value
        state.staticChaptersAll = value
    },
    setTopicsAll(state, value) {
        state.topicsAll = value
        state.staticTopicsAll = value
    },
    setSubTopicsAll(state, value) {
        state.subTopicsAll = value
        state.staticSubTopicsAll = value
    },
    setQuestionstypesAll(state, value) {
        state.questionstypesAll = value
    },
    setAnswertypesAll(state, value) {
        state.answertypesAll = value
    },
    setLearningMaterialsAll(state, value) {
        state.learningMaterialsAll = value
        state.staticLearningMaterialsAll = value
    },
    setLearningMaterialDocumentsAll(state, value) {
        state.learningMaterialDocumentsAll = value
        state.staticLearningMaterialDocumentsAll = value
    },
    setStatusEnum(state, value) {
        state.statusEnum = value
    },
    setSection_typeEnum(state, value) {
        state.section_typeEnum = value
    },
    setSolutionDocuments(state, value) {
        if (state.item.solution_documents)
            state.item.solution_documents.push(value)
        else {
            state.item.solution_documents = []
            state.item.solution_documents.push(value)
        }

    },

    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    },
    addOrderedText(state, value) {
        console.log("in ordreed text add store");

        // state.item.answer_details.push({
        //     text: "",
        //     chosen: false
        // });
    },
    filterLearningMaterialDocuments(state, value) {
        let filter = {};

        if (state.item.learning_material) {
            filter.learning_material_id = state.item.learning_material.id;
        }
        state.learningMaterialDocumentsAll = _.filter(state.staticLearningMaterialDocumentsAll, filter);
    },
    filterSubjects(state, value) {
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }
        state.subjectsAll = _.filter(state.staticSubjectsAll, filter);
    },
    filterChapters(state, value) {
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        if (state.item.subject) {
            filter.subject_id = state.item.subject.id;
        }
        state.chaptersAll = _.filter(state.staticChaptersAll, filter);
    },
    filterTopics(state, value) {
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        if (state.item.subject) {
            filter.subject_id = state.item.subject.id;
        }

        if (state.item.chapter) {
            filter.chapter_id = state.item.chapter.id;
        }

        state.topicsAll = _.filter(state.staticTopicsAll, filter);
    },
    filterSubTopics(state, value) {
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        if (state.item.subject) {
            filter.subject_id = state.item.subject.id;
        }

        if (state.item.chapter) {
            filter.chapter_id = state.item.chapter.id;
        }
        if (state.item.topic) {
            filter.parent_id = state.item.topic.id;
        }

        state.subTopicsAll = _.filter(state.staticSubTopicsAll, filter);
    },
    filterLearningMaterials(state, value) {
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        if (state.item.subject) {
            filter.subject_id = state.item.subject.id;
        }

        if (state.item.chapter) {
            filter.chapter_id = state.item.chapter.id;
        }
        if (state.item.topic) {
            filter.topic_id = state.item.topic.id;
        }
        if (state.item.subtopic) {
            filter.sub_topic_id = state.item.subtopic.id;
        }

        state.learningMaterialsAll = _.filter(state.staticLearningMaterialsAll, filter);
    },
    setTags(state, value) {
        state.item.tags = value
    },

    setSkill(state, value) {
        state.item.skill = value
    },
    setMaxScore(state, value) {
        console.log("checkingMax", value);
        state.item.skill_max_score = value;
    },
    setHasNegativeMarking(state, value) {
        console.log("checkingnegativ", value);
        state.item.have_negative_marks = value;
    },
    setCountInOverallScore(state, value) {
        console.log("checking", value);
        state.item.count_in_overall_score = value;
    },
    setCountInSkillScore(state, value) {
        state.item.count_in_skill_score = value;
    },
    setQuestionSkills(state, value){
        console.log(state.item.have_negative_marks,"in skill");
        state.item.question_skills.push({
            'skill_id': state.item.skill.id,
            'skill': state.item.skill,
            'max_score': state.item.skill_max_score,
            'have_negative_marks': state.item.have_negative_marks ? state.item.have_negative_marks : false,
            'count_in_overall_score': state.item.count_in_overall_score ? state.item.count_in_overall_score : false,
            'count_in_skill_score': state.item.count_in_skill_score ? state.item.count_in_skill_score : false,
        });
        console.log("priint",state.item.question_skills);
    },
    setIncludeInPracticeSet(state, value){
        state.item.include_in_practice_set = value;
    },
    setIncludeInFreePackage(state, value){
        state.item.include_in_free_package = value;
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
