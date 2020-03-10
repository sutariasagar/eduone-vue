/*
 * Copyright (c) 2019.
 */

function initialState() {
    return {
        item: {
            reading:{},
            writing:{},
            speaking:{},

        },
        chaptersAll: [],
        // examsectionsAll: [],
        topicsAll: [],
        subtopicsAll: [],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    examsectionsAll: state => state.examsectionsAll,
    chaptersAll: state => state.chaptersAll,
    topicsAll: state => {
    let filter = {};

    if (state.item.chapter) {
        filter.chapter_id = state.item.chapter.id;
    }

    return _.filter(state.topicsAll, filter);
},
subtopicsAll: state => {
    let filter = {};

    if (state.item.chapter) {
        filter.chapter_id = state.item.chapter.id;
    }
    if (state.item.topic) {
        filter.parent_id = state.item.topic.id;
    }

    return _.filter(state.subtopicsAll, filter);
},
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
                if (fieldValue && typeof fieldValue[0] !== 'object') {
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
            params.set('sub_topic', state.item.subtopic.id)
        }
        axios.post('/api/v1/exam-section-subject-mappings', params)
            .then(response => {
            commit('resetState')
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
                if (fieldValue && typeof fieldValue[0] !== 'object') {
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
            params.set('sub_topic', state.item.subtopic.id)
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
        axios.get('/api/v1/exam-section-subject-mappings/' + id)
            .then(response => {
            commit('setItem', response.data.data)
    })

        dispatch('fetchExamsectionsAll')
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
    setChapter({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'chapter', { root: true });
        commit('setChapter', value)
    },
    setTopic({ commit }, value) {
        commit('setTopic', value)
    },
    setSubTopic({ commit }, value) {
        commit('setSubTopic', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setChapter(state, value) {
        state.item.chapter = value
        state.item.topic = null
    },
    setTopic(state, value) {
        state.item.topic = value
        state.item.subtopic = null
    },
    setSubTopic(state, value) {
        state.item.subtopic = value
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
    setChaptersAll(state, value) {
        state.chaptersAll = value
    },
    setTopicsAll(state, value) {
        state.topicsAll = value
    },
    setSubTopicsAll(state, value) {
        state.subtopicsAll = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
