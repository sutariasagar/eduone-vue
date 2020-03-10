function initialState() {
    return {
        item: {
            id: null,
            exam_section: null,
            chapter: null,
            min_questions: null,
            max_questions: null,
            topic: null,
            subtopic: null,
            exam_section_id: null,
        },
        chaptersAll: [],
        // examsectionsAll: [],
        topicsAll: [],
        subtopicsAll: [],
        staticChaptersAll: [],
        staticTopicsAll: [],
        staticSubTopicsAll: [],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    examsectionsAll: state => state.examsectionsAll,
    chaptersAll: state => state.chaptersAll,
    topicsAll: state => state.topicsAll,
    subtopicsAll: state => state.subtopicsAll
}

const actions = {
    storeData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

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

            if (_.isEmpty(state.item.exam_section)) {
                params.set('exam_section_id', '')
            } else {
                params.set('exam_section_id', state.item.exam_section.id)
            }
            params.set('exam_section_id', state.item.exam_section_id);
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
            axios.post('/api/v1/exam-section-subject-mappings', params)
                .then(response => {
                    //commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

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

            if (_.isEmpty(state.item.exam_section)) {
                params.set('exam_section_id', '')
            } else {
                params.set('exam_section_id', state.item.exam_section.id)
            }
            params.set('exam_section_id', state.item.exam_section_id);
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
            axios.post('/api/v1/exam-section-subject-mappings/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({ commit, dispatch }, id) {
        console.log(id);
        axios.get('/api/v1/exam-section-subject-mappings/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        //dispatch('fetchExamsectionsAll')
        dispatch('fetchChaptersAll')
        dispatch('fetchTopicsAll')
        dispatch('fetchSubTopicsAll')
    },
    fetchExamsectionsAll({ commit }) {
        axios.get('/api/v1/exam-sections')
            .then(response => {
                commit('setExamsectionsAll', response.data.data)
            })
    },
    fetchChaptersAll({ commit }) {
        axios.get('/api/v1/chapters')
            .then(response => {
                commit('setChaptersAll', response.data.data)
            })
    },
    fetchTopicsAll({ commit }) {
        axios.get('/api/v1/topics')
            .then(response => {
                commit('setTopicsAll', response.data.data)
            })
    },
    fetchSubTopicsAll({ commit }) {
        axios.get('/api/v1/topics')
            .then(response => {
                commit('setSubTopicsAll', response.data.data)
            })
    },
    setExam_section({ commit }, value) {
        commit('setExam_section', value)
    },
    setMin_questions({ commit }, value) {
        commit('setMin_questions', value)
    },
    setMax_questions({ commit }, value) {
        commit('setMax_questions', value)
    },
    setExam_section_id({ commit }, value) {
        commit('setExam_section_id', value)
    },
    setCourse({ commit }, value) {
        commit('setCourse', value)
        commit('filterChapters', value);
        commit('filterTopics', value);
        commit('filterSubTopics', value);
    },
    setChapter({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'chapter', { root: true });
        commit('setChapter', value);
        commit('filterTopics', value);
        commit('filterSubTopics', value);
    },
    setTopic({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'topic', { root: true });
        commit('setTopic', value);
        commit('filterSubTopics', value);
    },
    setSubTopic({ commit }, value) {
        commit('setSubTopic', value);
    },
    resetState({ commit }) {
        commit('resetState')
    },
    resetFormState({commit}){
        commit('resetFormState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },

    setCourse(state, value) {
        state.item.course = value
        state.item.chapter = null
        state.item.topic = null
        state.item.subtopic = null
    },
    setChapter(state, value) {
        state.item.chapter = value
        state.item.topic = null
        state.item.subtopic = null

    },
    setTopic(state, value) {
        state.item.topic = value
        state.item.subtopic = null
    },
    setSubTopic(state, value) {
        console.log("yes we are in action");
        state.item.subtopic = value
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
    filterChapters(state, value){
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        state.chaptersAll =  _.filter(state.staticChaptersAll, filter);
    },
    filterTopics(state, value){
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        if (state.item.chapter) {
            filter.chapter_id = state.item.chapter.id;
        }

        state.topicsAll = _.filter(state.staticTopicsAll, filter);
    },
    filterSubTopics(state, value){
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }
        if (state.item.chapter) {
            filter.chapter_id = state.item.chapter.id;
        }
        if (state.item.topic) {
            filter.parent_id = state.item.topic.id;
        }

        state.subtopicsAll = _.filter(state.staticSubTopicsAll, filter);
    },
    setExam_section(state, value) {
        state.item.exam_section = value
    },
    setMin_questions(state, value) {
        state.item.min_questions = value
    },
    setMax_questions(state, value) {
        state.item.max_questions = value
    },
    setExam_section_id(state, value) {
        state.item.exam_section_id = value
    },
    setExamsectionsAll(state, value) {
        state.examsectionsAll = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    },
    resetFormState(state){
        state.item.chapter = null
        state.item.topic = null
        state.item.subtopic = null
        state.item.min_questions = null
        state.item.max_questions = null
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
