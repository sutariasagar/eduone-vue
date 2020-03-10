function initialState() {
    return {
        item: {
            id: null,
            title: null,
            course: null,
            subject: null,
            chapter: null,
            topic: null,
            subtopic: null
        },
        coursesAll: [],
        subjectsAll: [],
        chaptersAll: [],
        topicsAll: [],
        subtopicsAll: [],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    coursesAll: state => state.coursesAll,
    subjectsAll: state => {
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        return _.filter(state.subjectsAll, filter);
    },
    chaptersAll: state => {
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        if (state.item.subject) {
            filter.subject_id = state.item.subject.id;
        }

        return _.filter(state.chaptersAll, filter);
    },
    topicsAll: state => {
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

        return _.filter(state.topicsAll, filter);
    },
    subtopicsAll: state => {
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

            axios.post('/api/v1/learning-materials', params)
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
                params.set('sub_topic', state.item.subtopic.id)
            }

            axios.post('/api/v1/learning-materials/' + state.item.id, params)
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
        axios.get('/api/v1/learning-materials/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchCoursesAll')
        dispatch('fetchSubjectsAll')
        dispatch('fetchChaptersAll')
        dispatch('fetchTopicsAll')
        dispatch('fetchSubTopicsAll')
    },
    fetchCoursesAll({ commit }) {
        axios.get('/api/v1/courses')
            .then(response => {
                commit('setCoursesAll', response.data.data)
            })
    },
    fetchSubjectsAll({ commit }) {
        axios.get('/api/v1/subjects')
            .then(response => {
                commit('setSubjectsAll', response.data.data)
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
    setTitle({ commit,dispatch }, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    setCourse({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'course', { root: true });
        commit('setCourse', value)
    },
    setSubject({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'subject', { root: true });
        commit('setSubject', value)
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
    setTitle(state, value) {
        state.item.title = value
    },
    setCourse(state, value) {
        state.item.course = value
        state.item.subject = null
        state.item.chapter = null
        state.item.topic = null
    },
    setSubject(state, value) {
        state.item.subject = value
        state.item.chapter = null
        state.item.topic = null
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
    setCoursesAll(state, value) {
        state.coursesAll = value
    },
    setSubjectsAll(state, value) {
        state.subjectsAll = value
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
