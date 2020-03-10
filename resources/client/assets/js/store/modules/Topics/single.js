function initialState() {
    return {
        item: {
            id: null,
            title: null,
            course: null,
            subject: null,
            chapter: null,
            learning_sequence: null,
            parent: null,
        },
        coursesAll: [],
        subjectsAll: [],
        chaptersAll: [],
        topicsAll: [],
        staticCoursesAll: [],
        staticSubjectsAll: [],
        staticChaptersAll: [],
        staticTopicsAll: [],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    coursesAll: state => state.coursesAll,
    subjectsAll: state => state.subjectsAll,
    chaptersAll: state => state.chaptersAll,
    topicsAll: state => state.topicsAll

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
            if (_.isEmpty(state.item.parent)) {
                params.set('parent_id', '')
            } else {
                params.set('parent_id', state.item.parent.id)
            }

            axios.post('/api/v1/topics', params)
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
            if (_.isEmpty(state.item.parent)) {
                params.set('parent_id', '')
            } else {
                params.set('parent_id', state.item.parent.id)
            }

            axios.post('/api/v1/topics/' + state.item.id, params)
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
    fetchData({commit, dispatch}, id) {
        axios.get('/api/v1/topics/' + id)
             .then(response => {
                 commit('setItem', response.data.data)
             })

        dispatch('fetchCoursesAll')
        dispatch('fetchSubjectsAll')
        dispatch('fetchChaptersAll')
        dispatch('fetchTopicsAll')
    },
    fetchCoursesAll({commit}) {
        axios.get('/api/v1/courses')
             .then(response => {
                 commit('setCoursesAll', response.data.data)
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
    setTitle({commit,dispatch}, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    setCourse({commit,dispatch}, value) {
        dispatch('Alert/removeError', 'course', { root: true });
        commit('setCourse', value)
        commit('filterSubjects', value);
        commit('filterChapters', value);
        commit('filterTopics', value);
    },
    setSubject({commit,dispatch}, value) {
        dispatch('Alert/removeError', 'subject', { root: true });
        commit('setSubject', value)
        commit('filterChapters', value);
        commit('filterTopics', value);
    },
    setChapter({commit,dispatch}, value) {
        dispatch('Alert/removeError', 'chapter', { root: true });
        commit('setChapter', value)
        commit('filterTopics', value);
    },
    setLearning_sequence({commit,dispatch}, value) {
        dispatch('Alert/removeError', 'learning_sequence', { root: true });
        commit('setLearning_sequence', value)
    },
    setParent({commit,dispatch}, value) {
        dispatch('Alert/removeError', 'parent', { root: true });
        commit('setParent', value)
    },
    resetState({commit}) {
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
        state.item.parent = null
    },
    setSubject(state, value) {
        state.item.subject = value
        state.item.chapter = null
        state.item.parent = null
    },
    setChapter(state, value) {
        state.item.chapter = value
        state.item.parent = null
    },
    filterSubjects(state, value){
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }
        state.subjectsAll =  _.filter(state.staticSubjectsAll, filter);
    },
    filterChapters(state, value){
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }

        if (state.item.subject) {
            filter.subject_id = state.item.subject.id;
        }
        state.chaptersAll =  _.filter(state.staticChaptersAll, filter);
    },
    filterTopics(state, value){
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
    setLearning_sequence(state, value) {
        state.item.learning_sequence = value
    },
    setParent(state, value) {
        state.item.parent = value
    },
    setCoursesAll(state, value) {
        state.coursesAll = value
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
